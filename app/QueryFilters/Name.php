<?php

namespace App\QueryFilters;

class Name extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder->where('name', 'LIKE', '%' . request()->get('name') . '%');
    }
}
