<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Borrowing;
use App\Models\Book;
use App\Models\Member;
use Carbon\Carbon;

class BorrowingSeeder extends Seeder
{
    public function run(): void
    {
        $members = Member::all();
        $books = Book::all();

        // Create some active borrowings
        for ($i = 0; $i < 8; $i++) {
            $member = $members->random();
            $book = $books->random();

            $borrowedAt = Carbon::now()->subDays(rand(1, 10));
            $dueDate = $borrowedAt->copy()->addWeeks(2);

            Borrowing::create([
                'member_id' => $member->id,
                'book_id' => $book->id,
                'borrowed_at' => $borrowedAt,
                'due_date' => $dueDate,
                'returned_at' => null,
            ]);

            // Update book availability
            $book->decrement('available_copies');
        }

        // Create some overdue borrowings
        for ($i = 0; $i < 3; $i++) {
            $member = $members->random();
            $book = $books->random();

            $borrowedAt = Carbon::now()->subDays(rand(20, 40));
            $dueDate = $borrowedAt->copy()->addWeeks(2);

            $borrowing = Borrowing::create([
                'member_id' => $member->id,
                'book_id' => $book->id,
                'borrowed_at' => $borrowedAt,
                'due_date' => $dueDate,
                'returned_at' => null,
            ]);

            // Calculate and set fine
            $borrowing->fine_amount = $borrowing->calculateFine();
            $borrowing->save();

            // Update book availability
            $book->decrement('available_copies');
        }

        // Create some returned borrowings
        for ($i = 0; $i < 10; $i++) {
            $member = $members->random();
            $book = $books->random();

            $borrowedAt = Carbon::now()->subDays(rand(30, 90));
            $dueDate = $borrowedAt->copy()->addWeeks(2);
            $returnedAt = $borrowedAt->copy()->addDays(rand(10, 25));

            $borrowing = Borrowing::create([
                'member_id' => $member->id,
                'book_id' => $book->id,
                'borrowed_at' => $borrowedAt,
                'due_date' => $dueDate,
                'returned_at' => $returnedAt,
            ]);

            // Calculate fine if returned late
            if ($returnedAt->gt($dueDate)) {
                $daysLate = $returnedAt->diffInDays($dueDate);
                $borrowing->fine_amount = $daysLate * 1.00;
                $borrowing->fine_paid = rand(0, 1) == 1; // Randomly set as paid or unpaid
                $borrowing->save();
            }
        }
    }
}
