@php
    $micro = $micro ?? null;
@endphp

<div class="mb-3">
    <label for="name" class="form-label">نام میکرو</label>
    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
           value="{{ old('name', $micro?->name) }}" required>
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="type" class="form-label">نوع میکرو</label>
    <input type="text" name="type" id="type" class="form-control @error('type') is-invalid @enderror"
           value="{{ old('type', $micro?->type) }}" required>
    @error('type')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="image" class="form-label">عکس شاخص</label>
    <input type="file" name="image" id="image" accept="image/*" class="form-control @error('image') is-invalid @enderror"
           @if (! $micro) required @endif>
    @error('image')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    @if ($micro?->icon())
        <img src="{{ url($micro->icon()->path) }}" alt="{{ $micro->name }}" class="mt-2" style="max-height: 120px;">
    @endif
</div>

@if ($micro?->icon())
    @section('css')
        <link rel="stylesheet" href="{{ url('assets/css/pin.css') }}" />
    @endsection

    <div class="pin-tagging">
        <section class="controls">
            <div class="control-row info-row">
                <div id="statusText" class="status">روی هر نقطه از عکس کلیک کنید تا نام Pin را وارد کنید (فقط حروف و اعداد انگلیسی).</div>
                <button id="clearTags" type="button" class="secondary">حذف همه Pinها</button>
            </div>
        </section>
        <section class="photo-panel">
            @php
                $iconPath = $micro->icon()->path;
                $iconUrl = \Illuminate\Support\Facades\Storage::disk('public')->exists($iconPath)
                    ? \Illuminate\Support\Facades\Storage::url($iconPath)
                    : url($iconPath);
            @endphp
            <div class="photo-area" id="photoWrapper">
                <img id="photo" src="{{ $iconUrl }}" alt="{{ $micro->name }}" />
                <div class="tag-popup hidden" id="tagPopup">
                    <div class="popup-title">نام Pin</div>
                    <input id="popupPersonInput" type="text" placeholder="مثلاً PA0 یا GND" dir="ltr" autocomplete="off" />
                    <div class="popup-error" id="popupError"></div>
                    <div class="tag-actions">
                        <button type="button" class="cancel-tag">لغو</button>
                        <button type="button" class="confirm-tag">تایید</button>
                    </div>
                </div>
            </div>
        </section>
        <section class="tag-panel">
            <div class="panel-header">
                <h2>Pinهای این میکرو</h2>
                <p>روی هر Pin کلیک و آن را بکشید تا موقعیتش را تغییر دهید.</p>
            </div>
            <div id="tagsList" class="tags-list"></div>
        </section>
    </div>

    @php
        $pinsPayload = $micro->pins->map(fn ($pin) => [
            'id' => $pin->id,
            'name' => $pin->name,
            'x' => $pin->x,
            'y' => $pin->y,
        ]);
        $pinStoreUrl = route('micro.pin.store', $micro);
        $pinUpdateUrlTemplate = route('micro.pin.update', [$micro, '__PIN__']);
        $pinDestroyUrlTemplate = route('micro.pin.destroy', [$micro, '__PIN__']);
    @endphp

    @section('script')
        <script>
            window.pinTaggingConfig = {
                pins: @json($pinsPayload),
                storeUrl: @json($pinStoreUrl),
                updateUrlTemplate: @json($pinUpdateUrlTemplate),
                destroyUrlTemplate: @json($pinDestroyUrlTemplate),
            };
        </script>
        <script defer src="{{ url('assets/js/pin.js') }}"></script>
    @endsection
@else
    <div class="alert alert-info mb-0">
        ابتدا میکرو را ذخیره کنید تا بتوانید Pin اضافه کنید.
    </div>
@endif
