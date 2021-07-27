<?php

namespace App\Modules\Reserve\Model;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Host\Model\Host;
use App\Modules\Week\Model\Week;
use App\Modules\Payment\Model\Payment;
use App\Modules\Payment\Model\Wallet;
use App\User;

class Reserve extends Model
{
    protected $table = 'reserves';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'host_id', 'reserve_date', 'week_id', 'day_price',
        'special', 'special_price', 'percent', 'final_price', 'description', 'status'
    ];

//    public function getHost() {
//        return $this->hasOne(Host::class,  'id','host_id');
//    }
    public function getHost() {
        return $this->belongsTo(Host::class,  'host_id','id');
    }

    public function getWeek() {
        return $this->hasOne(Week::class, 'id', 'week_id');
    }

    public function getUser() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function getPayment() {
        return $this->hasOne(Payment::class, 'reserve_code', 'group_code');
    }

    public function getPenaltyWallet() {
        return $this->hasMany(Wallet::class, 'reserve_code', 'group_code');
    }

}
