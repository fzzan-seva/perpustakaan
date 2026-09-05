<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $categoryId = $request->category;

        $query = Book::with(['category', 'author', 'publisher'])
            ->where('stock', '>', 0);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('isbn', 'like', "%{$search}%")
                    ->orWhereHas('author', function ($q2) use ($search) {
                        $q2->where('name', 'like', "%{$search}%");
                    });
            });
        }

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        $books = $query->latest()->paginate(12);
        $categories = Category::withCount('books')->orderBy('name')->get();

        return view('catalog.index', compact('books', 'categories', 'search', 'categoryId'));
    }

    public function show(Book $book)
    {
        $book->load(['category', 'author', 'publisher', 'rack']);
        return view('catalog.show', compact('book'));
    }
}
