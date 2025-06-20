<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'genre',
        'isbn',
        'description',
        'published_year',
        'total_copies',
        'available_copies',
    ];

    protected $casts = [
        'published_year' => 'integer',
        'total_copies' => 'integer',
        'available_copies' => 'integer',
    ];

    // Relationships
    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }

    public function activeBorrowings()
    {
        return $this->borrowings()->active();
    }

    public function overdueBorrowings()
    {
        return $this->borrowings()->overdue();
    }

    // Helper methods
    public function isAvailable()
    {
        return $this->available_copies > 0;
    }

    public function getBorrowedCopiesAttribute()
    {
        return $this->total_copies - $this->available_copies;
    }

    public function getUtilizationRateAttribute()
    {
        if ($this->total_copies == 0) {
            return 0;
        }

        return ($this->borrowed_copies / $this->total_copies) * 100;
    }
}
