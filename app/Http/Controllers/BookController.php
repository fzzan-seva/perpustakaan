<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Book;
use App\Models\Category;
use App\Models\Author;
use App\Models\Publisher;
use App\Models\Rack;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $items = Book::latest()->search($search)->paginate(10);

        return view('books.index', compact('items', 'search'));
    }

    public function create()
    {
        $categories = Category::all();
        $authors = Author::all();
        $publishers = Publisher::all();
        $racks = Rack::all();

        return view('books.create', compact('categories', 'authors', 'publishers', 'racks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'isbn' => 'required|string|unique:books,isbn',
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'author_id' => 'nullable|exists:authors,id',
            'publisher_id' => 'required|exists:publishers,id',
            'rack_id' => 'required|exists:racks,id',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('books', 'public');
        }

        $book = Book::create($data);

        ActivityLog::log('create', 'Menambahkan buku: ' . $book->title, $book);

        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $categories = Category::all();
        $authors = Author::all();
        $publishers = Publisher::all();
        $racks = Rack::all();

        return view('books.edit', compact('book', 'categories', 'authors', 'publishers', 'racks'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'isbn' => 'required|string|unique:books,isbn,' . $book->id,
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'author_id' => 'nullable|exists:authors,id',
            'publisher_id' => 'required|exists:publishers,id',
            'rack_id' => 'required|exists:racks,id',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->except('cover_image');

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('books', 'public');
        }

        $book->update($data);

        ActivityLog::log('update', 'Mengubah buku: ' . $book->title, $book);

        return redirect()->route('books.index')->with('success', 'Buku berhasil diperbarui!');
    }

    public function destroy(Book $book)
    {
        ActivityLog::log('delete', 'Menghapus buku: ' . $book->title, $book);

        $book->delete();

        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus!');
    }
}
