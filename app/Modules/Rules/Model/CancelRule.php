<?php

namespace App\Modules\Rules\Model;

use Illuminate\Database\Eloquent\Model;

class CancelRule extends Model
{
    protected $table = 'cancel_rules';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description'];

}
