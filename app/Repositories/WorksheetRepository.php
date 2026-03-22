<?php

namespace App\Repositories;

use App\Models\Worksheet;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as BaseCollection;

class WorksheetRepository
{
    public function allOrdered(): Collection
    {
        return Worksheet::ordered()->get();
    }

    public function publishedGrouped(): BaseCollection
    {
        return Worksheet::published()->ordered()->get()->groupBy('level');
    }

    public function stats(): array
    {
        return [
            'total'     => Worksheet::count(),
            'published' => Worksheet::where('is_published', true)->count(),
            'levels'    => Worksheet::distinct('level')->count('level'),
        ];
    }

    public function paginateAll(int $perPage = 15, ?string $level = null): LengthAwarePaginator
    {
        $query = Worksheet::ordered();

        if ($level) {
            $query->where('level', $level);
        }

        return $query->paginate($perPage)->withQueryString();
    }

    public function find(int $id): Worksheet
    {
        return Worksheet::findOrFail($id);
    }

    public function create(array $data): Worksheet
    {
        return Worksheet::create($data);
    }

    public function update(Worksheet $worksheet, array $data): Worksheet
    {
        $worksheet->update($data);

        return $worksheet->fresh();
    }

    public function delete(Worksheet $worksheet): void
    {
        $worksheet->delete();
    }
}
