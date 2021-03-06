<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoomType extends Model
{
    use AddedBy, SoftDeletes;

    protected $fillable = ['name'];
    //
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rooms(){
        return $this->hasMany(Room::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function pricing(){
        return $this->hasOne(Pricing::class);
    }
}
