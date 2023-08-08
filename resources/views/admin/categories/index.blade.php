@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div>
                <h3>Genres</h3>
                <a href="{{ route('categories.create') }}" class="btn btn-outline-primary">Add genre</a>
            </div>

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
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>
                            <a href="{{ '/' }}" class="btn btn-warning">Edit</a>

                            <form
                                action="{{ '/' }}"
                                method="post"
                                class="d-inline-block"
                            >
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
