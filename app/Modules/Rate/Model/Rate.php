<?php

namespace App\Modules\Rate\Model;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Host\Model\Host;
use App\User;

class Rate extends Model
{
    protected $table='rates';

    protected $fillable=['user_id', 'host_id', 'rate', 'type'];

    public function getUser() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function getHost() {
        return $this->hasOne(Host::class, 'id', 'host_id');
    }
}
