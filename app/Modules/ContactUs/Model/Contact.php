<?php

namespace App\Modules\ContactUs\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Contact extends Model
{
    protected $table = 'contacts';

    protected $fillable = ['name', 'email', 'phone', 'subject', 'content', 'view'];

}


