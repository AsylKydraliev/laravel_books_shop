@extends('layouts.admin')

@section('content')
    <div class="container">
        <a href="{{ route('categories.index') }}" class="btn btn-outline-primary mb-3">&lang; Back</a>
        <div class="row">
            <form
                action="{{ route('store') }}"
                method="post"
            >
                @csrf
                <h4>Create new genre</h4>
                <hr>
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title"/>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
@endsection
