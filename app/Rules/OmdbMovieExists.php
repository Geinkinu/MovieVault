<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;

class OmdbMovieExists implements ValidationRule
{
    private ?string $imdbId;
    private ?string $year;

    public function __construct(?string $imdbId = null, ?string $year = null)
    {
        $this->imdbId = $imdbId;
        $this->year = $year;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $key = config('services.omdb.key');
        $url = config('services.omdb.url');

        if (!$key) {
            $fail('OMDb API key is not configured.');
            return;
        }

        $params = ['apikey' => $key];

        // If IMDb ID provided, validate via ID, otherwise via title
        if (!empty($this->imdbId)) {
            $params['i'] = $this->imdbId;
        } else {
            $params['t'] = (string) $value; // title value
            if (!empty($this->year)) {
                $params['y'] = $this->year;
            }
        }

        try {
            $response = Http::timeout(5)->get($url, $params);
        } catch (\Throwable $e) {
            $fail('Unable to validate movie with OMDb right now.');
            return;
        }

        if (!$response->ok()) {
            $fail('Unable to validate movie with OMDb right now.');
            return;
        }

        $data = $response->json();

        if (($data['Response'] ?? 'False') !== 'True') {
            $fail('Movie could not be found in OMDb. Please check the title or IMDb ID.');
        }
    }
}
