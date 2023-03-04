<?php

namespace App\Filters;

class YearFilter
{
    function __invoke($query, $yearSlug)
    {
        return $query->whereHas('mark', function ($query) use ($yearSlug) {
            $query->where('slug', $yearSlug);
        });
    }
}