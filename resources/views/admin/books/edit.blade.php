@extends('layouts.admin')

@section('content')
    <div class="container">
        <a href="{{ route('books.index') }}" class="btn btn-outline-primary mb-3">&lang; Back</a>
        <div class="row">
            <form
                action="{{ route('books.update', ['book' => $book]) }}"
                method="post"
                enctype="multipart/form-data"
            >
                @csrf
                @method('PUT')

                <h4>Edit book</h4>
                <hr>
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
                    <img
                        class="mb-2 d-block"
                        width="100"
                        src="{{ asset("/storage/$book->image") }}"
                        alt="{{ $book->title }}"
                    >
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
                                value="{{ $author->id }}"
                                selected="{{ $book->author->id == $author->id }}"
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
                    <label for="category" class="form-label">Genre</label>
                    <select
                        aria-label="category"
                        name="category_id"
                        class="form-select @error('category_id') is-invalid @enderror"
                    >
                        @foreach($categories as $category)
                            <option
                                value="{{ $category->id }}"
                                selected="{{ $book->category->id == $category->id }}"
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
        </div>
    </div>
@endsection
