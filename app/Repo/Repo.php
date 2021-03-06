<?php
/**
 * Created by PhpStorm.
 * User: brasaeed
 * Date: 2019-06-24
 * Time: 00:46
 */

namespace App\Repo;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

interface Repo
{
    /**
     * @param Model $model
     * @return boolean
     */
    function create(Model $model): bool;

    /**
     * @param Builder $queryBuilder
     * @return mixed
     */
    function read(Builder $queryBuilder);

    /**
     * @param Model $model
     * @param $attributes
     * @return bool
     */
    function update(Model $model, array $attributes): bool;

    /**
     * @param Model $model
     * @return bool
     */
    function delete(Model $model): bool;

}