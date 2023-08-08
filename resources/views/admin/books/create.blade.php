@extends('layouts.admin')

@section('content')
    <div class="container">
        <a href="{{ route('index') }}" class="btn btn-outline-primary mb-3">&lang; Back</a>
        <div class="row">
            <form
                action="{{ route('authors.store') }}"
                method="post"
                enctype="multipart/form-data"
            >
                @csrf
                <h4>Create new book</h4>
                <hr>
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title"/>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description"></textarea>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" id="price"/>
                </div>

                <div class="mb-3">
                    <label for="file" class="form-label">Image</label>
                    <input class="form-control" type="file" id="file">
                    @error('file')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="author" class="form-label">Author</label>
                    <select class="form-select" aria-label="author">
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="genre" class="form-label">Genre</label>
                    <select class="form-select" aria-label="genre">
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
@endsection
