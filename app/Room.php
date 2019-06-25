<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Room extends Model
{

    use AddedBy, SoftDelete;

    //

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(RoomType::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * @return Collection
     */
    public function images()
    {
        /**
         * @var Collection $images
         */
        $images = $this->hasMany(RoomImage::class);
        $images->flatMap(function (RoomImage $image) {
            $image->image = Storage::url($image->image);
            return $image;
        });
        return $images;
    }
}
