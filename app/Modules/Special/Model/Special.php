<?php

namespace App\Modules\Special\Model;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Host\Model\Host;

class Special extends Model
{
    protected $table = 'special_days';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [''];


    public function getHost() {
        return $this->hasOne(Host::class, 'id', 'host_id');
    }
}
