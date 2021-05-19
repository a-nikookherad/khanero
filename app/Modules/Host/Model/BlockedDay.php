<?php

namespace App\Modules\Host\Model;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Host\Model\Host;

class BlockedDay extends Model
{
    protected $table = 'blocked_days';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['host_id', 'date'];


    public function getHost() {
        return $this->hasOne(Host::class, 'id', 'host_id');
    }
}
