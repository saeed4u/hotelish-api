<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use AddedBy, SoftDelete;
    //
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rooms(){
        return $this->hasMany(Room::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pricings(){
        return $this->hasMany(Pricing::class);
    }
}
