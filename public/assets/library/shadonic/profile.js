let searchNameProduct = document.querySelectorAll('.search-name-product');
let boxNameProduct = document.querySelectorAll('.box-name-product');

searchNameProduct.forEach((item) => {
  item.addEventListener('click', function (e) {
    e.preventDefault();
    item.nextElementSibling.style.display = 'block';
  });
});

window.addEventListener('click', function (e) {
  boxNameProduct.forEach((items) => {
    if (
      !items.contains(e.target) &&
      !items.previousElementSibling.contains(e.target)
    ) {
      items.style.display = 'none';
    }
  });
});

document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('.nav-link-1').forEach(function (element) {
    element.addEventListener('click', function (e) {
      let nextEl = element.nextElementSibling;
      let parentEl = element.parentElement;

      if (nextEl) {
        e.preventDefault();
        let mycollapse = new bootstrap.Collapse(nextEl);

        if (nextEl.classList.contains('show')) {
          mycollapse.hide();
        } else {
          mycollapse.show();
          // find other submenus with class=show
          var opened_submenu =
            parentEl.parentElement.querySelector('.submenu.show');
          // if it exists, then close all of them
          if (opened_submenu) {
            new bootstrap.Collapse(opened_submenu);
          }
        }
      }
    });
  });
});

/**************************************************************************************/

let categoryMenu = document.querySelector('.category-menu');
let itemsMainMenu = document.querySelector('.items-main-menu');
let allItemsMenu = document.querySelectorAll('.li-items-main-menu');
let linksItemsMainMenu = document.querySelectorAll('.links-items-main-menu');

if (allItemsMenu) {
}
allItemsMenu.forEach((liElem) => {
  liElem.addEventListener('mouseover', function () {
    linksItemsMainMenu.forEach((e) => {
      e.style.display = 'none';
    });
    this.nextElementSibling.style.display = 'block';
  });
});

if (itemsMainMenu) {
  itemsMainMenu.addEventListener('mouseleave', function () {
    itemsMainMenu.style.display = 'none';
  });
}

/*************************************************************************************** btn submit */
let btnedit = document.querySelectorAll('.btn-edit-profile-product');
let btnsubmit = document.querySelectorAll('.btn-submit-profile-product');

btnedit.forEach((e) => {
  e.addEventListener('click', function (event) {
    event.preventDefault();
    e.classList.add('d-none');
    e.nextElementSibling.classList.remove('d-none');
    e.previousElementSibling.style.pointerEvents = 'visible';
  });
});

btnsubmit.forEach((e) => {
  e.addEventListener('click', function () {
    e.classList.add('d-none');
    e.previousElementSibling.classList.remove('d-none');
    e.previousElementSibling.previousElementSibling.style.pointerEvents =
      'none';
  });
});