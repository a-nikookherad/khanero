<?php

namespace App\Modules\City\Model;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable=['country_id','name','active'];

    public $timestamps=false;


    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
