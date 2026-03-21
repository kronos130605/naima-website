<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HandlesFileUploads
{
    protected function storeUpload(UploadedFile $file, string $folder, string $disk = 'public'): string
    {
        return $file->store($folder, $disk);
    }

    protected function deleteUpload(?string $path, string $disk = 'public'): void
    {
        if ($path && Storage::disk($disk)->exists($path)) {
            Storage::disk($disk)->delete($path);
        }
    }

    protected function replaceUpload(
        ?string $existing,
        ?UploadedFile $newFile,
        string $folder,
        string $disk = 'public',
    ): ?string {
        if ($newFile === null) {
            return $existing;
        }

        $this->deleteUpload($existing, $disk);

        return $this->storeUpload($newFile, $folder, $disk);
    }
}
