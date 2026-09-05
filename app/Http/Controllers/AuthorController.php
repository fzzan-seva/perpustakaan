<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $items = Author::latest()->search($search)->paginate(10);

        return view('authors.index', compact('items', 'search'));
    }

    public function create()
    {
        return view('authors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
        ]);

        $author = Author::create($request->all());

        ActivityLog::log('create', 'Menambahkan penulis: ' . $author->name, $author);

        return redirect()->route('authors.index')->with('success', 'Penulis berhasil ditambahkan!');
    }

    public function show(Author $author)
    {
        return view('authors.show', compact('author'));
    }

    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

    public function update(Request $request, Author $author)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
        ]);

        $author->update($request->all());

        ActivityLog::log('update', 'Mengubah penulis: ' . $author->name, $author);

        return redirect()->route('authors.index')->with('success', 'Penulis berhasil diperbarui!');
    }

    public function destroy(Author $author)
    {
        ActivityLog::log('delete', 'Menghapus penulis: ' . $author->name, $author);

        $author->delete();

        return redirect()->route('authors.index')->with('success', 'Penulis berhasil dihapus!');
    }
}
