<?php

namespace App\Services;

use App\Models\MindMap;
use App\Repositories\MindMapRepository;
use App\Traits\HandlesFileUploads;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class MindMapService
{
    use HandlesFileUploads;

    public function __construct(
        private readonly MindMapRepository $repo,
    ) {}

    public function getPublicViewData(): array
    {
        return [
            'maps'   => $this->formatForJs($this->repo->published()),
            'groups' => $this->groups(),
        ];
    }

    public function getAdminIndexData(): array
    {
        return [
            'maps'   => $this->repo->allGrouped(),
            'groups' => ['maternelle', 'primaire', 'college', 'lycee'],
        ];
    }

    public function create(array $validated, ?UploadedFile $preview, ?UploadedFile $pdf): MindMap
    {
        $validated['slug']          = $validated['slug'] ?? Str::slug($validated['title_en']);
        $validated['preview_image'] = $preview ? $this->storeUpload($preview, 'mind-maps/previews') : null;
        $validated['file_path']     = $pdf    ? $this->storeUpload($pdf,     'mind-maps/files')    : null;

        return $this->repo->create($validated);
    }

    public function update(MindMap $map, array $validated, ?UploadedFile $preview, ?UploadedFile $pdf): MindMap
    {
        $validated['preview_image'] = $this->replaceUpload($map->preview_image, $preview, 'mind-maps/previews');
        $validated['file_path']     = $this->replaceUpload($map->file_path,     $pdf,     'mind-maps/files');

        return $this->repo->update($map, $validated);
    }

    public function delete(MindMap $map): void
    {
        $this->deleteUpload($map->preview_image);
        $this->deleteUpload($map->file_path);
        $this->repo->delete($map);
    }

    public function togglePublish(MindMap $map): MindMap
    {
        return $this->repo->update($map, ['is_published' => ! $map->is_published]);
    }

    private function groups(): array
    {
        return [
            ['key' => 'all',        'label_en' => 'All',          'label_fr' => 'Tous'],
            ['key' => 'maternelle', 'label_en' => 'Kindergarten', 'label_fr' => 'Maternelle'],
            ['key' => 'primaire',   'label_en' => 'Elementary',   'label_fr' => 'Primaire'],
            ['key' => 'college',    'label_en' => 'Middle School', 'label_fr' => 'Collège'],
            ['key' => 'lycee',      'label_en' => 'High School',   'label_fr' => 'Lycée'],
        ];
    }

    private function formatForJs(Collection $maps): array
    {
        return $maps->map(fn (MindMap $m) => [
            'id'             => $m->id,
            'group'          => $m->group,
            'level'          => $m->level,
            'topic_en'       => $m->topic_en,
            'topic_fr'       => $m->topic_fr,
            'title_en'       => $m->title_en,
            'title_fr'       => $m->title_fr,
            'description_en' => $m->description_en,
            'description_fr' => $m->description_fr,
            'preview'        => $m->preview_image,
            'file'           => $m->file_path,
        ])->values()->all();
    }
}
