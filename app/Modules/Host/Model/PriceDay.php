<?php

namespace App\Modules\Host\Model;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Week\Model\Week;

class PriceDay extends Model
{
    protected $table = 'price_days';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['host_id', 'week_id', 'price'];

    public function getWeek() {
        return $this->hasOne(Week::class, 'id', 'week_id');
    }

}
