<?php

namespace App\Nova\Filters;

use App\Enums\WasteType;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class WasteTypeFilter extends Filter
{
    public $component = 'select-filter';

    public function apply(Request $request, $query, $value)
    {
        return $query->where('type', $value);
    }

    public $name = 'Type';

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        return [
            WasteType::HouseholdWaste()->description => WasteType::HouseholdWaste()->value,
            WasteType::Plastic()->description => WasteType::Plastic()->value,
            WasteType::Glass()->description => WasteType::Glass()->value,
            WasteType::Metal()->description => WasteType::Metal()->value,
        ];
    }
}
