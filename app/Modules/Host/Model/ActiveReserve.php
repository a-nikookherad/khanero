<?php

namespace App\Modules\Host\Model;

use Illuminate\Database\Eloquent\Model;

class ActiveReserve extends Model
{
    protected $table = 'active_reserves';

    protected $fillable=['user_id','host_id','token'];

}
