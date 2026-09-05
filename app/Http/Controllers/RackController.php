<?php

namespace App\Http\Controllers;

use App\Models\Rack;
use Illuminate\Http\Request;

class RackController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $items = Rack::latest()->search($search)->paginate(10);

        return view('racks.index', compact('items', 'search'));
    }

    public function create()
    {
        return view('racks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        Rack::create($request->all());

        return redirect()->route('racks.index')->with('success', 'Rak berhasil ditambahkan!');
    }

    public function show(Rack $rack)
    {
        return view('racks.show', compact('rack'));
    }

    public function edit(Rack $rack)
    {
        return view('racks.edit', compact('rack'));
    }

    public function update(Request $request, Rack $rack)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $rack->update($request->all());

        return redirect()->route('racks.index')->with('success', 'Rak berhasil diperbarui!');
    }

    public function destroy(Rack $rack)
    {
        $rack->delete();

        return redirect()->route('racks.index')->with('success', 'Rak berhasil dihapus!');
    }
}
