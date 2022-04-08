<?php

namespace App\Nova\Filters;

use App\Models\WasteCategory;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class WasteCategoryFilter extends Filter
{
    public $component = 'select-filter';

    public function apply(Request $request, $query, $value)
    {
        return $query->where('waste_category_id', $value);
    }

    public $name = 'Catégorie';

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        $wasteCategoriesFilter = [];

        foreach (WasteCategory::all() as $wasteCategory) {
            $wasteCategoriesFilter[$wasteCategory->name] = $wasteCategory->id;
        }

        return $wasteCategoriesFilter;
    }
}
