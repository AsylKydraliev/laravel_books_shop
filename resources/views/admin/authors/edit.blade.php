@extends('layouts.admin')

@section('content')
    <div class="container">
        <a href="{{ url()->previous() }}" class="btn btn-outline-primary mb-3">&lang; Back</a>
        <div class="row mb-5">
            <form
                action="{{ route('admin.authors.update', ['author' => $author]) }}"
                method="post"
                enctype="multipart/form-data"
            >
                @csrf
                @method('PUT')

                <h4>Edit author</h4>
                <hr>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input
                        type="text"
                        class="form-control @error('name') is-invalid @enderror"
                        id="name"
                        name="name"
                        value="{{ $author->name }}"
                    />
                    @error('name')
                    <strong class="text-danger">{{ $message  }}</strong>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea
                        class="form-control @error('description') is-invalid @enderror"
                        id="description"
                        name="description"
                    >{{ $author->description }}</textarea>
                    @error('description')
                    <strong class="text-danger">{{ $message  }}</strong>
                    @enderror
                </div>

                <div class="mb-3">

                    @if($author->image)
                        <img
                            class="mb-2 d-block"
                            width="100"
                            src="{{ str_contains($author->image, 'images') ? "/storage/$author->image" : $author->image }}"
                            alt="{{ $author->name }}"
                        >
                    @endif

                    <label for="file" class="form-label">Image</label>
                    <input class="form-control" type="file" id="file" name="image"/>
                    @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>

        <h4>Books</h4>
        <hr>

        <div class="col">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Price</th>
                    {{--                    <th scope="col">Category</th>--}}
                    {{--                    <th scope="col">Author</th>--}}
                    <th scope="col">Image</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($author->books as $book)
                    <tr>
                        <th scope="row">{{ $book->id }}</th>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->description }}</td>
                        <td>{{ $book->price }}</td>
                        {{--                        <td>{{ $book->category->title }}</td>--}}
                        {{--                        <td>{{ $book->author->name }}</td>--}}
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
@endsection
