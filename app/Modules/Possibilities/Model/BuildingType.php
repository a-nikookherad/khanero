<?php

namespace App\Modules\Possibilities\Model;

use Illuminate\Database\Eloquent\Model;

class BuildingType extends Model
{
    protected $table = 'building_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'active'];

}
