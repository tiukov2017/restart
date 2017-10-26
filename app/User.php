<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','phone','status', 'password','customer_fk','crm_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getRole(){

        return $this->roles()->pluck('name')->first();

    }

    /**
     * Check is this the first user login
     */
    public function getIsFirstLogin(){

        return is_null($this->getRememberToken());
    }

    public function customer(){

        return $this->hasOne('App\DAO\CustomerDAO','customer_fk')->first();
    }

}
