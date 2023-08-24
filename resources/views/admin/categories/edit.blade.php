@extends('layouts.admin')

@section('content')
    <div class="container">
        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-primary mb-3">&lang; Back</a>
        <div class="row mb-5">
            <form
                action="{{ route('admin.categories.update', ['category' => $category]) }}"
                method="post"
            >
                @csrf
                @method('PUT')

                <h4>Edit category</h4>
                <hr>
                <div class="mb-3">
                    <x-base-input
                        type="text"
                        id="title"
                        name="title"
                        label="Title"
                        :value="old('title') ?? $category->title"
                    />
                </div>

                <div class="mb-3">
                    <x-base-textarea
                        id="description"
                        label="Description"
                        name="description"
                        :value="old('description') ?? $category->description"
                    />
                </div>

                <div>
                    <h4>Books</h4>
                    <hr>

                    <div class="col">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">
                                    Title
                                    <x-base-input
                                        type="text"
                                        id="book_title"
                                        name="new_book_title"
                                    />
                                </th>
                                <th scope="col">
                                    Description
                                    <x-base-textarea
                                        id="book_description"
                                        name="new_book_description"
                                        cols="70"
                                        rows="1"
                                    />
                                </th>
                                <th scope="col">
                                    Price
                                    <x-base-input
                                        type="number"
                                        id="book_price"
                                        name="new_book_price"
                                    />
                                </th>
                                <th scope="col">
                                    Author
                                    <x-base-select
                                        id="book_author"
                                        name="new_book_author"
                                    >
                                        <option value="" disabled selected>Select author</option>
                                        @foreach($authors as $option)
                                            <option
                                                value="{{ $option->id }}"
                                            >
                                                {{ $option->name }}
                                            </option>
                                        @endforeach
                                    </x-base-select>
                                </th>
                                <th scope="col">
                                    Actions
                                    <button type="button" class="btn btn-light add-book">
                                        <i class="bi bi-plus-lg fs-4"></i>
                                    </button>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($category->books as $key => $book)
                                <tr class="book-row">
                                    <th scope="row">{{ $book->id }}</th>
                                    <td>
                                        <x-base-input
                                            type="text"
                                            name="book_title[]"
                                            value="{{ old('book_title.'.$key) ?? $book->title }}"
                                        />
                                    </td>
                                    <td>
                                        <x-base-textarea
                                            name="book_description"
                                            cols="70"
                                            rows="3"
                                            value="{{ old('book_description.'.$key) ?? $book->description }}"
                                        />
                                    </td>
                                    <td>
                                        <x-base-input
                                            type="number"
                                            name="book_price[]"
                                            value="{{ old('book_price.'.$key) ?? $book->price }}"
                                        />
                                    </td>
                                    <td>
                                        <x-base-select
                                            id="author"
                                            name="book_author[]"
                                        >
                                            <option value="" disabled selected>Select author</option>
                                            @foreach($authors as $option)
                                                <option
                                                    value="{{ $option->id }}"
                                                    @if ($book->author && $book->author->id == $option->id) selected @endif
                                                >
                                                    {{ $option->name }}
                                                </option>
                                            @endforeach
                                        </x-base-select>
                                    </td>

                                   <input type="hidden" name="book_ids[]" value="{{ $book->id ?? 0 }}"/>

                                    <td>
                                        <button class="btn btn-light delete-book">
                                            <i class="bi bi-trash fs-5"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Edit</button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/categories/edit.js'])
@endpush
