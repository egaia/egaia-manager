<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;

class User extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\User::class;

    public function title()
    {
        return $this->resource->firstname . ' ' . $this->resource->lastname;
    }

    public static function label()
    {
        return 'Utilisateurs';
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'firstname', 'lastname', 'birthdate', 'points', 'email',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
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

            Date::make('Date de naissance', 'birthdate')
                ->rules('required', 'date')
                ->sortable(),

            Number::make('Points', 'points')
                ->rules('required', 'integer')
                ->sortable(),

            Text::make('Email', 'email')
                ->rules('required', 'email', 'max:255')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}')
                ->sortable(),

            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),

            DateTime::make('Inscrit le', 'created_at')
                ->format('DD/MM/Y')
                ->sortable()
                ->readonly(),

            DateTime::make('Dernière connexion', 'last_login_at')
                ->format('DD/MM/Y h:mm')
                ->sortable()
                ->readonly(),

            HasMany::make('Participations aux défis', 'challengeUsers', ChallengeUser::class),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
