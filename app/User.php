<?php

namespace App;

use App\Modules\City\Model\City;
use App\Modules\City\Model\Province;
use App\Modules\City\Model\Township;
use App\Modules\User\Model\Document;
use App\Modules\Payment\Model\Account;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name','user_name',

        'password','alias','city_id',

        'role_id','mobile','telephone','email','sex',

        'show_email','active','first_login',

        'avatar','birth_date','address','confirm_rules'
    ];


    protected $softDelete = true;
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getCity() {
        return $this->hasOne(City::class, 'id', 'city_id');
    }

    public function getTownship() {
        return $this->hasOne(Township::class, 'id', 'city_id');
    }

    public function getDocument() {
        return $this->hasMany(Document::class, 'user_id', 'id');
    }
    
    public function getAccount() {
        return $this->hasMany(Account::class, 'user_id', 'id');
    }

//    public function getProvince() {
//        return $this->hasOne(Province::class, 'id', 'city_id');
//    }
}
