<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'title_en',
        'title_fr',
        'description_en',
        'description_fr',
        'video_url',
        'level',
        'topic_en',
        'topic_fr',
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

    public function videoSource(): string
    {
        $url = $this->video_url ?? '';

        if (str_contains($url, 'youtube.com') || str_contains($url, 'youtu.be')) {
            return 'youtube';
        }

        if (str_contains($url, 'vimeo.com')) {
            return 'vimeo';
        }

        return 'unknown';
    }

    public function youtubeId(): ?string
    {
        $url = $this->video_url ?? '';

        if (preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|v\/|shorts\/))([A-Za-z0-9_-]{11})/', $url, $m)) {
            return $m[1];
        }

        return null;
    }

    public function vimeoId(): ?string
    {
        $url = $this->video_url ?? '';

        if (preg_match('/vimeo\.com\/(?:video\/)?(\d+)/', $url, $m)) {
            return $m[1];
        }

        return null;
    }

    public function embedUrl(): ?string
    {
        return match ($this->videoSource()) {
            'youtube' => ($id = $this->youtubeId()) ? "https://www.youtube.com/embed/{$id}" : null,
            'vimeo'   => ($id = $this->vimeoId())   ? "https://player.vimeo.com/video/{$id}" : null,
            default   => null,
        };
    }

    public function thumbnailUrl(): string
    {
        return match ($this->videoSource()) {
            'youtube' => ($id = $this->youtubeId())
                ? "https://img.youtube.com/vi/{$id}/hqdefault.jpg"
                : 'https://placehold.co/480x270?text=Video',
            'vimeo'   => 'https://placehold.co/480x270/1ab7ea/ffffff?text=Vimeo+Video',
            default   => 'https://placehold.co/480x270?text=Video',
        };
    }
}
