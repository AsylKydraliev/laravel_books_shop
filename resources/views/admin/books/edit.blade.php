@extends('layouts.admin')

@section('content')
    <div class="container">
        <a href="{{ route('admin.books.index') }}" class="btn btn-outline-primary mb-3">&lang; Back</a>
        <div class="row">
            <ul class="nav nav-tabs mb-4">
                <li class="nav-item">
                    <a class="nav-link active" href="#edit"><h5>Edit book</h5></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#history"><h5>Book history</h5></a>
                </li>
            </ul>

            <form
                action="{{ route('admin.books.update', ['book' => $book]) }}"
                method="post"
                enctype="multipart/form-data"
                id="edit"
                class="tab-content"
            >
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ $book->title }}"
                        class="form-control @error('title') is-invalid @enderror"
                    />
                    @error('title')
                    <strong class="text-danger">{{ $message  }}</strong>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea
                        id="description"
                        name="description"
                        class="form-control @error('description') is-invalid @enderror"
                    >{{ $book->description }}</textarea>
                    @error('description')
                    <strong class="text-danger">{{ $message  }}</strong>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input
                        type="number"
                        id="price"
                        name="price"
                        value="{{ $book->price }}"
                        class="form-control @error('price') is-invalid @enderror"
                    />
                    @error('price')
                    <strong class="text-danger">{{ $message  }}</strong>
                    @enderror
                </div>

                <div class="mb-3">
                    @if($book->image)
                        <img
                            class="mb-2 d-block"
                            width="100"
                            src="{{ str_contains($book->image, 'images') ? "/storage/$book->image" : $book->image }}"
                            alt="{{ $book->title }}"
                        >
                    @endif
                    <label for="file" class="form-label">Image</label>
                    <input
                        type="file"
                        id="file"
                        name="image"
                        class="form-control @error('image') is-invalid @enderror"
                    >
                    @error('image')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="author" class="form-label">Author</label>
                    <select
                        aria-label="author"
                        name="author_id"
                        class="form-select @error('author_id') is-invalid @enderror"
                    >
                        @foreach($authors as $author)
                            <option
                                @if($book->author && $author->id == $book->author->id) selected @endif
                            value="{{ $author->id }}"
                            >
                                {{ $author->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('author_id')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select
                        aria-label="category"
                        name="category_id"
                        class="form-select @error('category_id') is-invalid @enderror"
                    >
                        @foreach($categories as $category)
                            <option
                                @if($book->category && $category->id == $book->category->id) selected @endif
                            value="{{ $category->id }}"
                            >
                                {{ $category->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>

            <div id="history" class="tab-content" style="display: none;">
                    <div class="col">
                        <table class="table align-middle">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">User</th>
                                <th scope="col">Changes</th>
                                <th scope="col">Created at</th>
                                <th scope="col">Updated at</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($book->logs as $log)
                                <tr>
                                    <th scope="row">{{ $log->id }}</th>
                                    <td>{{ $log->user->name ?? '' }}</td>
                                    <td>{{ $log->content }}</td>
                                    <td>{{ $log->created_at }}</td>
                                    <td>{{ $log->updated_at }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/books/tabs.js'])
@endpush
