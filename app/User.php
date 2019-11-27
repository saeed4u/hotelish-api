<?php

namespace App;

use App\Utils\Constants;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, SoftDeletes;

    public static $USER_TYPES = ['admin', 'customer'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'last_login',
        'last_ip',
        'login_attempts',
        'status',
        'created_at',
        'deleted_at',
        'updated_at',
        'email_verified_at'
    ];

    protected static function boot()
    {
        parent::boot();
        static::created(function (User $user) {
            /*if ($user->user_type === 'customer') {
                $customer = new Customer();
                $customer->user_id = $user->id;
                $customer->phone = '';
                $customer->save();
            }*/
        });
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        //we will use the user's primary key
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }


    public function devices()
    {
        $userDevices = $this->userDevices;
        $devices = collect();
        $userDevices->each(function (UserOnDevice $userDevice) use ($devices) {
            $devices->push($userDevice->device);
        });

        return $devices;
    }

    public function userDevices()
    {
        return $this->hasMany(UserOnDevice::class)->with('device')->where('status_code', Constants::$ACTIVE);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

}
