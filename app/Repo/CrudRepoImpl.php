<?php
/**
 * Created by PhpStorm.
 * User: brasaeed
 * Date: 2019-06-25
 * Time: 14:18
 */

namespace App\Repo\Hotel;


use App\Repo\Repo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CrudRepoImpl implements Repo
{

    /**
     * @param Model $model
     * @return boolean
     */
    function create(Model $model): bool
    {
        return $model->save();
    }

    /**
     * @param Builder $queryBuilder
     * @return mixed
     */
    function read(Builder $queryBuilder)
    {
        return $queryBuilder->get();
    }

    /**
     * @param Model $model
     * @param $attributes
     * @return bool
     */
    function update(Model $model, array $attributes): bool
    {
        return $model->update($attributes);
    }

    /**
     * @param Model $model
     * @return bool
     */
    function delete(Model $model): bool
    {
        return $model->delete();
    }
}