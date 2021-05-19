<?php

namespace App\Modules\Payment\Model;

use Illuminate\Database\Eloquent\Model;

class InviteTransaction extends Model
{
    protected $table = 'invite_transactions';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'parent_user_id ', 'price'];
}
