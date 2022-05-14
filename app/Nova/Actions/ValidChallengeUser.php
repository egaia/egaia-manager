<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class ValidChallengeUser extends Action
{
    use InteractsWithQueue, Queueable;

    public function handle(ActionFields $fields, Collection $models)
    {
        $challengeUser = $models->first();

        if($challengeUser->valid) {
            return self::danger('Cette participation a déjà été validée');
        } else {
            $challengeUser->valid = true;
            $challengeUser->save();
            $user = $challengeUser->user;
            $user->points += $challengeUser->challenge->points;
            $user->save();
        }
    }

    public $name = 'Valider';

    public $confirmText = 'Êtes-vous sûr de vouloir valider cette participation ?';

    public $confirmButtonText = 'Valider';

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
