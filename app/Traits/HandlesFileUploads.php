<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HandlesFileUploads
{
    protected function uploadDisk(): string
    {
        return config('filesystems.upload_disk', 'public');
    }

    protected function storeUpload(UploadedFile $file, string $folder, string $disk = null): string
    {
        return $file->store($folder, $disk ?? $this->uploadDisk());
    }

    protected function deleteUpload(?string $path, string $disk = null): void
    {
        $disk = $disk ?? $this->uploadDisk();
        if ($path && Storage::disk($disk)->exists($path)) {
            Storage::disk($disk)->delete($path);
        }
    }

    protected function replaceUpload(
        ?string $existing,
        ?UploadedFile $newFile,
        string $folder,
        string $disk = null,
    ): ?string {
        if ($newFile === null) {
            return $existing;
        }

        $this->deleteUpload($existing, $disk);

        return $this->storeUpload($newFile, $folder, $disk);
    }
}
