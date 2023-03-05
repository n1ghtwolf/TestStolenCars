<?php

namespace App\Filters;

class ModelFilter
{
    function __invoke($query, $modelSlug)
    {
        return $query->where('model_id', $modelSlug);
    }
}