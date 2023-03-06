<?php
namespace App\Services;

use App\Http\Resources\VehicleMarksResource;
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
                "endpoint" => config("models.url"),
            "method" => config("models.methods.model"),
            "mark" => $mark_id,
            "format" => config("models.format"),
        ])->get("{+endpoint}/{method}/{mark}?format={format}");

        if ($response->failed() || !$response->ok()) {
            return ["error" => true];
        }
        //        die('tut');
        //                var_dump(VehicleMarksResource::make(
        //                        json_decode($response->body(),true)
        //                ));
        //    var_dump($response->body());
        //    var_dump($this->ConvertToArray(json_decode($response->body())));
        //            die;
        VehicleModels::insertOrIgnore(
                $this->ConvertToArray(json_decode($response->body()))
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
        return VehicleMarks::pluck("mark_id");
    }
}
