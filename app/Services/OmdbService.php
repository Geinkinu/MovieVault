<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OmdbService
{
    public function fetchMovie(?string $imdbId, string $title, ?string $year = null): ?array
    {
        $key = config('services.omdb.key');
        $url = config('services.omdb.url', 'https://www.omdbapi.com/');

        if (!$key) {
            return null;
        }

        $params = ['apikey' => $key];

        if (!empty($imdbId)) {
            $params['i'] = $imdbId;
        } else {
            $params['t'] = $title;
            if (!empty($year)) {
                $params['y'] = $year;
            }
        }

        $response = Http::timeout(5)->get($url, $params);

        if (!$response->ok()) {
            return null;
        }

        $data = $response->json();

        if (($data['Response'] ?? 'False') !== 'True') {
            return null;
        }

        return $data;
    }

    public function extractReleaseYear(?string $omdbYear): ?int
    {
        if (!$omdbYear) {
            return null;
        }

        // OMDb can return "2001", or "2001–2003"
        if (preg_match('/\b(\d{4})\b/', $omdbYear, $m)) {
            return (int) $m[1];
        }

        return null;
    }
}
