<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class BookController extends Controller
{
    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function index(): \Illuminate\Foundation\Application|View|Factory|Application
    {
        $books = Book::all();
        return view(
            'admin.books.index',
            compact('books')
        );
    }

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function create(): \Illuminate\Foundation\Application|View|Factory|Application
    {
        $authors = Author::all();
        $categories = Category::all();

        return view('admin.books.create', [
            'authors' => $authors,
            'categories' => $categories,
        ]);
    }

    /**
     * @param BookRequest $request
     * @return RedirectResponse
     */
    public function store(BookRequest $request): RedirectResponse
    {
        $data = $request->all();
        $file = $request->file('image');

        if ($file) {
            $path = $file->store('images', 'public');
            $data['image'] = $path;
        }

        $book = new Book($data);
        $book->save();

        return redirect()
            ->route('books.index')
            ->with('status', "Book: $book->title successfully created");
    }

    /**
     * @param Book $book
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(Book $book): \Illuminate\Foundation\Application|View|Factory|Application
    {
        $authors = Author::all();
        $categories = Category::all();

        return view('admin.books.edit', compact(
                'book',
                'authors',
                'categories'
            )
        );
    }

    /**
     * @param BookRequest $request
     * @param Book $book
     * @return RedirectResponse
     */
    public function update(BookRequest $request, Book $book): RedirectResponse
    {
        $data = $request->all();
        $file = $request->file('image');

        if ($file) {
            $path = $file->store('images', 'public');
            $data['image'] = $path;
        }

        $book->update($data);

        return redirect()
            ->route('books.index')
            ->with('status', "Book $book->title updated successfully");
    }

    /**
     * @param Book $book
     * @return RedirectResponse
     */
    public function destroy(Book $book): RedirectResponse
    {
        $book->delete();

        return redirect()
            ->route('books.index')
            ->with('status', "Book $book->title deleted successfully");
    }
}
