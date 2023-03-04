<?php

namespace App\Filters;

class ModelFilter
{
    function __invoke($query, $modelSlug)
    {
        return $query->whereHas('model', function ($query) use ($modelSlug) {
            $query->where('slug', $modelSlug);
        });
    }
}