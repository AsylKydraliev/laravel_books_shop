@extends('layouts.app')

@section('content')
    <div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="col">
                    <table class="table align-middle">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Price</th>
                            <th scope="col">Category</th>
                            <th scope="col">Author</th>
                            <th scope="col">Image</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($books as $book)
                            <tr>
                                <th scope="row">{{ $book->id }}</th>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->description }}</td>
                                <td>{{ $book->price }}</td>
                                                                <td>{{ $book->category->title ?? 'not category' }}</td>
                                                                <td>{{ $book->author->name ?? 'not author' }}</td>
                                <td>
                                    @if($book->image)
                                        <img
                                            width="100"
                                            src="{{ str_contains($book->image, 'images') ? "/storage/$book->image" : $book->image }}"
                                            alt="{{ $book->title }}"
                                        />
                                    @else
                                        No image
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="8">{{ $books->links() }}</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
