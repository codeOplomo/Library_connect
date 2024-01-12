<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $books = Book::all();
        return view('dashboard.dashbook', compact('books'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'type' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'publication_year' => 'required',
            'available_copies' => 'required',
            'total_copies' => 'required',
        ]);

        // Handle image upload
        $imagePath = $request->file('image')->store('images', 'public');

        // Use only the relative path for the image attribute
        $imagePath = str_replace('public/', '', $imagePath);

        Book::create([
            'title' => $request->input('title'),
            'author' => $request->input('author'),
            'type' => $request->input('type'),
            'description' => $request->input('description'),
            'image' => $imagePath,
            'publication_year' => $request->input('publication_year'),
            'available_copies' => $request->input('available_copies'),
            'total_copies' => $request->input('total_copies'),
        ]);


        return redirect()->route('dashbook')->with('success', 'Book created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id); // Retrieve book by ID
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'type' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'publication_year' => 'required',
            'available_copies' => 'required',
            'total_copies' => 'required',
        ]);

        // Handle image upload
        $imagePath = $book->image;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        $book->update([
            'title' => $request->input('title'),
            'author' => $request->input('author'),
            'type' => $request->input('type'),
            'description' => $request->input('description'),
            'image' => $imagePath,
            'publication_year' => $request->input('publication_year'),
            'available_copies' => $request->input('available_copies'),
            'total_copies' => $request->input('total_copies'),
        ]);

        return redirect()->route('dashbook')->with('success', 'Book updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully');
    }
    
}



