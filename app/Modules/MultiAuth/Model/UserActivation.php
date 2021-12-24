<?php

namespace App\Modules\MultiAuth\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * این کلاس متعلق به پیامک های فعالسازی میباشد
 */
class UserActivation extends Model
{
    protected $fillable = ['user_id', 'token'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
