<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MindMap extends Model
{
    protected $fillable = [
        'slug',
        'title_en',
        'title_fr',
        'description_en',
        'description_fr',
        'group',
        'level',
        'topic_en',
        'topic_fr',
        'preview_image',
        'file_path',
        'is_published',
        'sort_order',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'sort_order'   => 'integer',
    ];

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('title_en');
    }

    public function title(string $locale = 'en'): string
    {
        return $locale === 'fr' ? ($this->title_fr ?: $this->title_en) : ($this->title_en ?: $this->title_fr);
    }

    public function description(string $locale = 'en'): ?string
    {
        return $locale === 'fr' ? ($this->description_fr ?: $this->description_en) : ($this->description_en ?: $this->description_fr);
    }

    public function topic(string $locale = 'en'): ?string
    {
        return $locale === 'fr' ? ($this->topic_fr ?: $this->topic_en) : ($this->topic_en ?: $this->topic_fr);
    }

    protected static function booted(): void
    {
        static::creating(function (MindMap $map) {
            if (empty($map->slug)) {
                $map->slug = Str::slug($map->title_en);
            }
        });
    }
}
