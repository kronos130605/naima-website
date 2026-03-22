<?php

namespace App\Services;

use App\Models\Worksheet;
use App\Repositories\WorksheetRepository;
use App\Traits\HandlesFileUploads;
use Illuminate\Http\UploadedFile;

class WorksheetService
{
    use HandlesFileUploads;

    public function __construct(
        private readonly WorksheetRepository $repo,
    ) {}

    public function getAdminIndexData(?string $level = null): array
    {
        return [
            'worksheets'    => $this->repo->paginateAll(15, $level),
            'stats'         => $this->repo->stats(),
            'levels'        => ['beginner', 'intermediate', 'advanced', 'general'],
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

    public function create(array $data, ?UploadedFile $preview, ?UploadedFile $pdf): Worksheet
    {
        $data['preview_image'] = $preview ? $this->storeUpload($preview, 'worksheets/previews') : null;
        $data['file_path']     = $pdf    ? $this->storeUpload($pdf,     'worksheets/files')    : null;

        return $this->repo->create($data);
    }

    public function update(Worksheet $worksheet, array $data, ?UploadedFile $preview, ?UploadedFile $pdf): Worksheet
    {
        $data['preview_image'] = $this->replaceUpload($worksheet->preview_image, $preview, 'worksheets/previews');
        $data['file_path']     = $this->replaceUpload($worksheet->file_path,     $pdf,     'worksheets/files');

        return $this->repo->update($worksheet, $data);
    }

    public function delete(Worksheet $worksheet): void
    {
        $this->deleteUpload($worksheet->preview_image);
        $this->deleteUpload($worksheet->file_path);
        $this->repo->delete($worksheet);
    }

    public function togglePublish(Worksheet $worksheet): Worksheet
    {
        return $this->repo->update($worksheet, ['is_published' => ! $worksheet->is_published]);
    }
}
