<?php

namespace App\Filters;

class SearchFilter
{
    function __invoke($query, $searchSlug)
    {
        return $query->where('name', 'like', '%'.$searchSlug.'%')
                ->orWhere('gov_number', 'like', '%'.$searchSlug.'%')
                ->orWhere('VIN', 'like', '%'.$searchSlug.'%');
    }
}