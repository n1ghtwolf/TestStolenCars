<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleModelsResource extends JsonResource
{

    private $transformKeys = [
        'mark_id',
        'name',
        'id',
    ];

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray( $request): array
    {

        return collect($this->Results)->map(fn ($item) =>  array_combine($this->transformKeys, [$item->Make_ID,$item->Model_Name,$item->Model_ID]))->toArray();

    }
}
