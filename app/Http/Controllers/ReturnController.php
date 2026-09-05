<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\ReturnRecord;
use App\Models\Borrowing;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $items = ReturnRecord::with(['borrowing.member', 'borrowing.book'])->latest()->search($search)->paginate(10);

        return view('returns.index', compact('items', 'search'));
    }

    public function create()
    {
        $borrowings = Borrowing::where('status', 'borrowed')->with(['member', 'book'])->get();

        return view('returns.create', compact('borrowings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'borrowing_id' => 'required|exists:borrowings,id',
            'return_date' => 'required|date',
            'condition' => 'required|string|in:good,damaged,lost',
            'notes' => 'nullable|string',
        ]);

        $borrowing = Borrowing::findOrFail($request->borrowing_id);
        $borrowing->update(['status' => 'returned']);
        $borrowing->book->increment('stock');

        $returnRecord = ReturnRecord::create($request->all());

        $borrowing->load(['member', 'book']);
        ActivityLog::log('return', 'Pengembalian buku: ' . $borrowing->book->title . ' dari ' . $borrowing->member->name, $returnRecord);

        return redirect()->route('returns.index')->with('success', 'Pengembalian berhasil diproses!');
    }

    public function show(ReturnRecord $return)
    {
        $return->load(['borrowing.member', 'borrowing.book']);
        return view('returns.show', compact('return'));
    }

    public function edit(ReturnRecord $return)
    {
        $borrowings = Borrowing::all();

        return view('returns.edit', compact('return', 'borrowings'));
    }

    public function update(Request $request, ReturnRecord $return)
    {
        $request->validate([
            'borrowing_id' => 'required|exists:borrowings,id',
            'return_date' => 'required|date',
            'condition' => 'required|string|in:good,damaged,lost',
            'notes' => 'nullable|string',
        ]);

        $return->update($request->all());

        $return->load(['borrowing.member', 'borrowing.book']);
        ActivityLog::log('return', 'Pengembalian buku: ' . $return->borrowing->book->title . ' dari ' . $return->borrowing->member->name, $return);

        return redirect()->route('returns.index')->with('success', 'Pengembalian berhasil diperbarui!');
    }

    public function destroy(ReturnRecord $return)
    {
        $return->load(['borrowing.member', 'borrowing.book']);
        ActivityLog::log('delete', 'Menghapus pengembalian buku: ' . $return->borrowing->book->title . ' dari ' . $return->borrowing->member->name, $return);

        $return->delete();

        return redirect()->route('returns.index')->with('success', 'Pengembalian berhasil dihapus!');
    }
}
