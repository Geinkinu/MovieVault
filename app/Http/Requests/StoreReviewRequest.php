<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
{
    protected $errorBag = 'review';

    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'author' => $this->input('author') ?: null,
        ]);
    }

    public function rules(): array
    {
        return [
            'author'  => ['nullable', 'string', 'max:255'],
            'rating'  => ['required', 'integer', 'between:1,5'],
            'content' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'rating.required' => 'Rating is required.',
            'rating.integer'  => 'Rating must be a number.',
            'rating.between'  => 'Rating must be between 1 and 5.',
        ];
    }
}
