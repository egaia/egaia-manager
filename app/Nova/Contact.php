<?php

namespace App\Nova;

use App\Nova\Actions\ArchivedContact;
use App\Nova\Actions\UnarchivedContact;
use App\Nova\Filters\ArchivedContactFilter;
use Illuminate\Http\Request;
use Inspheric\Fields\Indicator;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;

class Contact extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Contact::class;

    public function title()
    {
        return $this->firstname.' '.$this->lastname;
    }

    public static function label()
    {
        return 'Contacts';
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'firstname', 'lastname', 'email', 'subject', 'message'
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

            Text::make('Prénom', 'firstname')
                ->rules('required', 'string', 'max:255')
                ->sortable(),

            Text::make('Nom', 'lastname')
                ->rules('required', 'string', 'max:255')
                ->sortable(),

            Text::make('Email', 'email')
                ->rules('required', 'email', 'max:255')
                ->sortable(),

            Text::make('Objet', 'subject')
                ->rules('required', 'string', 'max:255')
                ->sortable(),

            Textarea::make('Message', 'message')
                ->rules('required', 'string')
                ->sortable(),

            DateTime::make('Date', 'created_at')
                ->format('DD/MM/Y HH:mm')
                ->sortable()
                ->readonly(),

            Indicator::make('Archivé ?', 'is_archived')
                ->labels([
                    'true' => 'Archivé',
                    'false' => 'Non archivé',
                ])
                ->colors([
                    'true' => 'red',
                    'false' => 'green',
                ]),
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
            new ArchivedContactFilter()
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
        return [
            new ArchivedContact(),
            new UnarchivedContact()
        ];
    }
}
