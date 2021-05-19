<?php

namespace App\Modules\InfoCity\Model;

use App\Modules\City\Model\Township;
use App\Modules\City\Model\Province;
use Illuminate\Database\Eloquent\Model;

class InfoTownship extends Model
{
    protected $table = 'info_townships';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['township_id','img','content','active'];

    public function getTownship() {
        return $this->hasOne(Township::class, 'id', 'township_id');
    }

    public function getProvince() {
        return $this->hasOne(Province::class, 'id', 'province_id');
    }

}