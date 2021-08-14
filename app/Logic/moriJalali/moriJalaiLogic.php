<?php


namespace App\Logic\moriJalali;



use Morilog\Jalali\jDate;
use Morilog\Jalali\jDateTime;

class moriJalaiLogic
{
    public function forge($value)
    {
        return jDate::forge($value);
    }

    public function createDatetimeFromFormat($str,$value)
    {
        return jDateTime::createCarbonFromFormat($str,$value);
    }
}