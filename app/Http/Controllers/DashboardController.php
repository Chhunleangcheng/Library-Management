<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use App\Models\Borrowing;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_books' => Book::count(),
            'total_members' => Member::where('membership_status', 'active')->count(),
            'total_borrowed' => Borrowing::active()->count(),
            'overdue_books' => Borrowing::overdue()->count(),
            'available_books' => Book::sum('available_copies'),
            'total_fines' => Borrowing::whereNotNull('fine_amount')
                ->where('fine_paid', false)
                ->sum('fine_amount'),
            'books_returned_today' => Borrowing::whereDate('returned_at', today())->count(),
            'new_members_this_month' => Member::whereMonth('membership_date', now()->month)
                ->whereYear('membership_date', now()->year)
                ->count(),
        ];

        $recent_borrowings = Borrowing::with(['member', 'book'])
            ->latest('borrowed_at')
            ->take(10)
            ->get();

        $overdue_borrowings = Borrowing::overdue()
            ->with(['member', 'book'])
            ->orderBy('due_date', 'asc')
            ->take(5)
            ->get();

        // Calculate additional metrics
        $stats['avg_books_per_member'] = $stats['total_members'] > 0
            ? round($stats['total_borrowed'] / $stats['total_members'], 1)
            : 0;

        $stats['books_due_soon'] = Borrowing::active()
            ->whereBetween('due_date', [now(), now()->addDays(3)])
            ->count();

        return view('dashboard', compact('stats', 'recent_borrowings', 'overdue_borrowings'));
    }
}
