<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreWorksheetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title_en'       => ['required', 'string', 'max:255'],
            'title_fr'       => ['required', 'string', 'max:255'],
            'description_en' => ['nullable', 'string'],
            'description_fr' => ['nullable', 'string'],
            'level'          => ['required', 'in:beginner,intermediate,advanced,general'],
            'topic_en'       => ['nullable', 'string', 'max:255'],
            'topic_fr'       => ['nullable', 'string', 'max:255'],
            'preview_image'  => ['nullable', 'image', 'max:4096'],
            'file_path'      => ['nullable', 'mimes:pdf', 'max:20480'],
            'is_published'   => ['boolean'],
            'sort_order'     => ['integer', 'min:0'],
        ];
    }
}
