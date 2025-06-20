<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'membership_date',
        'membership_status'
    ];

    protected $casts = [
        'membership_date' => 'date'
    ];

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }

    public function activeBorrowings()
    {
        return $this->hasMany(Borrowing::class)->whereNull('returned_at');
    }

    public function getTotalFinesAttribute()
    {
        return $this->borrowings()
            ->whereNotNull('fine_amount')
            ->where('fine_paid', false)
            ->sum('fine_amount');
    }

    public function scopeActive($query)
    {
        return $query->where('membership_status', 'active');
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('name', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->orWhere('phone', 'LIKE', "%{$search}%");
        });
    }
}
