<?php

namespace App\Modules\Possibilities\Model;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $table = 'options';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'active', 'description'];

}
