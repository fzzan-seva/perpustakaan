<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $items = Publisher::latest()->search($search)->paginate(10);

        return view('publishers.index', compact('items', 'search'));
    }

    public function create()
    {
        return view('publishers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
        ]);

        Publisher::create($request->all());

        return redirect()->route('publishers.index')->with('success', 'Penerbit berhasil ditambahkan!');
    }

    public function show(Publisher $publisher)
    {
        return view('publishers.show', compact('publisher'));
    }

    public function edit(Publisher $publisher)
    {
        return view('publishers.edit', compact('publisher'));
    }

    public function update(Request $request, Publisher $publisher)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
        ]);

        $publisher->update($request->all());

        return redirect()->route('publishers.index')->with('success', 'Penerbit berhasil diperbarui!');
    }

    public function destroy(Publisher $publisher)
    {
        $publisher->delete();

        return redirect()->route('publishers.index')->with('success', 'Penerbit berhasil dihapus!');
    }
}
