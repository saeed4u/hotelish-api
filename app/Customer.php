<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

   // use SoftDelete;

    protected static function boot()
    {
        parent::boot();
        static::created(function (Customer $customer) {
            //we can send welcome email here
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

}
