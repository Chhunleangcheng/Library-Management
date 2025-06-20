<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::query();

        if ($request->has('search') && $request->search) {
            $query->search($request->search);
        }

        if ($request->has('genre') && $request->genre) {
            $query->where('genre', $request->genre);
        }

        if ($request->has('availability') && $request->availability !== '') {
            if ($request->availability == '1') {
                $query->available();
            } else {
                $query->where('available_copies', 0);
            }
        }

        $books = $query->paginate(15);
        $genres = Book::distinct()->pluck('genre')->filter();

        return view('books.index', compact('books', 'genres'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(StoreBookRequest $request)
    {
        $book = Book::create($request->validated());

        return redirect()->route('books.index')
            ->with('success', 'Book created successfully.');
    }

    public function show(Book $book)
    {
        $book->load(['borrowings.member']);
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(UpdateBookRequest $request, Book $book)
    {
        $book->update($request->validated());

        return redirect()->route('books.index')
            ->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        if ($book->activeBorrowings()->count() > 0) {
            return redirect()->route('books.index')
                ->with('error', 'Cannot delete book with active borrowings.');
        }

        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Book deleted successfully.');
    }
}
