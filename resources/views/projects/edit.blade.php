@extends('layout.project.master')

@section('title', 'ویرایش پروژه')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <h1 class="h4 mb-3">ویرایش پروژه</h1>
    <form action="{{ route('projects.update', $project) }}" method="POST" class="col-lg-6 mb-4">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">عنوان پروژه</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                   value="{{ old('title', $project->title) }}" required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">ذخیره عنوان</button>
    </form>
    <hr>
    <h2 class="h5 mt-4 mb-3">افزودن برد به پروژه</h2>
    <input type="text" id="board-search" class="form-control mb-3" placeholder="نام برد را جستجو کنید...">
    <div id="search-results" class="row row-cols-2 row-cols-md-4 row-cols-lg-5 g-3 mb-5"></div>
    <h2 class="h5 mb-3">بردهای این پروژه</h2>
    <div id="attached-boards" class="row row-cols-2 row-cols-md-4 row-cols-lg-5 g-3">
        @foreach ($project->boards as $board)
            <div class="col" data-board-id="{{ $board->id }}">
                <div class="card h-100">
                    @php($image = $board->images->firstWhere('type', 0))
                    <img src="{{ $image ? Storage::url($image->path) : 'https://placehold.co/200x140?text=' . urlencode($board->name) }}"
                         class="card-img-top" style="height: 120px; object-fit: cover;" alt="{{ $board->name }}">
                    <div class="card-body p-2">
                        <p class="card-text small mb-1">{{ $board->name }}</p>
                        <button type="button" class="btn btn-sm btn-outline-danger w-100 detach-board">حذف</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <p id="no-boards-message" class="text-muted @if ($project->boards->isNotEmpty()) d-none @endif">هنوز هیچ بردی به این پروژه اضافه نشده است.</p>
@endsection

@section('script')
<script>
(function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    const searchUrl = @json(route('projects.boards.search', $project));
    const attachUrlTemplate = @json(route('projects.boards.attach', [$project, '__BOARD__']));
    const detachUrlTemplate = @json(route('projects.boards.detach', [$project, '__BOARD__']));

    const searchInput = document.getElementById('board-search');
    const searchResults = document.getElementById('search-results');
    const attachedBoards = document.getElementById('attached-boards');
    const noBoardsMessage = document.getElementById('no-boards-message');

    function boardCardHtml(board, { detachable }) {
        const image = board.image_url || ('https://placehold.co/200x140?text=' + encodeURIComponent(board.name));
        const cardClass = detachable ? 'card h-100' : 'card h-100 board-pick-card';
        const action = detachable
            ? '<button type="button" class="btn btn-sm btn-outline-danger w-100 detach-board">حذف</button>'
            : '<p class="card-text small text-muted mb-0">برای افزودن کلیک کنید</p>';

        return '<div class="col" data-board-id="' + board.id + '">' +
            '<div class="' + cardClass + '" style="' + (detachable ? '' : 'cursor:pointer;') + '">' +
            '<img src="' + image + '" class="card-img-top" style="height: 120px; object-fit: cover;" alt="' + board.name + '">' +
            '<div class="card-body p-2">' +
            '<p class="card-text small mb-1">' + board.name + '</p>' +
            action +
            '</div></div></div>';
    }

    function runSearch(query) {
        fetch(searchUrl + '?q=' + encodeURIComponent(query))
            .then(response => response.json())
            .then(boards => {
                searchResults.innerHTML = boards.length
                    ? boards.map(board => boardCardHtml(board, { detachable: false })).join('')
                    : '<p class="text-muted">بردی یافت نشد.</p>';
            });
    }

    let debounceTimer;
    searchInput.addEventListener('input', () => {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => runSearch(searchInput.value.trim()), 300);
    });

    searchResults.addEventListener('click', (event) => {
        const col = event.target.closest('[data-board-id]');
        if (!col) return;

        const boardId = col.dataset.boardId;

        fetch(attachUrlTemplate.replace('__BOARD__', boardId), {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
        })
            .then(response => response.json())
            .then(board => {
                col.remove();
                noBoardsMessage.classList.add('d-none');
                attachedBoards.insertAdjacentHTML('beforeend', boardCardHtml(board, { detachable: true }));
            });
    });

    attachedBoards.addEventListener('click', (event) => {
        const button = event.target.closest('.detach-board');
        if (!button) return;

        const col = button.closest('[data-board-id]');
        const boardId = col.dataset.boardId;

        fetch(detachUrlTemplate.replace('__BOARD__', boardId), {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
        })
            .then(() => {
                col.remove();
                if (!attachedBoards.querySelector('[data-board-id]')) {
                    noBoardsMessage.classList.remove('d-none');
                }
            });
    });

    runSearch('');
})();
</script>
@endsection
