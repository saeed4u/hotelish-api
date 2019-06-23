<?php
/**
 * Created by PhpStorm.
 * User: brasaeed
 * Date: 2019-06-23
 * Time: 22:38
 */

namespace App;


trait AddedBy
{
    public function addedBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}