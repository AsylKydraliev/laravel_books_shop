@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div>
                <h3>Authors</h3>
                <a href="{{ route('admin.authors.create') }}" class="btn btn-outline-primary">Add author</a>
            </div>

            @if(session('status'))
                <div class="alert alert-success my-3">
                    {{ session('status') }}
                </div>
            @endif

            <div class="col mt-4">
                <table class="table align-middle">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Image</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($authors as $author)
                        <tr>
                            <th>{{ $author->id }}</th>
                            <td>{{ $author->name }}</td>
                            <td>{{ $author->description }}</td>
                            <td>
                                @if($author->image)
                                <img
                                    width="100"
                                    src="{{ str_contains($author->image, 'images') ? "/storage/$author->image" : $author->image }}"
                                    alt="{{$author->name}}"
                                >
                                @else
                                    No image
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.authors.edit', ['author' => $author]) }}" class="btn btn-warning d-block mb-1">Edit</a>

                                <form
                                    action="{{ route('admin.authors.destroy', ['author' => $author]) }}"
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

                    <tfoot>
                        <tr>
                            <th colspan="8">{{ $authors->links() }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
