<?php

namespace App\Modules\Favorite\Model;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Host\Model\Host;
use App\User;

class Favorite extends Model
{
    protected $table = 'favorites';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'host_id'];


    public function getHost() {
        return $this->hasOne(Host::class, 'id', 'host_id');
    }

    public function getUser() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
