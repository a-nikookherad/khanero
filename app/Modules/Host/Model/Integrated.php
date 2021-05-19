<?php

namespace App\Modules\Host\Model;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Host\Model\GalleryIntegrated;
use App\Modules\Host\Model\Host;
use App\User;

class Integrated extends Model
{
    protected $table = 'integrateds';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'title', 'img', 'count_host', 'description', 'latitude', 'longitude'];

    public function getUser() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function getHost() {
        return $this->hasMany(Host::class, 'integrated_id', 'id');
    }

    public function getGallery() {
        return $this->hasMany(GalleryIntegrated::class, 'integrated_id', 'id');
    }
    
}
