<?php
namespace App\Services;

use App\Http\Resources\VehicleMarksResource;
use App\Models\VehicleMarks;
use Illuminate\Support\Facades\Http;

class ImportMarks
{
    public function import()
    {

        $response = Http::withUrlParameters([
                "endpoint" => config("vin.url"),
            "method" => config("vin.methods.marks"),
            "format" => config("vin.format"),
        ])->get("{+endpoint}/{method}?format={format}");

        if ($response->failed() || !$response->ok()) {
            return ["error" => true];
        }

        VehicleMarks::insertOrIgnore(
                VehicleMarksResource::make(json_decode($response->body()))->toArray(true)
        );

    }
}
