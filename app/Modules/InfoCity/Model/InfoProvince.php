<?php

namespace App\Modules\InfoCity\Model;

use App\Modules\City\Model\Province;
use Illuminate\Database\Eloquent\Model;

class InfoProvince extends Model
{
    protected $table = 'info_provinces';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['province_id','img','content','active'];

    public function getProvince() {
        return $this->hasOne(Province::class, 'id', 'province_id');
    }

}