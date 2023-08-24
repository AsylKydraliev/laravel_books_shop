@extends('layouts.admin')

@section('content')
    <div class="container">
        <a href="{{ route('admin.books.index') }}" class="btn btn-outline-primary mb-3">&lang; Back</a>
        <div class="row">
            <form
                action="{{ route('admin.books.store') }}"
                method="post"
                enctype="multipart/form-data"
            >
                @csrf
                <h4>Create new book</h4>
                <hr>
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <x-base-input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title') }}"
                    />
                </div>

                <div class="mb-3">
                    <x-base-textarea
                        id="description"
                        name="description"
                        label="Description"
                        value="{{ old('description') }}"
                    />
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <x-base-input
                        type="number"
                        id="price"
                        name="price"
                        value="{{ old('price') }}"
                    />
                </div>

                <div class="mb-3">
                    <label for="file" class="form-label">Image</label>
                    <x-base-input
                        type="file"
                        id="file"
                        name="image"
                        value="{{ old('image') }}"
                    />
                </div>

                <div class="mb-3">
                    <x-base-select
                        id="author"
                        label="Author"
                        name="author_id"
                    >
                        <option value="" disabled selected>Select author</option>
                        @foreach($authors as $author)
                            <option value="{{ $author->id }}">{{ $author->name }}</option>
                        @endforeach
                    </x-base-select>
                </div>

                <div class="mb-3">
                    <x-base-select
                        id="category"
                        label="Category"
                        name="category_id"
                    >
                        <option value="" disabled selected>Select category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </x-base-select>
                </div>

                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
@endsection
