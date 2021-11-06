<?php

namespace App\Http\Controllers;

use App\Logic\SMS;
use Illuminate\Http\Request;

class SMSController extends Controller
{
    public function register($mobile, $password)
    {
        try {
            $pattern = "1qodulr83z";//"3cy9f4wuw3";
            $smsLogicInstance = new SMS($mobile, $pattern);

            $input_data = [
                "mobile" => $mobile,
                "password" => $password,
            ];
            $smsLogicInstance->send($input_data);
            return true;
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
