<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVideoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title_en'        => ['required', 'string', 'max:255'],
            'title_fr'        => ['required', 'string', 'max:255'],
            'description_en'  => ['nullable', 'string'],
            'description_fr'  => ['nullable', 'string'],
            'video_url'       => ['required', 'url', 'max:500'],
            'level'           => ['required', 'in:beginner,intermediate,advanced,general'],
            'topic_en'        => ['nullable', 'string', 'max:255'],
            'topic_fr'        => ['nullable', 'string', 'max:255'],
            'is_published'    => ['boolean'],
            'sort_order'      => ['integer', 'min:0'],
        ];
    }
}
