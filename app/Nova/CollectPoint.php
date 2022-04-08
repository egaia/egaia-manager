<?php

namespace App\Nova;

use App\Enums\WasteType;
use App\Nova\Filters\WasteTypeFilter;
use GeneaLabs\NovaMapMarkerField\MapMarker;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use SimpleSquid\Nova\Fields\Enum\Enum;

class CollectPoint extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\CollectPoint::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    public static function label()
    {
        return 'Points de collecte';
    }

    public static function singularLabel()
    {
        return 'Point de collecte';
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'address', 'latitude', 'longitude', 'type'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make('ID', 'id')->sortable(),

            Text::make('Nom', 'name')
                ->rules('required', 'string', 'max:255')
                ->sortable(),

            Text::make('Adresse', 'address')
                ->rules('required', 'string', 'max:255')
                ->sortable(),

            MapMarker::make('Localisation')
                ->searchProvider('ESRI')
                ->searchProviderKey('AAPKf1873f47effb4257ab81a90568082a69qF1JyEsYitKxUykjNJeFplyRD_nxER99i7EsWrRJ1V1F8jmhy6kI5150ZJkPvbSL')
                ->latitude('latitude')
                ->longitude('longitude')
                ->defaultLatitude(45.764043)
                ->defaultLongitude(4.835659)
                ->rules('required')
                ->sortable(),

            Enum::make('Type', 'type')
                ->attach(WasteType::class)
                ->rules('required')
                ->sortable(),

            Boolean::make('Personnalisé', 'custom')
                ->exceptOnForms(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            new WasteTypeFilter()
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
