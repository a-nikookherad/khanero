<?php

namespace App\Modules\City\Model;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable=[
        'country_name','country_code','code','priority','active'
    ];

    public $timestamps=false;
}
