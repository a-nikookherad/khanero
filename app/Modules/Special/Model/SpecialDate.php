<?php

namespace App\Modules\Special\Model;

use Illuminate\Database\Eloquent\Model;

class SpecialDate extends Model
{
    protected $table = 'special_dates';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['date', 'description'];

}
