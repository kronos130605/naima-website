<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreWorksheetRequest;
use App\Http\Requests\Admin\UpdateWorksheetRequest;
use App\Models\Worksheet;
use App\Services\WorksheetService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WorksheetController extends Controller
{
    public function __construct(
        private readonly WorksheetService $service,
    ) {}

    public function index(Request $request)
    {
        $data = $this->service->getAdminIndexData($request->query('level'));

        if ($request->header('HX-Request')) {
            return view('admin.partials.worksheets', $data);
        }

        return view('admin.worksheets.index', $data);
    }

    public function create(): View
    {
        return view('admin.worksheets.form', ['worksheet' => null]);
    }

    public function store(StoreWorksheetRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['is_published'] = $request->boolean('is_published');

        $this->service->create(
            $data,
            $request->file('preview_image'),
            $request->file('file_path'),
        );

        return redirect()->route('admin.worksheets.index')
            ->with('success', 'Worksheet created.');
    }

    public function edit(string $locale, Worksheet $worksheet): View
    {
        return view('admin.worksheets.form', ['worksheet' => $worksheet]);
    }

    public function update(UpdateWorksheetRequest $request, string $locale, Worksheet $worksheet): RedirectResponse
    {
        $data = $request->validated();
        $data['is_published'] = $request->boolean('is_published');

        $this->service->update(
            $worksheet,
            $data,
            $request->file('preview_image'),
            $request->file('file_path'),
        );

        return redirect()->route('admin.worksheets.index')
            ->with('success', 'Worksheet updated.');
    }

    public function destroy(string $locale, Worksheet $worksheet): RedirectResponse
    {
        $this->service->delete($worksheet);

        return redirect()->route('admin.worksheets.index')
            ->with('success', 'Worksheet deleted.');
    }

    public function togglePublish(string $locale, Worksheet $worksheet): RedirectResponse
    {
        $updated = $this->service->togglePublish($worksheet);

        return back()->with('success', $updated->is_published ? 'Published.' : 'Unpublished.');
    }
}
