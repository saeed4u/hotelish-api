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
    public function roomCapacity()
    {
        return $this->belongsTo(RoomCapacity::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }
}
