<?php

namespace App\Filters;

class VehicleFilters
{
   protected $filters = [
        'mark' => MarkFilter::class,
        'model' => ModelFilter::class,
        'year' => YearFilter::class,
    ];

    public function apply($query)
    {
        foreach ($this->receivedFilters() as $name => $value) {
            $filterInstance = new $this->filters[$name];
            $query = $filterInstance($query, $value);
        }

        return $query;
    }


    public function receivedFilters()
    {
        return request()->only(array_keys($this->filters));
    }
}