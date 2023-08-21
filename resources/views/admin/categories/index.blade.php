@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div>
                <h3>Categories</h3>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-outline-primary">Add category</a>
            </div>

            @if(session('status'))
                <div class="alert alert-success my-3">
                    {{ session('status') }}
                </div>
            @endif

            <div class="col">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <th scope="row">{{ $category->id }}</th>
                        <td>{{ $category->title }}</td>
                        <td>{{ $category->description }}</td>
                        <td>
                            <a href="{{ route('admin.categories.edit', ['category' => $category]) }}" class="btn btn-warning d-block mb-1">Edit</a>

                            <form
                                action="{{ route('admin.categories.destroy', ['category' => $category]) }}"
                                method="post"
                                class="d-inline-block"
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
                {{ $categories->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
