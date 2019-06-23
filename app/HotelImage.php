<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HotelImage extends Model
{
    //
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hotel(){
        return $this->belongsTo(Hotel::class);
    }
}
