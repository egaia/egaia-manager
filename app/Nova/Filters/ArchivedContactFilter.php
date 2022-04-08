<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravel\Nova\Filters\Filter;

class ArchivedContactFilter extends Filter
{
    public $component = 'select-filter';

    public function apply(Request $request, $query, $value)
    {
        if($value == 'archived') {
            return $query->whereNotNull('archived_at');
        } else if ($value == 'unarchived') {
            return $query->whereNull('archived_at');
        } else {
            return $query;
        }
    }

    public $name = 'Archivé';

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        return [
            'Archivé' => 'archived',
            'Non archivé' => 'unarchived'
        ];
    }
}
