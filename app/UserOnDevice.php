<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserOnDevice extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

}
