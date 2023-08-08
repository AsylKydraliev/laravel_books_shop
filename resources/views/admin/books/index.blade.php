@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div>
                <h3>Books</h3>
                <a href="{{ route('create') }}" class="btn btn-outline-primary">Add book</a>
            </div>

            <div class="col">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
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
