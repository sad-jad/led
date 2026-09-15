@php($board = $board ?? null)
@php($micros = $micros ?? collect())

<div class="mb-3">
    <label for="micro_id" class="form-label">میکروکنترلر</label>
    <select name="micro_id" id="micro_id" class="form-select @error('micro_id') is-invalid @enderror" required>
        <option value="">انتخاب کنید</option>
        @foreach ($micros as $micro)
            <option value="{{ $micro->id }}" @selected((int) old('micro_id', $board?->micro_id) === $micro->id)>{{ $micro->name }}</option>
        @endforeach
    </select>
    @error('micro_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="name" class="form-label">نام برد</label>
    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
           value="{{ old('name', $board?->name) }}" required>
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="type" class="form-label">نوع برد</label>
    <input type="text" name="type" id="type" class="form-control @error('type') is-invalid @enderror"
           value="{{ old('type', $board?->type) }}" required>
    @error('type')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="image" class="form-label">عکس شاخص</label>
    <input type="file" name="image" id="image" accept="image/*" class="form-control @error('image') is-invalid @enderror"
           @if (! $board) required @endif>
    @error('image')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    @if ($board?->icon())
        <img width="100" src="{{ $board->icon() ? url($board->icon()->path) : url('assets/img/board/default.png') }}"
    @endif
</div>
