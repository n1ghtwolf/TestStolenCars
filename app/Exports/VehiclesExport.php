<?php

namespace App\Exports;

use App\Models\Vehicles;
use Maatwebsite\Excel\Concerns\FromCollection;

class VehiclesExport implements FromCollection
{
    public function collection()
    {
        return Vehicles::all();
    }
}