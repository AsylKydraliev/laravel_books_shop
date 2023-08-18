@extends('layouts.admin')

@section('content')
    <div class="container">
        <a href="{{ route('authors.index') }}" class="btn btn-outline-primary mb-3">&lang; Back</a>
        <div class="row">
            <form
                action="{{ route('authors.update', ['author' => $author]) }}"
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
                    <img
                        class="mb-2 d-block"
                        width="100"
                        src="{{ asset("/storage/$author->image") }}"
                        alt="{{ $author->name }}"
                    >
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
    </div>
@endsection
