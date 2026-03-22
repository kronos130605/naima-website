<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreVideoRequest;
use App\Http\Requests\Admin\UpdateVideoRequest;
use App\Models\Video;
use App\Services\VideoService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VideoController extends Controller
{
    public function __construct(
        private readonly VideoService $service,
    ) {}

    public function index(Request $request)
    {
        $data = $this->service->getAdminIndexData($request->query('level'));

        if ($request->header('HX-Request')) {
            return view('admin.partials.videos', $data);
        }

        return view('admin.videos.index', $data);
    }

    public function create(): View
    {
        return view('admin.videos.form', ['video' => null]);
    }

    public function store(StoreVideoRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['is_published'] = $request->boolean('is_published');

        $this->service->create($data);

        return redirect()->route('admin.videos.index')
            ->with('success', 'Video created.');
    }

    public function edit(string $locale, Video $video): View
    {
        return view('admin.videos.form', ['video' => $video]);
    }

    public function update(UpdateVideoRequest $request, string $locale, Video $video): RedirectResponse
    {
        $data = $request->validated();
        $data['is_published'] = $request->boolean('is_published');

        $this->service->update($video, $data);

        return redirect()->route('admin.videos.index')
            ->with('success', 'Video updated.');
    }

    public function destroy(string $locale, Video $video): RedirectResponse
    {
        $this->service->delete($video);

        return redirect()->route('admin.videos.index')
            ->with('success', 'Video deleted.');
    }

    public function togglePublish(string $locale, Video $video): RedirectResponse
    {
        $updated = $this->service->togglePublish($video);

        return back()->with('success', $updated->is_published ? 'Published.' : 'Unpublished.');
    }
}
