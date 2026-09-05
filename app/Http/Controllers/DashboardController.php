<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Member;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('siswa')) {
            return redirect()->route('catalog.index');
        }

        $totalBooks = Book::count();
        $totalMembers = Member::count();
        $activeBorrowings = Borrowing::where('status', 'borrowed')->count();
        $overdueBorrowings = Borrowing::where('status', 'overdue')->count();

        $recentActivities = ActivityLog::latest()->take(4)->get();

        $popularBooks = Book::withCount('borrowings')
            ->whereHas('borrowings')
            ->orderByDesc('borrowings_count')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalBooks',
            'totalMembers',
            'activeBorrowings',
            'overdueBorrowings',
            'recentActivities',
            'popularBooks'
        ));
    }
}
