<?php

namespace App\Modules\Host\Model;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['host_id', 'single_beds', 'double_beds', 'toilet_bathroom', 'active'];

}
