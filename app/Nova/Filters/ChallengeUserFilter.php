<?php

namespace App\Nova\Filters;

use App\Models\Challenge;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class ChallengeUserFilter extends Filter
{
    public $component = 'select-filter';

    public function apply(Request $request, $query, $value)
    {
        return $query->where('challenge_id', $value);
    }

    public $name = 'Défi';

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        $challengesFilter = [];

        foreach (Challenge::all() as $challenge) {
            $challengesFilter[$challenge->title] = $challenge->id;
        }

        return $challengesFilter;
    }
}
