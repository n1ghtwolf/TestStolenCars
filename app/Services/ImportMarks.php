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
            "endpoint" => config("marks.url"),
            "method" => config("marks.methods.marks"),
            "format" => config("marks.format"),
        ])->get("{+endpoint}/{method}?format={format}");

        if ($response->failed() || !$response->ok()) {
            return ["error" => true];
        }

        VehicleMarks::insertOrIgnore(
            $this->ConvertToArray(json_decode($response->body()))
        );
    }
    private function ConvertToArray($arrayToDecode)
    {
        $results = $arrayToDecode->Results;
        $convertedResults = [];

        foreach ($results as $result) {
            $convertedResults[] = [
                "mark_id" => $result->Make_ID,
                "name" => $result->Make_Name,
            ];
        }

        return $convertedResults;
    }
}
