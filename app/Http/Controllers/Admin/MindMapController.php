<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMindMapRequest;
use App\Http\Requests\Admin\UpdateMindMapRequest;
use App\Models\MindMap;
use App\Services\MindMapService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MindMapController extends Controller
{
    public function __construct(
        private readonly MindMapService $service,
    ) {}

    public function index(): View
    {
        return view('admin.mind-maps.index', $this->service->getAdminIndexData());
    }

    public function create(): View
    {
        return view('admin.mind-maps.form', ['map' => null]);
    }

    public function store(StoreMindMapRequest $request): RedirectResponse
    {
        $this->service->create(
            $request->validated(),
            $request->file('preview_image'),
            $request->file('file_path'),
        );

        return redirect()->route('admin.mind-maps.index')
            ->with('success', 'Mind map created.');
    }

    public function edit(string $locale, MindMap $mindMap): View
    {
        return view('admin.mind-maps.form', ['map' => $mindMap]);
    }

    public function update(UpdateMindMapRequest $request, string $locale, MindMap $mindMap): RedirectResponse
    {
        $this->service->update(
            $mindMap,
            $request->validated(),
            $request->file('preview_image'),
            $request->file('file_path'),
        );

        return redirect()->route('admin.mind-maps.index')
            ->with('success', 'Mind map updated.');
    }

    public function destroy(string $locale, MindMap $mindMap): RedirectResponse
    {
        $this->service->delete($mindMap);

        return redirect()->route('admin.mind-maps.index')
            ->with('success', 'Mind map deleted.');
    }

    public function togglePublish(string $locale, MindMap $mindMap): RedirectResponse
    {
        $updated = $this->service->togglePublish($mindMap);

        return back()->with('success', $updated->is_published ? 'Published.' : 'Unpublished.');
    }
}
