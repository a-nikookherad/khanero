<?php

namespace App\Modules\Special\Model;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Host\Model\Host;

class Month extends Model
{
    protected $table = 'months';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'number_day'];

}
