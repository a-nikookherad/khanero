<?php


namespace App\Logic\moriJalali;


interface moriJalaliInterfaceAdapter
{
    public function forge($value);

    public function createCarbonFromFormat($str,$value);
}