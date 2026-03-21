<?php

namespace App\Repositories;

use App\Models\MindMap;
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
