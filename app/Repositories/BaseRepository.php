<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Builder;

abstract class BaseRepository
{
    protected string $model;

    protected function query():Builder{
        return $this->model::query();
    }
}
