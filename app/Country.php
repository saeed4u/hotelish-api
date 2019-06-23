<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function customers(){
        return $this->hasMany(Customer::class);
    }

    /**
     * This collection will always be of size 1
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hotels(){
        return $this->hasMany(Hotel::class);
    }
}
