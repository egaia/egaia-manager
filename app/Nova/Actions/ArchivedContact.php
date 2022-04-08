<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class ArchivedContact extends Action
{
    use InteractsWithQueue, Queueable;

    public function handle(ActionFields $fields, Collection $models)
    {
        $model_errors = [];
        foreach ($models as $model){
            if($model->archived_at == null){
                $model->archived_at = now();
                $model->save();
            }
            else{
                $model_errors[] = $model;
            }
        }
        if(count($model_errors) > 0){
            $name_errors = '';
            foreach ($model_errors as $key => $model_error){
                $name_errors .= $model_error->name;
                if($key < count($model_errors)-1){
                    $name_errors .= " - ";
                }
            }
            return self::danger('Le(s) contact(s) '.$name_errors.' est(sont) déjà archivé(s)');
        }
    }

    public $name = 'Archiver';

    public $confirmText = 'Êtes-vous sûr de vouloir archiver cette ou ces demande(s) de contact ?';

    public $confirmButtonText = 'Archiver';

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
