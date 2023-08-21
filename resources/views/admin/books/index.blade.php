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

            <div class="col">
                <table class="table align-middle">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Price</th>
                        <th scope="col">Category</th>
                        <th scope="col">Author</th>
                        <th scope="col">Image</th>
                        <th scope="col">Actions</th>
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
                                    src="{{ $book->image }}"
                                    alt="{{ $book->title }}"
                                />
                            @else
                                No image
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.books.edit', ['book' => $book]) }}" class="btn btn-warning d-block">Edit</a>

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
                </table>
            </div>
        </div>

        <div class="row my-4 justify-content-center">
            <div class="col-md-auto">
                {{ $books->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
