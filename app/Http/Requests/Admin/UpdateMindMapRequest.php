<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMindMapRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isAdmin() ?? false;
    }

    public function rules(): array
    {
        $id = $this->route('mindMap')?->id;

        return [
            'title_en'       => ['required', 'string', 'max:200'],
            'title_fr'       => ['required', 'string', 'max:200'],
            'description_en' => ['nullable', 'string', 'max:500'],
            'description_fr' => ['nullable', 'string', 'max:500'],
            'group'          => ['required', 'in:maternelle,primaire,college,lycee'],
            'level'          => ['required', 'string', 'max:50'],
            'topic_en'       => ['nullable', 'string', 'max:100'],
            'topic_fr'       => ['nullable', 'string', 'max:100'],
            'preview_image'  => ['nullable', 'image', 'max:4096'],
            'file_path'      => ['nullable', 'mimes:pdf', 'max:20480'],
            'is_published'   => ['boolean'],
            'sort_order'     => ['integer', 'min:0'],
            'slug'           => ['nullable', 'string', "unique:mind_maps,slug,{$id}"],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_published' => $this->boolean('is_published'),
            'sort_order'   => (int) $this->input('sort_order', 0),
        ]);
    }
}
