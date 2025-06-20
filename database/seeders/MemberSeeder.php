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
        'date_of_birth',
        'membership_date',
        'membership_status',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'membership_date' => 'date',
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

    public function overdueBooks()
    {
        return $this->borrowings()->overdue();
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('membership_status', 'active');
    }

    public function scopeInactive($query)
    {
        return $query->where('membership_status', 'inactive');
    }

    public function scopeSuspended($query)
    {
        return $query->where('membership_status', 'suspended');
    }

    // Helper methods
    public function isActive()
    {
        return $this->membership_status === 'active';
    }

    public function getAgeAttribute()
    {
        return $this->date_of_birth ? $this->date_of_birth->age : null;
    }

    public function getMembershipDurationAttribute()
    {
        return $this->membership_date->diffForHumans();
    }

    public function getTotalBorrowingsAttribute()
    {
        return $this->borrowings()->count();
    }

    public function getActiveBorrowingsCountAttribute()
    {
        return $this->activeBorrowings()->count();
    }

    public function getTotalFinesAttribute()
    {
        return $this->borrowings()->whereNotNull('fine_amount')->sum('fine_amount');
    }

    public function getUnpaidFinesAttribute()
    {
        return $this->borrowings()
            ->whereNotNull('fine_amount')
            ->where('fine_paid', false)
            ->sum('fine_amount');
    }
}
