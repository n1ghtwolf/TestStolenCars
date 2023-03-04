<?php
namespace App\Services;
use App\Http\Request;
//use Lorisleiva\Actions\Concerns\AsAction;
use App\Models\VehicleModels;
use App\Models\VehicleMarks;
class ImportMarkService{

    //    use asAction;
    public string $url ="https://vpic.nhtsa.dot.gov/api/vehicles/getallmakes?format=json";
//    public string $format ="?format=json";


    public function __invoke()
    {
//         $this->ConvertToArray($this->makeRequest());
//         var_dump($this->ConvertToArray($this->makeRequest()));die;
        return VehicleMarks::insertOrIgnore($this->ConvertToArray($this->makeRequest()));

    }

    public function makeRequest(){

        $curl = curl_init($this->url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }

    private function ConvertToArray($arrayToDecode){
    $results = $arrayToDecode->Results;
    $convertedResults = [];

    foreach ($results as $result) {
//        var_dump($result);die;
        $convertedResults[] = [
                'mark_id' => $result->Make_ID,
            'name' => $result->Make_Name,
        ];
    }

    return $convertedResults;
}


}