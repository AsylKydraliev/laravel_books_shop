<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function index(): \Illuminate\Foundation\Application|View|Factory|Application
    {
        $categories = Category::paginate(10);

        return view(
            'admin.categories.index',
            compact('categories')
        );
    }

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function create(): \Illuminate\Foundation\Application|View|Factory|Application
    {
        return view('admin.categories.create');
    }

    /**
     * @param CategoryRequest $request
     * @return RedirectResponse
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        $category = new Category($request->all());
        $category->save();

        return redirect()
            ->route('admin.categories.index')
            ->with('status', "Category: $category->title successfully created");
    }

    /**
     * @param Category $category
     * @return \Illuminate\Foundation\Application|View|Factory|Application
     */
    public function edit(Category $category): \Illuminate\Foundation\Application|View|Factory|Application
    {
        $authors = Author::all();
        $category->load('books.author');

        return view('admin.categories.edit', compact('category', 'authors'));
    }

    /**
     * @param CategoryRequest $request
     * @param Category $category
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        $this->authorize('update', $category);
        $currentBookIds = $category->books()->pluck('id')->toArray();
        $booksFromForm = $request->input('book_ids');
        $booksToInsert = [];

        foreach ($booksFromForm as $key => $bookId) {
            $data = [
                'title' => $request->input("book_title.$key"),
                'description' => $request->input("book_description.$key"),
                'price' => intval($request->input("book_price.$key")),
                'author_id' => intval($request->input("book_author.$key")),
            ];

            if ($bookId == 0) {
                $booksToInsert[] = $data;
            } else {
                $book = Book::find($bookId);
                $book->update($data);
            }
        }

        if (!empty($booksToInsert)) {
            $category->books()->createMany($booksToInsert);
        }

        $differenceIds = array_diff($currentBookIds, $booksFromForm);

        if (!empty($differenceIds)) {
            $category->books()->whereIn('id', $differenceIds)->delete();
        }

        $category->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        return redirect()
            ->route('admin.categories.index')
            ->with('status', "Category: $category->title updated successfully");
    }

    /**
     * @param Category $category
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function destroy(Category $category): RedirectResponse
    {
        $this->authorize('delete', $category);
        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('status', "Category $category->title updated successfully");
    }
}
