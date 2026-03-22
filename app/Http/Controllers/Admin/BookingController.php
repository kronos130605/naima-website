<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\BookingRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookingController extends Controller
{
    public function __construct(
        private readonly BookingRepository $repo,
    ) {}

    public function index(Request $request)
    {
        $data = [
            'bookings'       => $this->repo->paginate(20, $request->query('status')),
            'stats'          => $this->repo->stats(),
            'current_status' => $request->query('status', ''),
        ];

        if ($request->header('HX-Request')) {
            return view('admin.partials.bookings', $data);
        }

        return view('admin.bookings.index', $data);
    }

    public function updateStatus(Request $request, int $id): RedirectResponse
    {
        $request->validate(['status' => ['required', 'in:pending,contacted,confirmed,cancelled']]);

        $this->repo->updateStatus($this->repo->find($id), $request->input('status'));

        return back();
    }
}
