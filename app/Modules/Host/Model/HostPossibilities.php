<?php

namespace App\Modules\Host\Model;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Possibilities\Model\Option;

class HostPossibilities extends Model
{
    protected $table = 'host_possibilities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['host_id', 'option_id'];

    public function getOption() {
        return $this->hasOne(Option::class, 'id', 'option_id');
    }

}
