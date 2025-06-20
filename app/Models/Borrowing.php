<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Borrowing extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'book_id',
        'borrowed_at',
        'due_date',
        'returned_at',
        'fine_amount',
        'fine_paid',
    ];

    protected $casts = [
        'borrowed_at' => 'datetime',
        'due_date' => 'datetime',
        'returned_at' => 'datetime',
        'fine_paid' => 'boolean',
        'fine_amount' => 'decimal:2',
    ];

    // Relationships
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->whereNull('returned_at');
    }

    public function scopeOverdue($query)
    {
        return $query->whereNull('returned_at')
            ->where('due_date', '<', now());
    }

    public function scopeReturned($query)
    {
        return $query->whereNotNull('returned_at');
    }

    // Helper methods
    public function isOverdue()
    {
        return !$this->returned_at && $this->due_date->isPast();
    }

    public function getDaysOverdueAttribute()
    {
        if (!$this->isOverdue()) {
            return 0;
        }

        return $this->due_date->diffInDays(now());
    }

    public function calculateFine($ratePerDay = 1.00)
    {
        if (!$this->isOverdue()) {
            return 0;
        }

        return $this->days_overdue * $ratePerDay;
    }

    public function getStatusAttribute()
    {
        if ($this->returned_at) {
            return 'returned';
        }

        if ($this->isOverdue()) {
            return 'overdue';
        }

        return 'active';
    }
}
