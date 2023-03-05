<?php

namespace App\Filters;

class MarkFilter
{
    function __invoke($query, $markSlug)
    {
        return $query->where('mark_id', $markSlug);
    }
}