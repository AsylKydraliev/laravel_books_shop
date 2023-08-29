@extends('layouts.admin')

@section('content')
    <div class="container mb-5">
        <div class="row">
            <div>
                <h3>Books</h3>
                <a href="{{ route('admin.books.create') }}" class="btn btn-outline-primary">Add book</a>
            </div>

            @if(session('status'))
                <div class="alert alert-success my-3">
                    {{ session('status') }}
                </div>
            @endif

            <form
                action="{{ route('admin.books.index') }}"
                method="GET"
                id="search"
            >
            </form>

            <div class="col">
                <table class="table align-middle">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">
                            Title
                            <div class="input-group">
                                <input
                                    type="text"
                                    name="title"
                                    id="title"
                                    placeholder="Title"
                                    form="search"
                                    class="form-control border-end-0 border"
                                    value="{{ request('title') }}"
                                />
                                <span class="input-group-text">
                                    <i class="bi bi-x-lg titleClear"></i>
                                </span>
                            </div>
                        </th>
                        <th scope="col">
                            Description
                            <div class="input-group">
                                <input
                                    type="text"
                                    name="description"
                                    id="description"
                                    placeholder="Description"
                                    form="search"
                                    class="form-control border-end-0 border"
                                    value="{{ request('description') }}"
                                />
                                <span class="input-group-text">
                                    <i class="bi bi-x-lg descriptionClear"></i>
                                </span>
                            </div>
                        </th>
                        <th scope="col">
                            Price
                            <div class="input-group">
                            <input
                                type="text"
                                name="price"
                                id="price"
                                placeholder="Price"
                                form="search"
                                class="form-control border-end-0 border"
                                value="{{ request('price') }}"
                            />
                            <span class="input-group-text">
                                    <i class="bi bi-x-lg priceClear"></i>
                                </span>
                            </div>
                        </th>
                        <th scope="col">
                            Category
                            <div class="input-group">
                                <input
                                    type="text"
                                    name="category"
                                    id="category"
                                    placeholder="Category"
                                    form="search"
                                    class="form-control border-end-0 border"
                                    value="{{ request('category') }}"
                                />
                                <span class="input-group-text">
                                    <i class="bi bi-x-lg categoryClear"></i>
                                </span>
                            </div>
                        </th>
                        <th scope="col">
                            Author
                            <div class="input-group">
                                <input
                                    type="text"
                                    name="author"
                                    id="author"
                                    placeholder="Author"
                                    form="search"
                                    class="form-control border-end-0 border"
                                    value="{{ request('author') }}"
                                />
                                <span class="input-group-text">
                                    <i class="bi bi-x-lg authorClear"></i>
                                </span>
                            </div>
                        </th>
                        <th scope="col" style="vertical-align: baseline">Image</th>
                        <th scope="col" style="vertical-align: baseline">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($books as $book)
                        <tr>
                            <th scope="row">{{ $book->id }}</th>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->description }}</td>
                            <td>{{ $book->price }}</td>
                            <td>{{ $book->category->title ?? 'not category' }}</td>
                            <td>{{ $book->author->name ?? 'not author' }}</td>
                            <td>
                                @if($book->image)
                                    <img
                                        width="100"
                                        src="{{ str_contains($book->image, 'images') ? "/storage/$book->image" : $book->image }}"
                                        alt="{{ $book->title }}"
                                    />
                                @else
                                    No image
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.books.edit', ['book' => $book]) }}"
                                   class="btn btn-warning d-block">Edit</a>

                                <form
                                    action="{{ route('admin.books.destroy', ['book' => $book]) }}"
                                    method="post"
                                    class="d-inline-block mt-1"
                                >
                                    @csrf
                                    @method('delete')

                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th colspan="8">{{ $books->links() }}</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/books/search.js'])
@endpush
