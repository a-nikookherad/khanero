<?php

namespace App\Modules\SlideShow\Model;

use Illuminate\Database\Eloquent\Model;
use App\Modules\City\Model\Provicne;
use App\Modules\City\Model\Township;
use App\User;

class SlideShow extends Model
{
    protected $table = 'slideshows';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'link', 'img'];

    public function GetTownship() {
        return $this->hasOne(Township::class, 'id', 'township_id');
    }
}
