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

    const STATUS_EXPIRED = -100; // منقضی شده.
    const STATUS_CANCELED_BY_GUEST = -2; // کنسل شده توسط مهمان
    const STATUS_REJECTED = -1; // عدم تایید توسط میزبان.
    const STATUS_REQUEST_TO_CONFIRM = 0; //درخواست پرداخت داده و منتظر تایید توسط میزبان است.
    const STATUS_WAITING_TO_PAY = 1; // تایید شده و منتظر است تا مهمان مبلغ را پرداخت کند.
    const STATUS_PAID  = 2; // پرداخت شده.

    const MY_REQUESTED_RESERVES = 1;
    const MY_GUEST_RESERVES = 2;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'host_id', 'reserve_date', 'week_id', 'day_price',
        'special', 'special_price', 'percent', 'final_price', 'description', 'status'
    ];

    public function getHost() {
        return $this->hasOne(Host::class,  'id','host_id');
    }

    public function Host() {
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

    public static function getReserveStatusList()
    {
        return [
            [
                'value'   => self::STATUS_REQUEST_TO_CONFIRM,
                'message' => "در انتظار تایید",
            ],
            [
                'value'   => self::STATUS_WAITING_TO_PAY,
                'message' => "در انتظار پرداخت",
            ],
            [
                'value'   => self::STATUS_PAID,
                'message' => "پرداخت شده",
            ],
            [
                'value'   => self::STATUS_EXPIRED,
                'message' => "منقضی شده",
            ],

//            [
//                'value'   => self::STATUS_CANCELED_BY_GUEST,
//                'message' => "کنسل شده",
//            ],
            [
                'value'   => self::STATUS_REJECTED,
                'message' => "عدم تایید",
            ],
        ];
    }



}
