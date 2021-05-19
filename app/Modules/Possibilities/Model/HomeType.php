<?php

namespace App\Modules\Possibilities\Model;

use Illuminate\Database\Eloquent\Model;

class HomeType extends Model
{
    protected $table = 'home_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'active'];

}
