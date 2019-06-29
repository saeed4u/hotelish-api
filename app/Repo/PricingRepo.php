<?php
/**
 * Created by PhpStorm.
 * User: brasaeed
 * Date: 2019-06-26
 * Time: 15:30
 */

namespace App\Repo;


use App\Pricing;
use App\Repo\Hotel\CrudRepoImpl;
use Illuminate\Database\Eloquent\Model;

class PricingRepo extends CrudRepoImpl
{

    public function create(Model $model): bool
    {
        /**
         * @var Pricing $pricing
         */
      /*  $pricing = Pricing::where('room_type_id', $model->room_type_id)->first();
        if ($pricing) {
            $pricing->price = $model->price;
            return $pricing->save();
        }*/
        return parent::create($model);
    }
}