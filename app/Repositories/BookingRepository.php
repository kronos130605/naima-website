<?php

namespace App\Repositories;

use App\Models\Booking;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BookingRepository
{
    public function create(array $data): Booking
    {
        return Booking::create($data);
    }

    public function paginate(int $perPage = 20, ?string $status = null): LengthAwarePaginator
    {
        $query = Booking::latest();

        if ($status) {
            $query->where('status', $status);
        }

        return $query->paginate($perPage)->withQueryString();
    }

    public function find(int $id): Booking
    {
        return Booking::findOrFail($id);
    }

    public function updateStatus(Booking $booking, string $status): Booking
    {
        $booking->update(['status' => $status]);

        return $booking->fresh();
    }

    public function stats(): array
    {
        return [
            'total'     => Booking::count(),
            'pending'   => Booking::where('status', 'pending')->count(),
            'contacted' => Booking::where('status', 'contacted')->count(),
            'confirmed' => Booking::where('status', 'confirmed')->count(),
        ];
    }
}
