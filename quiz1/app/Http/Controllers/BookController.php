<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    // show book
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }
    

    // create book
    public function create()
    {
        return view('books.create');
    }

    // post to db
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'published_year' => 'required|integer',
        ]);

        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'published_year' => $request->published_year,
        ]);

        return redirect()->route('books.index')->with('success', 'Book added successfully!');
    }


}
