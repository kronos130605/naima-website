<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'          => ['required', 'string', 'max:100'],
            'email'         => ['required', 'email', 'max:150'],
            'phone'         => ['nullable', 'string', 'max:30'],
            'student_level' => ['nullable', 'string', 'max:50'],
            'message'       => ['nullable', 'string', 'max:1000'],
        ];
    }
}
