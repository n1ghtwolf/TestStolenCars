<?php

namespace App\Filters;

class SortingFilter
{
    function __invoke($query, $sort)
    {
        return $query->orderBy($sort);
    }
}