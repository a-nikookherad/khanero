<?php

namespace App\Modules\Discount\Model;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Host\Model\Host;

class Discount extends Model
{
    protected $table = 'discount_days';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['host_id', 'date', 'percent'];


    public function getHost() {
        return $this->hasOne(Host::class, 'id', 'host_id');
    }
}
