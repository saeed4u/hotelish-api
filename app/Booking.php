<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{

    use SoftDelete;

    //

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pricing()
    {
        return $this->belongsTo(Pricing::class);
    }

}
