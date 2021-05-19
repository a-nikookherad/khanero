<?php

namespace App\Modules\Host\Model;

use Illuminate\Database\Eloquent\Model;

class RoomCommons extends Model
{
    protected $table = 'room_commons';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['host_id', 'count_man', 'count_woman', 'count_child'];

}
