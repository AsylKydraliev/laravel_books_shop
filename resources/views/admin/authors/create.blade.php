@extends('layouts.admin')

@section('content')
    <div class="container">
        <a href="{{ url()->previous() }}" class="btn btn-outline-primary mb-3">&lang; Back</a>
        <div class="row">
            <form
                action="{{ route('admin.authors.store') }}"
                method="post"
                enctype="multipart/form-data"
            >
                @csrf
                <h4>Create new author</h4>
                <hr>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name"/>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description"></textarea>
                </div>

                <div class="mb-3">
                    <label for="file" class="form-label">Image</label>
                    <input class="form-control" type="file" id="file" name="image"/>
                    @error('file')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
@endsection
