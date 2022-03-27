<?php

namespace App\Nova;

use Ek0519\Quilljs\Quilljs;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;

class Post extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Post::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    public static function label()
    {
        return 'Articles';
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'title', 'resume', 'content'
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

            Text::make('Titre', 'title')
                ->rules('required', 'string', 'max:255')
                ->sortable(),

            Quilljs::make('Résumé', 'resume')
                ->rules('required', 'string')
                ->alwaysShow()
                ->sortable(),

            Quilljs::make('Contenu', 'content')
                ->rules('required', 'string')
                ->sortable(),

            Image::make('Image', 'image')
                ->rules('required', 'image', 'mimetypes:image/jpg,image/jpeg,image/png')
                ->sortable(),

            BelongsTo::make('Catégorie', 'category', Category::class)
                ->sortable(),

            DateTime::make('Date de publication', 'published_at')
                ->rules('required', 'date')
                ->format('DD/MM/Y HH:mm')
                ->sortable(),
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
        return [];
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
