<?php

namespace App\Http\Controllers;

use App\Actions\CreateVehicleAction;
use App\Actions\VINDecodeAction;
//use App\Services\VINDecodeService;
use App\Filters\VehicleFilters;
use App\Http\Requests\VehicleDestroyRequest;
use App\Http\Requests\VehicleRequest;
use App\Http\Requests\AutoCompleteRequest;
use App\Models\VehicleModels;
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
    public function index(VehicleFilters $filters)
    {
        return Vehicle::filter($filters)
            ->with(["mark", "model"])
//            ->with("model:name")
            ->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
            VehicleRequest $request,
        CreateVehicleAction $createVehicleAction
    ) {
        return $createVehicleAction->handle($request);
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
    public function update(VehicleRequest $request, string $id)
    {
        return Vehicle::findOrFail($id)->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Vehicle::destroy($id);
    }

    public function export(VehicleFilters $filters)
    {
        return Excel::download(new VehiclesExport($filters), "vehicles.xlsx");
    }
    public function autoComplete(string $name)
    {
        
        return VehicleModels::join('vehicle_marks', 'vehicle_models.mark_id', '=', 'vehicle_marks.id')
            ->select(VehicleModels::raw('vehicle_marks.name AS mark, GROUP_CONCAT(vehicle_models.name) AS models'))
            ->where('vehicle_marks.name', 'LIKE', "$name%")
            ->groupBy('vehicle_marks.name')
            ->orderBy('vehicle_marks.name')
            ->get()->map(fn ($item) => [ 'mark' => $item->mark,'models' => explode(',', $item->models)]);

    }
}
