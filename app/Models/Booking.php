<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'student_level',
        'message',
        'locale',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
        ];
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeLatest($query)
    {
        return $query->orderByDesc('created_at');
    }

    public function isNew(): bool
    {
        return $this->status === 'pending';
    }
}
