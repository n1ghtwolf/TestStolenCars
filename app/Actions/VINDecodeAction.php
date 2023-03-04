<?php
namespace App\Actions;
use App\Http\Request;
//use Lorisleiva\Actions\Concerns\AsAction;

class VINDecodeAction{

//    use asAction;
    public string $url ="https://vpic.nhtsa.dot.gov/api/vehicles/decodevin/";
    public string $format ="?format=json";


     public function __invoke(string $vinCode)
     {
//         die('tut');
         $curl = curl_init($this->url.$vinCode.$this->format);

         curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
         $response = curl_exec($curl);
         curl_close($curl);
         return $response;
     }

}