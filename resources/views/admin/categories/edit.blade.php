@extends('layouts.admin')

@section('content')
    <div class="container">
        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-primary mb-3">&lang; Back</a>
        <div class="row mb-5">
            <form
                action="{{ route('admin.categories.update', ['category' => $category]) }}"
                method="post"
            >
                @csrf
                @method('PUT')

                <h4>Edit category</h4>
                <hr>
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ $category->title }}"
                        class="form-control @error('title') is-invalid @enderror"
                    />
                    @error('title')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea
                        id="description"
                        name="description"
                        class="form-control
                        @error('description') is-invalid @enderror"
                    >{{ $category->description }}</textarea>
                    @error('description')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                @if(count($category->books) >= 1)
                    <div>
                        <h4>Books</h4>
                        <hr>

                        <div class="col">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">
                                        Title
                                        <input
                                            class="form-control"
                                            type="text"
                                            id="book_title"
                                            name="new_book_title[]"
                                        />
                                    </th>
                                    <th scope="col">
                                        Description
                                        <textarea
                                            class="form-control"
                                            id="book_description"
                                            name="new_book_description[]"
                                            cols="70"
                                            rows="1"
                                        ></textarea>
                                    </th>
                                    <th scope="col">
                                        Price
                                        <input
                                            class="form-control"
                                            type="number"
                                            name="new_book_price[]"
                                            id="book_price"
                                        />
                                    </th>
                                    <th scope="col">
                                        Author
                                        <select class="form-select" name="new_book_author[]" aria-label="author"
                                                id="book_author">
                                            <option value="" disabled selected>Select author</option>
                                            @foreach($authors as $author)
                                                <option value="{{ $author->id }}">
                                                    {{ $author->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </th>
                                    <th scope="col">
                                        Actions
                                        <button type="button" class="btn btn-light add-book">
                                            <i class="bi bi-plus-lg fs-4"></i>
                                        </button>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($category->books as $book)
                                    <tr class="book-row">
                                        <th scope="row">{{ $book->id }}</th>
                                        <td>
                                            <input
                                                class="form-control"
                                                type="text"
                                                name="book_title[]"
                                                value="{{ $book->title }}"
                                            />
                                        </td>
                                        <td>
                                            <textarea
                                                class="form-control"
                                                name="book_description[]"
                                                cols="70"
                                                rows="3"
                                            >{{ $book->description }}</textarea>
                                        </td>
                                        <td>
                                            <input
                                                class="form-control"
                                                type="number"
                                                name="book_price[]"
                                                value="{{ $book->price }}"
                                            />
                                        </td>
                                        <td>
                                            <select class="form-select" name="book_author[]" aria-label="author">
                                                @foreach($authors as $author)
                                                    <option
                                                        @if($book->author && $author->id == $book->author->id) selected
                                                        @endif
                                                        value="{{ $author->id }}"
                                                    >
                                                        {{ $author->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>

                                        <input type="hidden" name="book_ids[]" value="{{ $book->id ?? 0 }}" />

                                        <td>
                                            <button class="btn btn-light delete-book">
                                                <i class="bi bi-trash fs-5"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

                <button type="submit" class="btn btn-primary">Edit</button>
            </form>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        function addBookRow() {
            let title = $("#book_title").val();
            let description = $("#book_description").val();
            let price = $("#book_price").val();
            let author = $("#book_author").val();

            if (!title || !description || !price || !author) {
                return alert('Заполните все обязательные поля!')
            }

            let newRow = '<tr class="book-row">' +
                '<th scope="row"></th>' +
                `<td><input class="form-control" type="text" name="book_titles[]"></td>` +
                `<td><textarea class="form-control" name="book_descriptions[]" cols="70" rows="3"></textarea></td>` +
                '<td><input class="form-control" type="number" name="book_prices[]"></td>' +
                '<td>' +
                '<select class="form-select" name="book_authors[]" aria-label="author">' +
                '<option value="" disabled selected>Select author</option>' +
                '@foreach($authors as $author)' +
                '<option value="{{ $author->id }}">{{ $author->name }}</option>' +
                '@endforeach' +
                '</select>' +
                '</td>' +
                '<td>' +
                '<input type="hidden" name="book_ids[]"' +
                '<button class="btn btn-light delete-book">' +
                '<i class="bi bi-trash fs-5"></i>' +
                '</button>' +
                '</td>' +
                '</tr>';

            $('tbody').append(newRow);

            let currentRow = $('tbody tr:last');

            currentRow.find('input[name="book_ids[]"]').val(0);
            currentRow.find('input[name="book_titles[]"]').val(title);
            currentRow.find('textarea[name="book_descriptions[]"]').val(description);
            currentRow.find('input[name="book_prices[]"]').val(price);
            currentRow.find('select[name="book_authors[]"]').val(author);

            $("#book_title").val('');
            $("#book_description").val('');
            $("#book_price").val('');
            $("#book_author").val('');
        }

        // Обработчик клика по кнопке "Add Book"
        $('.add-book').click(function () {
            addBookRow();
        });

        // Обработчик клика по кнопке "Delete Book"
        $(document).on('click', '.delete-book', function () {
            let rowToDelete = $(this).closest(".book-row");
            rowToDelete.remove();
        });
    });
</script>

