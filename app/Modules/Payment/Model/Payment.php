<?php

namespace App\Modules\Payment\Model;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['price', 'user_id', 'reserve_code', 'tracking_code', 'ref_id', 'status'];
}
