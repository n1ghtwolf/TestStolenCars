<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class VIN {

    public static function decode(string $vinCode)
    {
        $response = Http::withUrlParameters([
                'endpoint' => config('vin.url'),
            'method' => config('vin.methods.decode'),
            'vin' => $vinCode,
            'format' => config('vin.format'),
        ])->get('{+endpoint}/{method}/{vin}?format={format}');

        if ($response->failed() || !$response->ok()) {
            return ['error' => true];
        }

        return collect(json_decode($response->body())->Results)
            ->mapWithKeys(function ($item) {
                return [$item->Variable => ($item->Variable === "Model Year" ? $item->Value : $item->ValueId)];
            });
    }
}