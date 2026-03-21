<?php

namespace App\Repositories;

use App\Models\MindMap;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as BaseCollection;

class MindMapRepository
{
    public function allOrdered(): Collection
    {
        return MindMap::ordered()->get();
    }

    public function allGrouped(): BaseCollection
    {
        return MindMap::ordered()->get()->groupBy('group');
    }

    public function published(): Collection
    {
        return MindMap::published()->ordered()->get();
    }

    public function stats(): array
    {
        return [
            'total'     => MindMap::count(),
            'published' => MindMap::where('is_published', true)->count(),
            'groups'    => MindMap::distinct('group')->count('group'),
        ];
    }

    public function paginateAll(int $perPage = 15, ?string $group = null): LengthAwarePaginator
    {
        $query = MindMap::ordered();

        if ($group) {
            $query->where('group', $group);
        }

        return $query->paginate($perPage)->withQueryString();
    }

    public function paginatePublished(int $perPage = 12, ?string $group = null): LengthAwarePaginator
    {
        $query = MindMap::published()->ordered();

        if ($group) {
            $query->where('group', $group);
        }

        return $query->paginate($perPage)->withQueryString();
    }

    public function find(int $id): MindMap
    {
        return MindMap::findOrFail($id);
    }

    public function create(array $data): MindMap
    {
        return MindMap::create($data);
    }

    public function update(MindMap $map, array $data): MindMap
    {
        $map->update($data);

        return $map->fresh();
    }

    public function delete(MindMap $map): void
    {
        $map->delete();
    }
}
