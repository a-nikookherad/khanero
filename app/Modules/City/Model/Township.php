<?php

namespace App\Modules\City\Model;

use Illuminate\Database\Eloquent\Model;
use App\Modules\City\Model\City;
use App\Modules\City\Model\Province;

class Township extends Model
{
    protected $table = 'townships';

    protected $fillable = [
        'name', 'alias', 'province_id', 'priority', 'active'
    ];

    public function provinceGet() {
        return $this->hasOne(Province::class, 'id', 'province_id');
    }

}
