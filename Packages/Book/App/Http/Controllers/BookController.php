<?php

declare(strict_types=1);

namespace Packages\Book\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Packages\Book\App\Models\Book;
use Packages\Book\App\Models\Pivots\BookUser;

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

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'author' => 'required',
            'status' => ['required', Rule::in(array_keys(BookUser::$statuses))],
        ], [], [
            'title' => 'titulo',
            'author' => 'autor',
            'status' => 'estado'
        ]);

        $book = Book::create($request->only(['author', 'title']));

        $book->users()->attach(current_user()->id, [
            'status' => $request->status
        ]);

        return redirect(route('book.index'))->with('success', 'A book was created');
    }

    public function edit(Book $book, Request $request)
    {
        $this->authorize('update', $book);
        // if ( !$book = $request->user()->books->find($book->id) ) {
        //     abort(403);
        // }

        return view('book::edit', [
            'book' => $request->user()->books->find($book->id)
        ]);
    }

    public function update(Request $request, Book $book)
    {
        $this->authorize('update', $book);
        // if ( !$book = $request->user()->books->find($book->id) ) {
        //     abort(403);
        // }

        $this->validate($request, [
            'title' => 'required',
            'author' => 'required',
            'status' => ['required', Rule::in(array_keys(BookUser::$statuses))],
        ], [], [
            'title' => 'titulo',
            'author' => 'autor',
            'status' => 'estado'
        ]);

        $book->update($request->only(['author', 'title']));

        $book->users()->updateExistingPivot(current_user()->id, [
            'status' => $request->status
        ]);

        return redirect(route('book.index'))->with('success', 'A book was edited');
    }
}
