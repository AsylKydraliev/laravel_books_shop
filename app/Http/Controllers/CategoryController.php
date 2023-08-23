<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
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
     * @return Application|Factory|View|\Illuminate\Foundation\Application
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
     */
    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        $booksFromForm = $request->get('book_ids');

        if(in_array(0, $booksFromForm)) {
            $bookTitles = $request->input('book_titles');
            $bookDescriptions = $request->input('book_descriptions');
            $bookPrices = $request->input('book_prices');
            $bookAuthors = $request->input('book_authors');

            foreach ($bookTitles as $key => $title) {
                $description = $bookDescriptions[$key];
                $price = $bookPrices[$key];
                $authorId = $bookAuthors[$key];

                $data = [
                    'title' => $title,
                    'description' => $description,
                    'price' => intval($price),
                    'author_id' => intval($authorId),
                    'category_id' => $category->id,
                ];

                $book = new Book($data);
                $book->save();
            }
        } else {
            foreach ($booksFromForm as $key => $bookId) {
                if ($bookId != 0) {
                    $book = Book::find($bookId);
                    $book->update([
                        'title' => $request->input("book_title.$key"),
                        'description' => $request->input("book_description.$key"),
                        'price' => $request->input("book_price.$key"),
                        'author_id' => $request->input("book_author.$key"),
                    ]);
                }
            }
            $category->books()->whereNotIn('id', $booksFromForm)->delete();
            $category->update($request->all());
        }

        return redirect()
            ->route('admin.categories.index')
            ->with('status', "Category: $category->title updated successfully");
    }

    /**
     * @param Category $category
     * @return RedirectResponse
     */
    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('status', "Category $category->title updated successfully");
    }
}
