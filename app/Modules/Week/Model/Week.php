<?php

namespace App\Modules\Week\Model;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Services\Model\TimeSheetServices;

class Week extends Model
{
    protected $table = 'weeks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['day' ,'e_day', 'sign', 'active'];

}
