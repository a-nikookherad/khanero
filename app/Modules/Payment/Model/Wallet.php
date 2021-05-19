<?php

namespace App\Modules\Payment\Model;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $table = 'wallets';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'reserve_code', 'payment_id', 'price', 'type', 'description'];
}
