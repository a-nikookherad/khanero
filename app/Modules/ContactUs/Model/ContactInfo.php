<?php

namespace App\Modules\ContactUs\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;

class ContactInfo extends Model
{
    protected $table = 'contact_infos';

    protected $fillable = ['phone', 'email', 'google', 'telegram',
        'facebook', 'instagram', 'address', 'latitude', 'longitude'
    ];

    public $timestamps = false;
}


