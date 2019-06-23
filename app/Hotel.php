<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Hotel extends Model
{
    use AddedBy, SoftDelete;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    /**
     * @return Collection
     */
    public function images()
    {
        /**
         * @var Collection $images
         */
        $images = $this->hasMany(HotelImage::class);
        $images->flatMap(function (HotelImage $image) {
            $image->image = Storage::url($image->image);
            return $image;
        });
        return $images;
    }
}
