<?php

namespace App\Filters;

class MarkFilter
{
    function __invoke($query, $markSlug)
    {
        return $query->whereHas('mark', function ($query) use ($markSlug) {
            $query->where('slug', $markSlug);
        });
    }
}