<?php
namespace App\Services;

use App\Http\Resources\VehicleMarksResource;
use App\Http\Resources\VehicleModelsResource;
use App\Models\VehicleMarks;
use App\Models\VehicleModels;
use Illuminate\Support\Facades\Http;

class ImportModels
{
    public function handle()
    {
        foreach ($this->getAllMarks() as $mark) {
            $this->import($mark);
        }
    }
    public function import($mark_id)
    {
        $response = Http::withUrlParameters([
                "endpoint" => config("vin.url"),
            "method" => config("vin.methods.model"),
            "mark" => $mark_id,
            "format" => config("vin.format"),
        ])->get("{+endpoint}/{method}/{mark}?format={format}");

        if ($response->failed() || !$response->ok()) {
            return ["error" => true];
        }
       
        VehicleModels::insertOrIgnore(
                VehicleModelsResource::make(json_decode($response->body()))->toArray(true)
        );

    }

    protected function ConvertToArray($arrayToDecode)
    {
        //        var_dump($response->Results);die;

        $results = $arrayToDecode->Results;
        $convertedResults = [];

        foreach ($results as $result) {
            $convertedResults[] = [
                    "model_id" => $result->Model_ID,
                "mark_id" => $result->Make_ID,
                "name" => $result->Model_Name,
            ];
        }

        return $convertedResults;
    }
    protected function getAllMarks()
    {
        return VehicleMarks::pluck("id");
    }
}
