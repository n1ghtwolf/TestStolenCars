<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleMarksResource extends JsonResource
{
    private $transformKeys = [
        'make_id',
        'name',
    ];
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray( $request): array
    {

        ////                return collect($this->Results)->mapWithKeys(fn ($item) =>  array_combine($this->transformKeys, [$item->Make_ID,$item->Make_Name]))->toArray();
        //        return collect($this->Results)->map(function ($item) {
        //            return [
        //                    'mark_id' => $item->Make_ID,
        //        'name' => $item->Make_Name,
        //    ];
        //        })->toArray();

        return $this->Results->toArray();

    }
}
