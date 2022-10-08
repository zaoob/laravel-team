<?php

namespace Zaoob\Laravel\Team;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Manager
{
    public static function getRules()
    {
        $rules = config('zaoob.team.rules');
        $rules = array_keys($rules);

        $rules = Arr::prepend($rules, 'owner');

        $collection = collect($rules);

        $collection = $collection->mapWithKeys(function ($item) {
            return [($item == 'owner') ? '*' : $item => Str::ucfirst($item)];
        });

        return $collection;
    }
}
