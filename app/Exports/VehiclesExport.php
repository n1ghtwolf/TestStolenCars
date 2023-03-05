<?php

namespace App\Exports;

use App\Filters\VehicleFilters;
use App\Models\Vehicles;
use Maatwebsite\Excel\Concerns\FromQuery;

class VehiclesExport  implements FromQuery
{

    private $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }
    public function query()
    {
        return Vehicles::filter($this->filters);
    }
}
