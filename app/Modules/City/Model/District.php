<?php

namespace App\Modules\City\Model;

use Illuminate\Database\Eloquent\Model;
use App\Modules\City\Model\City;
use App\Modules\City\Model\Province;

class District extends Model
{
    protected $table = 'districts';

    protected $fillable = [
        'province_id', 'city_id', 'area_id', 'township_id', 'name', 'active'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }




    public function cityGet() {
        return $this->hasOne(City::class, 'id', 'city_id');
    }

    public function provinceGet() {
        return $this->hasOne(Province::class, 'id', 'province_id');
    }

}
