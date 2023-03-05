<?php

namespace App\Filters;

class YearFilter
{
    function __invoke($query, $yearSlug)
    {
        return $query->where('year', $yearSlug);
    }
}