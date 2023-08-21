@extends('layouts.admin')

@section('content')
    <div class="container">
        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-primary mb-3">&lang; Back</a>
        <div class="row">
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

                <button type="submit" class="btn btn-primary">Edit</button>
            </form>
        </div>
    </div>
@endsection
