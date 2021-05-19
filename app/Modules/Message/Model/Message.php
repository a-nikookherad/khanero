<?php

namespace App\Modules\Message\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Message extends Model
{
    protected $table = 'messages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['sender_id', 'receiver_id', 'title', 'message', 'file', 'view', 'reply', 'parent_id'];


    public function userGet() {
        return $this->hasOne(User::class, 'id', 'sender_id');
    }

    public function sendToUserGet() {
        return $this->hasOne(User::class, 'id', 'receiver_id');
    }

}
