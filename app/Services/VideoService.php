<?php

namespace App\Services;

use App\Models\Video;
use App\Repositories\VideoRepository;

class VideoService
{
    public function __construct(
        private readonly VideoRepository $repo,
    ) {}

    public function getAdminIndexData(?string $level = null): array
    {
        return [
            'videos' => $this->repo->paginateAll(15, $level),
            'stats'  => $this->repo->stats(),
            'levels' => ['beginner', 'intermediate', 'advanced', 'general'],
            'current_level' => $level ?? '',
        ];
    }

    public function getSiteData(): array
    {
        return [
            'grouped' => $this->repo->publishedGrouped(),
            'levels'  => ['beginner', 'intermediate', 'advanced', 'general'],
        ];
    }

    public function create(array $data): Video
    {
        return $this->repo->create($data);
    }

    public function update(Video $video, array $data): Video
    {
        return $this->repo->update($video, $data);
    }

    public function delete(Video $video): void
    {
        $this->repo->delete($video);
    }

    public function togglePublish(Video $video): Video
    {
        return $this->repo->update($video, ['is_published' => ! $video->is_published]);
    }
}
