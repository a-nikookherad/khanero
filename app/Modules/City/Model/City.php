<?php

namespace App\Modules\City\Model;

use App\Modules\Poster\Model\Poster;
use App\Modules\City\Model\Province;
use App\Modules\City\Model\Township;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{

    protected $fillable=['name','province_id','township','active'];


    public function provinceGet() {
        return $this->hasOne(Province::class, 'id', 'province_id');
    }

    public function townshipGet() {
        return $this->hasOne(Township::class, 'id', 'township_id');
    }
}
