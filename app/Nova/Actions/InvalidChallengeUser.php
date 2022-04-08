<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class InvalidChallengeUser extends Action
{
    use InteractsWithQueue, Queueable;

    public function handle(ActionFields $fields, Collection $models)
    {
        $challengeUser = $models->first();

        if(!$challengeUser->valid) {
            return self::danger('Cette participation n\'est pas validée');
        } else {
            $challengeUser->valid = false;
            $challengeUser->save();
        }
    }

    public $name = 'Invalider';

    public $confirmText = 'Êtes-vous sûr de vouloir invalider cette participation ?';

    public $confirmButtonText = 'Invalider';

    public $cancelButtonText = 'Annuler';

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [];
    }
}
