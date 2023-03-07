<?php
namespace App\Services;

use App\Http\Resources\VehicleResource;
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

        return VehicleResource::make(
                json_decode($response->body())
                );

    }
}