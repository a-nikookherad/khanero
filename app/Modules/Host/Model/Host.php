<?php

namespace App\Modules\Host\Model;

use Illuminate\Database\Eloquent\Model;
use App\Modules\City\Model\Province;
use App\Modules\City\Model\Township;
use App\Modules\Host\Model\HostPossibilities;
use App\Modules\Host\Model\HostRules;
use App\Modules\Host\Model\Room;
use App\Modules\Host\Model\Gallery;
use App\Modules\Host\Model\PriceDay;
use App\Modules\Host\Model\RoomCommons;
use App\Modules\Discount\Model\Discount;
use App\Modules\Reserve\Model\Reserve;
use App\Modules\Possibilities\Model\PositionType;
use App\Modules\Possibilities\Model\Option;
use App\Modules\Possibilities\Model\BuildingType;
use App\Modules\Possibilities\Model\HomeType;
use App\Modules\Special\Model\Special;
use App\Modules\Favorite\Model\Favorite;
use App\Modules\Rate\Model\Rate;
use App\User;

class Host extends Model
{
    protected $table = 'hosts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'name', 'img', 'meter', 'province_id', 'township_id', 'city_id', 'district_id',
        'address', 'home_type_id', 'building_type_id', 'position_array', 'name', 'shared_yard', 'count_guest', 'count_room',
        'count_bathroom', 'count_toilet', 'min_reserve_day', 'closest_time_reserve', 'time_enter', 'time_exit', 'latitude',
        'longitude', 'new_rule', 'description', 'count_reserve', 'integrated_id', 'active', 'step'
    ];

    public function getUser() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function getProvince() {
        return $this->hasOne(Province::class, 'id', 'province_id');
    }

    public function getTownship() {
        return $this->hasOne(Township::class, 'id', 'township_id');
    }

    public function getPositionType() {
        return $this->hasOne(PositionType::class, 'id', 'position_id');
    }

    public function getRoomCommon() {
        return $this->hasOne(RoomCommons::class, 'host_id', 'id');
    }

    public function getBuildingType() {
        return $this->hasOne(BuildingType::class, 'id', 'building_type_id');
    }

    public function getHomeType() {
        return $this->hasOne(HomeType::class, 'id', 'home_type_id');
    }

    public function getHostPossibilities() {
        return $this->hasMany(HostPossibilities::class, 'host_id', 'id');
    }

    public function getDiscount() {
        return $this->hasMany(Discount::class, 'host_id', 'id');
    }

    public function getHostRules() {
        return $this->hasMany(HostRules::class, 'host_id', 'id');
    }

    public function getRoom() {
        return $this->hasMany(Room::class, 'host_id', 'id');
    }

    public function getGallery() {
        return $this->hasMany(Gallery::class, 'host_id', 'id');
    }

    public function getGalleryFirst() {
        return $this->hasOne(Gallery::class, 'host_id', 'id');
    }

    public function getPriceDay() {
        return $this->hasMany(PriceDay::class, 'host_id', 'id');
    }

    public function getReserve() {
        return $this->hasMany(Reserve::class, 'host_id', 'id');
    }

    public function getRate() {
        return $this->hasMany(Rate::class, 'host_id', 'id');
    }

    public function getFavorite() {
        return $this->hasOne(Favorite::class, 'host_id', 'id')->where('user_id', auth()->user()->id);
    }

    public function getInstantBooking() {
        return $this->hasOne(InstantBooking::class, 'host_id', 'id');
    }

    public function getLastMinuteReserve() {
        return $this->hasOne(LastMinuteReserve::class, 'host_id', 'id');
    }

}
