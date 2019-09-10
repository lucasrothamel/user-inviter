<?php

namespace App\QueryFilters;

class Email extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder->where('email', request()->get('email'));
    }
}
