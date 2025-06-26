<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\BorrowingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Books routes
    Route::resource('books', BookController::class);

    // Member routes
    Route::resource('members', MemberController::class);
    Route::get('/members/{member}/export-history', [MemberController::class, 'exportHistory'])->name('members.export-history');

    // Borrowing routes
    Route::resource('borrowings', BorrowingController::class);
    Route::patch('/borrowings/{borrowing}/return', [BorrowingController::class, 'returnBook'])->name('borrowings.return');
    Route::post('/borrowings/{borrowing}/fine', [BorrowingController::class, 'addFine'])->name('borrowings.fine');
    Route::post('/borrowings/{borrowing}/extend', [BorrowingController::class, 'extendDueDate'])->name('borrowings.extend');
    Route::get('/borrowings/export/pdf', [BorrowingController::class, 'exportPDF'])->name('borrowings.export.pdf');

    // API routes for AJAX calls
    Route::get('/api/borrowings/{borrowing}', [BorrowingController::class, 'apiShow']);
    Route::get('/api/borrowings/stats', [BorrowingController::class, 'apiStats']);
});

require __DIR__.'/auth.php';
