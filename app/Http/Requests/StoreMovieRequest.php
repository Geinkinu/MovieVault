<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\OmdbMovieExists;
use Carbon\Carbon;

class StoreMovieRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        if ($this->filled('date_watched')) {
            try {
                $this->merge([
                    'date_watched' => Carbon::createFromFormat('d/m/Y', $this->date_watched)->format('Y-m-d'),
                ]);
            } catch (\Exception $e) {
            }
        }
    }

    public function rules(): array
    {
        return [
            'category_id'  => ['required', 'exists:categories,id'],
            'title'        => ['required', 'string', 'max:255', new OmdbMovieExists($this->input('imdb_id'))],
            'date_watched' => ['nullable', 'regex:/^\d{2}\/\d{2}\/\d{4}$/', 'date'],
            'imdb_id'      => ['nullable', 'string', 'max:20'],
            'poster'       => ['nullable', 'url'],
            'description'  => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'date_watched.regex' => 'Date watched must be in dd/mm/yyyy format.',
        ];
    }

    public function attributes(): array
    {
        return [
            'category_id' => 'category',
        ];
    }
}
