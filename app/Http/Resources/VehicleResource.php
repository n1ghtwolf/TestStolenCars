<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VehicleResource extends JsonResource
{
    private $returnKeys = [
        'Model Year',
        'Make',
        'Model',
    ];

    public function toArray($request): array
    {

        return collect($this->Results)
            ->mapWithKeys(fn ($item) => [$item->Variable => ($item->Variable === "Model Year" ? $item->Value : $item->ValueId)])
            ->reject(fn ($value, $name) => !in_array($name, $this->returnKeys))
            ->toArray();

    }
}
