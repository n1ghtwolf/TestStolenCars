<?php

namespace App\Services;

use App\Models\VehicleMarks;
use App\Models\VehicleModels;

class ImportModelService
{
    protected $apiUrl = "https://vpic.nhtsa.dot.gov/api/vehicles/getmodelsformakeid/";
    protected $apiFormat = "?format=json";

    public function __invoke()
    {
        set_time_limit(1800);

        $marks = VehicleMarks::pluck('mark_id');
        $models = [];
//        var_dump($marks);die;
        foreach ($marks as $mark) {

            $response = $this->makeRequest($mark);
//            var_dump($response->Results);die;
//            $models = $this->convertToArray($response);
//            var_dump($models);die;
            $models = array_merge($models, $this->convertToArray($response));
//            var_dump('qwe');
//            sleep(1);
        }
                var_dump($models);
                    $this->saveModel($models);

    }

    protected function makeRequest($markId)
    {
        $url = $this->apiUrl . $markId . $this->apiFormat;

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response);
    }

    protected function convertToArray($arrayToDecode)
    {
//        var_dump($response->Results);die;

            $results = $arrayToDecode->Results;
            $convertedResults = [];

            foreach ($results as $result) {
                //        var_dump($result);die;
        $convertedResults[] = [
                'model_id' => $result->Model_ID,
            'name' => $result->Model_Name,
        ];
            }

    return $convertedResults;

    }

    protected function saveModel($models)
    {
//        foreach ($models as $model) {
            $res = VehicleModels::insertOrIgnore($models);
            var_dump($res);
//        }
    }
}
