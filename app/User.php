<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

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
    ];

    protected static function boot()
    {
        parent::boot();
        static::created(function (User $user) {
            if ($user->type === 'customer') {
                $customer = new Customer();
                $customer->user_id = $user->id;
                $customer->phone = '';
                $customer->save();
            }
        });
    }

    /**
     * Returns the customer associated to the user or null if user is not a customer
     * @return \Illuminate\Database\Eloquent\Relations\HasOne | null
     */
    public function customer()
    {
        return $this->hasOne(Customer::class);
    }

}
