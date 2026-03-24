<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TestimonialPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'locale',
        'name',
        'role',
        'body',
        'rating',
        'is_visible',
        'display_order',
    ];

    protected $casts = [
        'is_visible' => 'boolean',
        'rating' => 'integer',
        'display_order' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }

    public function scopeForLocale($query, string $locale)
    {
        return $query->where('locale', $locale);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order', 'asc')->orderBy('created_at', 'desc');
    }
}
