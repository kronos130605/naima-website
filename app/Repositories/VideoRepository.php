<?php

namespace App\Repositories;

use App\Models\Video;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as BaseCollection;

class VideoRepository
{
    public function allOrdered(): Collection
    {
        return Video::ordered()->get();
    }

    public function publishedGrouped(): BaseCollection
    {
        return Video::published()->ordered()->get()->groupBy('level');
    }

    public function stats(): array
    {
        return [
            'total'     => Video::count(),
            'published' => Video::where('is_published', true)->count(),
            'levels'    => Video::distinct('level')->count('level'),
        ];
    }

    public function paginateAll(int $perPage = 15, ?string $level = null): LengthAwarePaginator
    {
        $query = Video::ordered();

        if ($level) {
            $query->where('level', $level);
        }

        return $query->paginate($perPage)->withQueryString();
    }

    public function find(int $id): Video
    {
        return Video::findOrFail($id);
    }

    public function create(array $data): Video
    {
        return Video::create($data);
    }

    public function update(Video $video, array $data): Video
    {
        $video->update($data);

        return $video->fresh();
    }

    public function delete(Video $video): void
    {
        $video->delete();
    }
}
