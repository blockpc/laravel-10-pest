<?php

declare(strict_types=1);

namespace Packages\Book\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Packages\Book\App\Models\Book;

final class BookController extends Controller
{
    public function index()
    {
        return view('book::index');
    }

    public function create()
    {
        return view('book::create');
    }

    public function store(Request $request)
    {
        $book = Book::create($request->all());

        $book->users()->attach(current_user()->id, [
            'status' => $request->status
        ]);

        return redirect()->route('book.index')->with('success', 'A book was created');
    }
}
