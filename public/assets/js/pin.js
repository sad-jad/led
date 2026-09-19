(function () {
  const PIN_NAME_REGEX = /^[A-Za-z0-9_-]+$/;
  const config = window.pinTaggingConfig || { pins: [] };
  const csrfToken = document.querySelector('input[name="_token"]').value;

  const photoWrapper = document.getElementById("photoWrapper");
  const statusText = document.getElementById("statusText");
  const clearTagsButton = document.getElementById("clearTags");
  const tagsList = document.getElementById("tagsList");
  const tagPopup = document.getElementById("tagPopup");
  const popupInput = document.getElementById("popupPersonInput");
  const popupError = document.getElementById("popupError");
  const confirmButton = document.querySelector(".confirm-tag");
  const cancelButton = document.querySelector(".cancel-tag");

  let activeTagPosition = { xPercent: 0, yPercent: 0 };
  let currentZoom = 1;
  const tagStore = [];

  function showStatus(message, type = "") {
    statusText.textContent = message;
    statusText.className = `status ${type}`.trim();
  }

  function showPopupError(message) {
    popupError.textContent = message || "";
  }

  function clampXPercent(value) {
    return Math.min(97, Math.max(3, value));
  }

  function clampYPercent(value) {
    return Math.min(95, Math.max(7, value));
  }

  function percentFromByte(byte) {
    return (byte / 255) * 100;
  }

  function byteFromPercent(percent) {
    return Math.min(255, Math.max(0, Math.round((percent / 100) * 255)));
  }

  function validateName(name) {
    if (!name) return "لطفاً یک نام برای Pin وارد کنید.";
    if (name.length > 50) return "نام Pin نباید بیشتر از ۵۰ کاراکتر باشد.";
    if (!PIN_NAME_REGEX.test(name)) {
      return "نام Pin باید فقط شامل حروف و اعداد انگلیسی، خط تیره یا زیرخط باشد.";
    }
    return "";
  }

  function pinFetch(url, options = {}) {
    return fetch(url, {
      ...options,
      headers: {
        "X-CSRF-TOKEN": csrfToken,
        Accept: "application/json",
        "Content-Type": "application/json",
        ...(options.headers || {}),
      },
    });
  }

  function renderPinMarker(pin) {
    const xPercent = clampXPercent(percentFromByte(pin.x));
    const yPercent = clampYPercent(percentFromByte(pin.y));

    const tag = document.createElement("button");
    tag.type = "button";
    tag.className = "tag-marker";
    tag.innerHTML = `<span>${pin.name}</span>`;
    tag.style.left = `${xPercent}%`;
    tag.style.top = `${yPercent}%`;
    tag.dataset.tagId = pin.id;
    tag.dataset.name = pin.name;
    photoWrapper.appendChild(tag);
    attachTagDrag(tag);

    tagStore.push({
      id: pin.id,
      name: pin.name,
      x: pin.x,
      y: pin.y,
      xPercent,
      yPercent,
    });

    updateTagsList();

    return tag;
  }

  function updateTagsList() {
    tagsList.innerHTML = "";

    if (tagStore.length === 0) {
      tagsList.innerHTML = "<div class='tag-item'>هنوز Pinی اضافه نشده است.</div>";
      return;
    }

    tagStore.forEach((entry, index) => {
      const item = document.createElement("div");
      item.className = "tag-item";
      item.innerHTML = `
                <span>${index + 1}. ${entry.name}</span>
                <button type="button" class="remove-tag" data-id="${entry.id}">حذف</button>
            `;
      tagsList.appendChild(item);
    });
  }

  function removePinFromUI(id) {
    const marker = photoWrapper.querySelector(`.tag-marker[data-tag-id="${id}"]`);
    if (marker) marker.remove();

    const index = tagStore.findIndex((item) => String(item.id) === String(id));
    if (index !== -1) tagStore.splice(index, 1);

    updateTagsList();
  }

  function persistTagPosition(tag) {
    const entry = tagStore.find((item) => String(item.id) === tag.dataset.tagId);
    if (!entry) return;

    const xPercent = parseFloat(tag.style.left);
    const yPercent = parseFloat(tag.style.top);
    const x = byteFromPercent(xPercent);
    const y = byteFromPercent(yPercent);

    pinFetch(config.updateUrlTemplate.replace("__PIN__", entry.id), {
      method: "PUT",
      body: JSON.stringify({ name: entry.name, x, y }),
    })
      .then((response) => {
        if (!response.ok) throw new Error("network");
        return response.json();
      })
      .then((pin) => {
        entry.x = pin.x;
        entry.y = pin.y;
        entry.xPercent = percentFromByte(pin.x);
        entry.yPercent = percentFromByte(pin.y);
      })
      .catch(() => {
        tag.style.left = `${entry.xPercent}%`;
        tag.style.top = `${entry.yPercent}%`;
        showStatus("جابجایی Pin ذخیره نشد. دوباره تلاش کنید.", "danger");
      });
  }

  function attachTagDrag(tag) {
    let active = false;
    let start = { x: 0, y: 0, left: 0, top: 0 };

    tag.addEventListener("pointerdown", (event) => {
      event.preventDefault();
      event.stopPropagation();
      active = true;
      tag.setPointerCapture(event.pointerId);
      start.x = event.clientX;
      start.y = event.clientY;
      start.left = parseFloat(tag.style.left);
      start.top = parseFloat(tag.style.top);
      tag.classList.add("dragging");
    });

    tag.addEventListener("pointermove", (event) => {
      if (!active) return;
      const deltaX = event.clientX - start.x;
      const deltaY = event.clientY - start.y;
      const parentRect = photoWrapper.getBoundingClientRect();
      const newLeft = clampXPercent(start.left + (deltaX / parentRect.width) * 100);
      const newTop = clampYPercent(start.top + (deltaY / parentRect.height) * 100);
      tag.style.left = `${newLeft}%`;
      tag.style.top = `${newTop}%`;
    });

    tag.addEventListener("pointerup", (event) => {
      if (!active) return;
      active = false;
      tag.releasePointerCapture(event.pointerId);
      tag.classList.remove("dragging");
      persistTagPosition(tag);
    });

    tag.addEventListener("pointercancel", () => {
      active = false;
      tag.classList.remove("dragging");
    });
  }

  function hideTagPopup() {
    if (!tagPopup) return;
    tagPopup.classList.add("hidden");
    popupInput.value = "";
    showPopupError("");
  }

  function positionPopup(x, y, wrapperRect) {
    const left = x - wrapperRect.left;
    const top = y - wrapperRect.top;
    const popupWidth = 320;
    const popupHeight = 180;
    const maxLeft = wrapperRect.width - popupWidth - 14;
    const maxTop = wrapperRect.height - popupHeight - 14;

    tagPopup.style.left = `${Math.min(Math.max(left, 14), Math.max(maxLeft, 14))}px`;
    tagPopup.style.top = `${Math.min(Math.max(top, 14), Math.max(maxTop, 14))}px`;
  }

  function showTagPopup(x, y) {
    if (!tagPopup) return;
    tagPopup.classList.remove("hidden");
    positionPopup(x, y, photoWrapper.getBoundingClientRect());
    popupInput.value = "";
    showPopupError("");
    popupInput.focus();
  }

  function submitPopup() {
    const name = popupInput.value.trim();
    const error = validateName(name);

    if (error) {
      showPopupError(error);
      return;
    }

    showPopupError("");
    confirmButton.disabled = true;
    confirmButton.textContent = "در حال ثبت...";

    pinFetch(config.storeUrl, {
      method: "POST",
      body: JSON.stringify({
        name,
        x: byteFromPercent(activeTagPosition.xPercent),
        y: byteFromPercent(activeTagPosition.yPercent),
      }),
    })
      .then((response) => {
        if (response.status === 422) throw new Error("duplicate");
        if (!response.ok) throw new Error("network");
        return response.json();
      })
      .then((pin) => {
        renderPinMarker(pin);
        hideTagPopup();
        showStatus(`Pin «${pin.name}» اضافه شد.`, "success");
      })
      .catch((err) => {
        if (err.message === "duplicate") {
          showPopupError("این نام قبلاً برای این میکرو استفاده شده است.");
        } else {
          showPopupError("خطا در برقراری ارتباط با سرور. دوباره تلاش کنید.");
        }
      })
      .finally(() => {
        confirmButton.disabled = false;
        confirmButton.textContent = "تایید";
      });
  }

  popupInput.addEventListener("keydown", (event) => {
    if (event.key === "Enter") {
      event.preventDefault();
      submitPopup();
    }
  });

  confirmButton.addEventListener("click", () => {
    submitPopup();
  });

  cancelButton.addEventListener("click", () => {
    hideTagPopup();
  });

  document.addEventListener("click", (event) => {
    if (
      !tagPopup.contains(event.target) &&
      !event.target.closest(".tag-marker") &&
      !photoWrapper.contains(event.target)
    ) {
      hideTagPopup();
    }
  });

  photoWrapper.addEventListener("click", (event) => {
    if (event.target.closest(".tag-marker") || event.target.closest(".tag-popup")) {
      return;
    }

    const rect = photoWrapper.getBoundingClientRect();
    const xPercent = ((event.clientX - rect.left) / rect.width) * 100;
    const yPercent = ((event.clientY - rect.top) / rect.height) * 100;
    activeTagPosition = { xPercent, yPercent };
    showTagPopup(event.clientX, event.clientY);
    showStatus("نام Pin را وارد کنید (فقط حروف و اعداد انگلیسی).");
  });

  clearTagsButton.addEventListener("click", () => {
    if (tagStore.length === 0) return;

    if (!window.confirm("همه Pinهای این میکرو برای همیشه حذف شوند؟ این عملیات قابل بازگشت نیست.")) {
      return;
    }

    const entries = [...tagStore];

    Promise.allSettled(
      entries.map((entry) =>
        pinFetch(config.destroyUrlTemplate.replace("__PIN__", entry.id), { method: "DELETE" }).then((response) => {
          if (!response.ok) throw new Error("network");
          return entry.id;
        }),
      ),
    ).then((results) => {
      const succeeded = results.filter((r) => r.status === "fulfilled").map((r) => r.value);
      succeeded.forEach((id) => removePinFromUI(id));

      if (succeeded.length === entries.length) {
        showStatus("همه Pinها حذف شدند.", "success");
      } else {
        showStatus(`${succeeded.length} از ${entries.length} Pin حذف شد. برخی موارد با خطا مواجه شدند.`, "warning");
      }
    });
  });

  tagsList.addEventListener("click", (event) => {
    const removeButton = event.target.closest(".remove-tag");
    if (!removeButton) return;

    const id = removeButton.dataset.id;
    const entry = tagStore.find((item) => String(item.id) === String(id));
    if (!entry) return;

    if (!window.confirm(`این Pin («${entry.name}») حذف شود؟`)) return;

    pinFetch(config.destroyUrlTemplate.replace("__PIN__", entry.id), { method: "DELETE" })
      .then((response) => {
        if (!response.ok) throw new Error("network");
        removePinFromUI(entry.id);
        showStatus(`Pin «${entry.name}» حذف شد.`, "success");
      })
      .catch(() => {
        showStatus("حذف Pin با خطا مواجه شد. دوباره تلاش کنید.", "danger");
      });
  });

  function updateZoom(value) {
    currentZoom = Number(Math.min(2.5, Math.max(1, value)).toFixed(2));
    photoWrapper.style.transform = `scale(${currentZoom})`;
  }

  photoWrapper.addEventListener("wheel", (event) => {
    event.preventDefault();
    const delta = -event.deltaY * 0.0015;
    updateZoom(currentZoom + delta);
  });

  (config.pins || []).forEach(renderPinMarker);
  showStatus("روی هر نقطه از عکس کلیک کنید تا نام Pin را وارد کنید.");
})();
