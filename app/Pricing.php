<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pricing extends Model
{

    use AddedBy, SoftDelete;

    //

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }
}
