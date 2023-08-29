<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:update,book')->only('edit', 'update');
        $this->middleware('can:delete,book')->only('destroy');
    }

    public function index(Request $request)
    {
        $books = Book::query()
            ->with(['category', 'author'])
            ->filter($request->all())
            ->paginate(10)
            ->withQueryString();

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
     */
    public function edit(Book $book): \Illuminate\Foundation\Application|View|Factory|Application
    {
        $authors = Author::all();
        $categories = Category::all();
        $book->load('logs.user');

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
     */
    public function update(UpdateBookRequest $request, Book $book): RedirectResponse
    {
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
     */
    public function destroy(Book $book): RedirectResponse
    {
        $book->delete();

        return redirect()
            ->route('admin.books.index')
            ->with('status', "Book $book->title deleted successfully");
    }

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function history(): \Illuminate\Foundation\Application|View|Factory|Application
    {
        return view('history');
    }
}
