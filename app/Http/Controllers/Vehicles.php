<?php

namespace App\Http\Controllers;

use App\Actions\CreateVehicleAction;
use App\Actions\VINDecodeAction;
//use App\Services\VINDecodeService;
use App\Filters\VehicleFilters;
use App\Http\Requests\VehicleDestroyRequest;
use App\Http\Requests\VehicleRequest;
use App\Http\Requests\AutoCompleteRequest;
use App\Services\VINDecodeService;
use App\Services\ImportMarkService;
use App\Services\ImportModelService;
use Illuminate\Http\Request;
use App\Exports\VehiclesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Vehicles as Vehicle;
class Vehicles extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(VehicleFilters $filters,string $order = 'id')
    {
        return Vehicle::filter($filters)->orderBy($order)->paginate(10);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VehicleRequest $request, CreateVehicleAction $createVehicleAction,VINDecodeService $VINDecodeService)
    {
        return $createVehicleAction->handle($request,$VINDecodeService);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Vehicle::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VehicleRequest $request)
    {
        return Vehicle::update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VehicleDestroyRequest $request)
    {
        return Vehicle::destroy($request->validated());
    }
    public function scopeSearch(Request $request){
        return Vehicle::where('name','LIKE',"%{$request->input('keyword')}%")
                ->orWhere('gov_number','LIKE',"%{$request->input('keyword')}%")
                ->orWhere('VIN', 'LIKE', "%{$request->input('keyword')}%")->get();
    }
    public function export()
    {
        return Excel::download(new VehiclesExport, 'vehicles.xlsx');
    }


}
