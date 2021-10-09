<?php

namespace App\Helper;


use App\Jobs\SendAdminEmail;
use App\Jobs\SendMail;
use Illuminate\Support\Facades\Mail;
use App\Jobs\sendShareMail;
use Morilog\Jalali\jDateTime;


class DateHelper
{
    public static function SolarToGregorian($date, $delimeter = '/', $imploder = '-')
    {
       $date = explode($delimeter, $date);

       $gregorian_date_array = jDateTime::toGregorian($date[0], $date[1], $date[2]);

       $gregorian_date = [];

        collect($gregorian_date_array)->each(function($gregorian_index) use(&$gregorian_date){
            if($gregorian_index < 10) $gregorian_index = '0'.$gregorian_index;
            array_push($gregorian_date, $gregorian_index);
        });

       return implode($imploder, $gregorian_date);

    }


    public static function GregorianDateToSolar($date, $delimeter = '/')
    {
        $date = explode($delimeter, $date);

        $gregorian_date_array = jDateTime::toJalali($date[0], $date[1], $date[2]);

        $gregorian_date = [];

        collect($gregorian_date_array)->each(function($gregorian_index) use(&$gregorian_date){
            if($gregorian_index < 10) $gregorian_index = '0'.$gregorian_index;
            array_push($gregorian_date, $gregorian_index);
        });

        return implode('/', $gregorian_date);
    }

}
