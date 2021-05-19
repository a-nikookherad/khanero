<?php

namespace App\Modules\MultiAuth\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    public $table='password_resets';

    public $timestamps=false;

    protected $fillable=['user_id','token'];


    public function user()
    {
        return $this->hasOne(User::class);
    }
}
