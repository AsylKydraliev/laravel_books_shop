<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Models\Author;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function index(): \Illuminate\Foundation\Application|View|Factory|Application
    {
        $authors = Author::paginate(10);
        return view(
            'admin.authors.index',
            compact('authors')
        );
    }

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function create(): \Illuminate\Foundation\Application|View|Factory|Application
    {
        return view('admin.authors.create');
    }

    /**
     * @param AuthorRequest $request
     * @return RedirectResponse
     */
    public function store(AuthorRequest $request): RedirectResponse
    {
        $data = $request->all();
        $file = $request->file('image');

        if($file) {
            $path = $file->store('images', 'public');
            $data['image'] = $path;
        }

        $author = new Author($data);
        $author->user_id = Auth::id();
        $author->save();

        return redirect()
            ->route('admin.authors.index')
            ->with('status', "Author: $author->name successfully created");
    }

    /**
     * @param Author $author
     * @return \Illuminate\Foundation\Application|View|Factory|Application
     * @throws AuthorizationException
     */
    public function edit(Author $author): \Illuminate\Foundation\Application|View|Factory|Application
    {
        $this->authorize('update', $author);
        return view('admin.authors.edit', compact('author'));
    }

    /**
     * @param AuthorRequest $request
     * @param Author $author
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update(AuthorRequest $request, Author $author): RedirectResponse
    {
        $this->authorize('update', $author);
        $data = $request->all();
        $file = $request->file('image');

        if($file) {
            $path = $file->store('images', 'public');
            $data['image'] = $path;
        }

        $author->update($data);

        return redirect()
            ->route('admin.authors.index')
            ->with('status', "Author $author->name updated successfully");
    }

    /**
     * @param Author $author
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function destroy(Author $author): RedirectResponse
    {
        $this->authorize('delete', $author);
        $author->delete();

        return redirect()
            ->route('admin.authors.index')
            ->with('status', "Author $author->name deleted successfully");
    }
}
