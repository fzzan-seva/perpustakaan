<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Borrowing;
use App\Models\Member;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowingController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $filter = $request->filter;

        $query = Borrowing::with(['member', 'book'])->latest();

        if ($filter === 'pending') {
            $query->where('status', 'pending');
        } elseif ($filter === 'active') {
            $query->whereIn('status', ['borrowed', 'overdue']);
        } elseif ($filter === 'returned') {
            $query->where('status', 'returned');
        } elseif ($filter === 'rejected') {
            $query->where('status', 'rejected');
        }

        $items = $query->search($search)->paginate(10);

        return view('borrowings.index', compact('items', 'search', 'filter'));
    }

    public function create()
    {
        $members = Member::all();
        $books = Book::where('stock', '>', 0)->get();

        return view('borrowings.create', compact('members', 'books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'book_id' => 'required|exists:books,id',
            'borrow_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:borrow_date',
            'notes' => 'nullable|string',
        ]);

        $book = Book::findOrFail($request->book_id);

        if ($book->stock <= 0) {
            return redirect()->back()->with('error', 'Buku tidak tersedia!');
        }

        $borrowing = Borrowing::create($request->all());
        $book->decrement('stock');

        $borrowing->load(['member', 'book']);
        ActivityLog::log('borrow', 'Peminjaman buku: ' . $borrowing->book->title . ' oleh ' . $borrowing->member->name, $borrowing);

        return redirect()->route('borrowings.index')->with('success', 'Peminjaman berhasil ditambahkan!');
    }

    public function show(Borrowing $borrowing)
    {
        $borrowing->load(['member', 'book', 'returnRecord', 'confirmedBy', 'rejectedBy']);
        return view('borrowings.show', compact('borrowing'));
    }

    public function edit(Borrowing $borrowing)
    {
        $members = Member::all();
        $books = Book::all();

        return view('borrowings.edit', compact('borrowing', 'members', 'books'));
    }

    public function update(Request $request, Borrowing $borrowing)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'book_id' => 'required|exists:books,id',
            'borrow_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:borrow_date',
            'status' => 'required|string|in:pending,borrowed,returned,overdue,rejected',
            'notes' => 'nullable|string',
        ]);

        $borrowing->update($request->all());

        $borrowing->load(['member', 'book']);
        ActivityLog::log('borrow', 'Peminjaman buku: ' . $borrowing->book->title . ' oleh ' . $borrowing->member->name, $borrowing);

        return redirect()->route('borrowings.index')->with('success', 'Peminjaman berhasil diperbarui!');
    }

    public function destroy(Borrowing $borrowing)
    {
        if ($borrowing->status === 'borrowed') {
            $borrowing->book->increment('stock');
        }

        $borrowing->load(['member', 'book']);
        ActivityLog::log('delete', 'Menghapus peminjaman buku: ' . $borrowing->book->title . ' oleh ' . $borrowing->member->name, $borrowing);

        $borrowing->delete();

        return redirect()->route('borrowings.index')->with('success', 'Peminjaman berhasil dihapus!');
    }

    public function requestBorrow(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'notes' => 'nullable|string',
        ]);

        $user = Auth::user();
        $member = $user->member;

        if (!$member) {
            $member = Member::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'nis' => 'AUTO-' . $user->id,
            ]);
        }

        $book = Book::findOrFail($request->book_id);

        if ($book->stock <= 0) {
            return redirect()->back()->with('error', 'Buku tidak tersedia!');
        }

        $activePinjam = Borrowing::where('member_id', $member->id)
            ->whereIn('status', ['pending', 'borrowed', 'overdue'])
            ->where('book_id', $book->id)
            ->exists();

        if ($activePinjam) {
            return redirect()->back()->with('error', 'Anda masih memiliki peminjaman aktif untuk buku ini!');
        }

        $borrowing = Borrowing::create([
            'member_id' => $member->id,
            'book_id' => $book->id,
            'borrow_date' => now(),
            'due_date' => now()->addDays(7),
            'status' => 'pending',
            'notes' => $request->notes,
            'requested_at' => now(),
        ]);

        $borrowing->load(['member', 'book']);
        ActivityLog::log('borrow', 'Pengajuan peminjaman buku: ' . $borrowing->book->title . ' oleh ' . $borrowing->member->name, $borrowing);

        return redirect()->route('borrowings.history')->with('success', 'Pengajuan peminjaman berhasil dikirim! Menunggu konfirmasi admin.');
    }

    public function confirm(Borrowing $borrowing)
    {
        if ($borrowing->status !== 'pending') {
            return redirect()->back()->with('error', 'Peminjaman ini sudah diproses.');
        }

        $book = $borrowing->book;
        if ($book->stock <= 0) {
            return redirect()->back()->with('error', 'Stok buku tidak mencukupi!');
        }

        $borrowing->update([
            'status' => 'borrowed',
            'confirmed_at' => now(),
            'confirmed_by' => Auth::id(),
        ]);

        $book->decrement('stock');

        $borrowing->load(['member', 'book']);
        ActivityLog::log('borrow', 'Konfirmasi peminjaman buku: ' . $borrowing->book->title . ' oleh ' . $borrowing->member->name, $borrowing);

        return redirect()->route('borrowings.index')->with('success', 'Peminjaman berhasil dikonfirmasi!');
    }

    public function reject(Request $request, Borrowing $borrowing)
    {
        if ($borrowing->status !== 'pending') {
            return redirect()->back()->with('error', 'Peminjaman ini sudah diproses.');
        }

        $request->validate([
            'rejection_reason' => 'nullable|string',
        ]);

        $borrowing->update([
            'status' => 'rejected',
            'rejected_at' => now(),
            'rejected_by' => Auth::id(),
            'rejection_reason' => $request->rejection_reason,
        ]);

        $borrowing->load(['member', 'book']);
        ActivityLog::log('borrow', 'Penolakan peminjaman buku: ' . $borrowing->book->title . ' oleh ' . $borrowing->member->name, $borrowing);

        return redirect()->route('borrowings.index')->with('success', 'Peminjaman berhasil ditolak.');
    }
}
