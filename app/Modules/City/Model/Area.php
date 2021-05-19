<?php

namespace App\Modules\City\Model;

use Illuminate\Database\Eloquent\Model;
use App\Modules\City\Model\Province;
use App\Modules\City\Model\City;

class Area extends Model
{

    protected $table = 'areas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['province_id', 'city_id', 'area_number', 'active'];


    public function provinceGet() {
        return $this->hasOne(Province::class, 'id', 'province_id');
    }

    public function cityGet() {
        return $this->hasOne(City::class, 'id', 'city_id');
    }

}
