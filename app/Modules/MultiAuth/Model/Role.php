<?php

namespace App\Modules\MultiAuth\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable=['role','title'];

    public $timestamps=false;
}
