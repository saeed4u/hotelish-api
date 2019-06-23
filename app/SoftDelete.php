<?php
/**
 * Created by PhpStorm.
 * User: brasaeed
 * Date: 2019-06-23
 * Time: 22:39
 */

namespace App;


use Illuminate\Database\Eloquent\SoftDeletes;

trait SoftDelete
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
}