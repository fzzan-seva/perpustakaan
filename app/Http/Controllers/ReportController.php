<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Category;
use App\Models\Member;
use App\Models\ReturnRecord;

class ReportController extends Controller
{
    public function index()
    {
        $totalBooks = Book::count();
        $totalMembers = Member::count();
        $totalBorrowings = Borrowing::count();
        $totalReturns = ReturnRecord::count();

        $activeBorrowings = Borrowing::where('status', 'borrowed')->count();
        $overdueBorrowings = Borrowing::where('status', 'overdue')->count();

        $popularBooks = Book::withCount('borrowings')
            ->orderByDesc('borrowings_count')
            ->take(10)
            ->get();

        $booksByCategory = Category::withCount('books')
            ->orderByDesc('books_count')
            ->get();

        $monthlyBorrowings = Borrowing::where('borrow_date', '>=', now()->subMonths(6))
            ->get(['borrow_date'])
            ->groupBy(fn ($item) => $item->borrow_date->format('Y-m'))
            ->map(fn ($group) => (object) [
                'month' => $group->first()->borrow_date->format('Y-m'),
                'count' => $group->count(),
            ])
            ->sortKeys()
            ->values();

        $recentBorrowings = Borrowing::with(['member', 'book'])
            ->latest()
            ->take(5)
            ->get();

        return view('reports.index', compact(
            'totalBooks',
            'totalMembers',
            'totalBorrowings',
            'totalReturns',
            'activeBorrowings',
            'overdueBorrowings',
            'popularBooks',
            'booksByCategory',
            'monthlyBorrowings',
            'recentBorrowings'
        ));
    }
}
