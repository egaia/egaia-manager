<?php

namespace App\Nova\Filters;

use App\Models\Category;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class CategoryPostFilter extends Filter
{
    public $component = 'select-filter';

    public function apply(Request $request, $query, $value)
    {
        return $query->where('category_id', $value);
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
        $categoriesFiltered = [];

        foreach (Category::all() as $category) {
            $categoriesFiltered[$category->name] = $category->id;
        }

        return $categoriesFiltered;
    }
}
