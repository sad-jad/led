@php($micro = $micro ?? null)

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
        <img src="{{ $micro->icon() ? url($micro->icon()->path) : url('assets/img/micro/default.png') }}" alt="{{ $micro->name }}" class="mt-2" style="max-height: 120px;">
    @endif
</div>
