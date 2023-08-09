<?php

declare(strict_types=1);

namespace Packages\Book\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Packages\Book\App\Http\Requests\BookStoreRequest;
use Packages\Book\App\Http\Requests\BookUpdateRequest;
use Packages\Book\App\Models\Book;

final class BookController extends Controller
{
    public function index(Request $request)
    {
        return view('book::index', [
            'booksByStatuses' => $request->user()->books->groupBy('pivot.status')
        ]);
    }

    public function create()
    {
        return view('book::create');
    }

    public function store(BookStoreRequest $request)
    {
        $book = Book::create($request->only(['author', 'title']));

        $book->users()->attach(current_user()->id, [
            'status' => $request->status
        ]);

        return redirect(route('book.index'))->with('success', 'A book was created');
    }

    public function edit(Request $request, Book $book)
    {
        $this->authorize('update', $book);

        return view('book::edit', [
            'book' => $request->user()->books->find($book->id)
        ]);
    }

    public function update(BookUpdateRequest $request, Book $book)
    {
        $book->update($request->only(['author', 'title']));

        $book->users()->updateExistingPivot(current_user()->id, [
            'status' => $request->status
        ]);

        return redirect(route('book.index'))->with('success', 'A book was edited');
    }
}
