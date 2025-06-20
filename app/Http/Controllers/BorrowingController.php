<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Book;
use App\Models\Member;
use App\Http\Requests\StoreBorrowingRequest;
use App\Http\Requests\UpdateBorrowingRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class BorrowingController extends Controller
{
    public function index(Request $request)
    {
        $query = Borrowing::with(['member', 'book']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->whereHas('member', function($mq) use ($search) {
                    $mq->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                })
                    ->orWhereHas('book', function($bq) use ($search) {
                        $bq->where('title', 'like', "%{$search}%")
                            ->orWhere('author', 'like', "%{$search}%");
                    });
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $status = $request->get('status');
            switch ($status) {
                case 'active':
                    $query->whereNull('returned_at');
                    break;
                case 'returned':
                    $query->whereNotNull('returned_at');
                    break;
                case 'overdue':
                    $query->whereNull('returned_at')
                        ->where('due_date', '<', now());
                    break;
            }
        }

        // Date range filter
        if ($request->filled('date_from')) {
            $query->whereDate('borrowed_at', '>=', $request->get('date_from'));
        }

        if ($request->filled('date_to')) {
            $query->whereDate('borrowed_at', '<=', $request->get('date_to'));
        }

        $borrowings = $query->orderBy('borrowed_at', 'desc')->paginate(15);

        // Calculate stats
        $stats = [
            'active_borrowings' => Borrowing::active()->count(),
            'overdue_borrowings' => Borrowing::overdue()->count(),
            'returned_today' => Borrowing::whereDate('returned_at', today())->count(),
            'total_fines' => Borrowing::whereNotNull('fine_amount')
                ->where('fine_paid', false)
                ->sum('fine_amount'),
        ];

        return view('borrowings.index', compact('borrowings', 'stats'));
    }

    public function create(Request $request)
    {
        $members = Member::active()->orderBy('name')->get();
        $books = Book::where('available_copies', '>', 0)->orderBy('title')->get();

        return view('borrowings.create', compact('members', 'books'));
    }

    public function store(StoreBorrowingRequest $request)
    {
        $borrowing = Borrowing::create($request->validated());

        // Update book availability
        $book = $borrowing->book;
        $book->decrement('available_copies');

        return redirect()
            ->route('borrowings.index')
            ->with('success', 'ការខ្ចីត្រូវបានបង្កើតដោយជោគជ័យ!');
    }

    public function show(Borrowing $borrowing)
    {
        $borrowing->load(['member', 'book']);
        return view('borrowings.show', compact('borrowing'));
    }

    public function edit(Borrowing $borrowing)
    {
        $members = Member::active()->orderBy('name')->get();
        $books = Book::orderBy('title')->get();

        return view('borrowings.edit', compact('borrowing', 'members', 'books'));
    }

    public function update(UpdateBorrowingRequest $request, Borrowing $borrowing)
    {
        $originalBookId = $borrowing->book_id;

        $borrowing->update($request->validated());

        // If book changed, update availability counts
        if ($originalBookId != $borrowing->book_id) {
            // Increment old book availability
            Book::find($originalBookId)->increment('available_copies');
            // Decrement new book availability
            $borrowing->book->decrement('available_copies');
        }

        return redirect()
            ->route('borrowings.show', $borrowing)
            ->with('success', 'ព័ត៌មានការខ្ចីត្រូវបានកែប្រែដោយជោគជ័យ!');
    }

    public function destroy(Borrowing $borrowing)
    {
        // If borrowing is not returned, increment book availability
        if (!$borrowing->returned_at) {
            $borrowing->book->increment('available_copies');
        }

        $borrowing->delete();

        return response()->json(['success' => true, 'message' => 'ការខ្ចីត្រូវបានលុបដោយជោគជ័យ!']);
    }

    public function returnBook(Borrowing $borrowing)
    {
        if ($borrowing->returned_at) {
            return response()->json(['success' => false, 'message' => 'សៀវភៅនេះត្រូវបានត្រឡប់រួចហើយ!']);
        }

        $borrowing->update([
            'returned_at' => now(),
        ]);

        // Increment book availability
        $borrowing->book->increment('available_copies');

        return response()->json(['success' => true, 'message' => 'សៀវភៅត្រូវបានត្រឡប់ដោយជោគជ័យ!']);
    }

    public function addFine(Request $request, Borrowing $borrowing)
    {
        $request->validate([
            'fine_amount' => 'required|numeric|min:0',
            'fine_paid' => 'boolean'
        ]);

        $borrowing->update([
            'fine_amount' => $request->fine_amount,
            'fine_paid' => $request->fine_paid ?? false,
        ]);

        return response()->json(['success' => true, 'message' => 'ការពិន័យត្រូវបានរក្សាទុកដោយជោគជ័យ!']);
    }

    public function extendDueDate(Request $request, Borrowing $borrowing)
    {
        $request->validate([
            'days' => 'required|integer|min:1|max:30'
        ]);

        $newDueDate = $borrowing->due_date->addDays($request->days);

        $borrowing->update([
            'due_date' => $newDueDate,
        ]);

        return response()->json(['success' => true, 'message' => 'កាលបរិច្ឆេទត្រូវបានបន្ថែមដោយជោគជ័យ!']);
    }

    public function apiShow(Borrowing $borrowing): JsonResponse
    {
        $borrowing->load(['member', 'book']);

        return response()->json($borrowing);
    }

    public function apiStats(): JsonResponse
    {
        $stats = [
            'active_borrowings' => Borrowing::active()->count(),
            'overdue_borrowings' => Borrowing::overdue()->count(),
            'returned_today' => Borrowing::whereDate('returned_at', today())->count(),
        ];

        return response()->json($stats);
    }

    public function exportPDF(Request $request)
    {
        $query = Borrowing::with(['member', 'book']);

        // Apply same filters as index
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->whereHas('member', function($mq) use ($search) {
                    $mq->where('name', 'like', "%{$search}%");
                })
                    ->orWhereHas('book', function($bq) use ($search) {
                        $bq->where('title', 'like', "%{$search}%");
                    });
            });
        }

        $borrowings = $query->orderBy('borrowed_at', 'desc')->get();

        $pdf = Pdf::loadView('borrowings.export-pdf', compact('borrowings'));

        return $pdf->download('borrowings-' . now()->format('Y-m-d') . '.pdf');
    }
}
