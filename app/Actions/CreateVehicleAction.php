<?php
namespace App\Actions;
use App\Http\Requests\VehicleRequest;
use App\Services\VINDecodeService;
use Illuminate\Http\Request;
use App\Models\Vehicles as Vehicle;

Class CreateVehicleAction{

    public function handle(VehicleRequest $request,VINDecodeService $VINDecodeService)
    {

        $data = $request->validated();
        $decoded = $VINDecodeService->handle($data['vin']);
        $data['mark_id'] = $decoded['Make'];
        $data['model_id'] = $decoded['Model'];
        $data['year'] = $decoded['Model Year'];

       return Vehicle::create($data);

    }

}