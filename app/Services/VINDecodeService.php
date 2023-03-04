<?php
namespace App\Services;

class VINDecodeService{

    public string $url ="https://vpic.nhtsa.dot.gov/api/vehicles/decodevin/";
    public string $format ="?format=json";
//    public function __construct(protected $url ="https://vpic.nhtsa.dot.gov/api/vehicles/decodevin/",protected $format ="?format=json")
//    {
//
//    }

     public function handle($vinCode):array
     {
        $this->vinCode = $vinCode;
        return $this->ConvertToArray($this->makeRequest());
     }

    private function makeRequest()
     {
         $curl = curl_init($this->url.$this->vinCode.$this->format);

         curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
         $response = curl_exec($curl);
         curl_close($curl);
         return json_decode($response);
     }
     private function ConvertToArray($arrayToDecode){

         $decodedYear = array_column($arrayToDecode->Results,'Value','Variable')['Model Year'];

         $decoded = array_column($arrayToDecode->Results,'ValueId','Variable');
         $decoded['Model Year']= $decodedYear;
//         var_dump($decodedYear);die;
//         var_dump($decoded);die;

         return $decoded;

    }

}