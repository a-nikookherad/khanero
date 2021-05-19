<?php

namespace App\Modules\Panel\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\City\Model\City;
use App\Modules\City\Model\Country;
use App\Modules\City\Model\Province;
use App\Modules\ContactUs\Model\Contact;
use App\Modules\DayNews\Model\DayNews;
use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Morilog\Jalali\Facades\jDate;
use Morilog\Jalali\Facades\jDateTime;

class PanelController extends Controller
{

    //Admin Dashboard
    public function AdminDashboard()
    {
        if(auth()->user()->role_id == 1) {
            return view('Panel::Dashboard.Admin');
        } else {
            return view('Panel::Dashboard.User');
        }
    }


    //User Dashboard
    public function UserDashboard()
    {
        if(auth()->user()->first_login=='0') {
            auth()->user()->first_login = '1';
            if (auth()->user()->save()) {
                return redirect(route('EditUser'));
            }
        }
        if(auth()->user()->role_id == 1) {
            return view('Panel::Dashboard.Admin');
        } else {
            return view('Panel::Dashboard.User');
        }
    }


}
