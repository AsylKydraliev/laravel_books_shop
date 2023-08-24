<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function index(): \Illuminate\Foundation\Application|View|Factory|Application
    {
        $books = Book::query()
            ->with(['category', 'author'])
            ->paginate(10);

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
     * @param StoreBookRequest $request
     * @return RedirectResponse
     */
    public function store(StoreBookRequest $request): RedirectResponse
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
            ->route('admin.books.index')
            ->with('status', "Book: $book->title successfully created");
    }

    /**
     * @param Book $book
     * @return \Illuminate\Foundation\Application|View|Factory|Application
     * @throws AuthorizationException
     */
    public function edit(Book $book): \Illuminate\Foundation\Application|View|Factory|Application
    {
        $this->authorize('update', $book);
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
     * @param UpdateBookRequest $request
     * @param Book $book
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update(UpdateBookRequest $request, Book $book): RedirectResponse
    {
        $this->authorize('update', $book);
        $data = $request->all();
        $file = $request->file('image');

        if ($file) {
            $path = $file->store('images', 'public');
            $data['image'] = $path;
        }

        $book->update($data);

        return redirect()
            ->route('admin.books.index')
            ->with('status', "Book $book->title updated successfully");
    }

    /**
     * @param Book $book
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function destroy(Book $book): RedirectResponse
    {
        $this->authorize('delete', $book);
        $book->delete();

        return redirect()
            ->route('admin.books.index')
            ->with('status', "Book $book->title deleted successfully");
    }
}
