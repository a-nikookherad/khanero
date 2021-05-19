<?php

namespace App\Modules\User\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Document extends Model
{
    protected $table = 'documents';

    public function getUser() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
