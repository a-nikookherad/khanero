<?php

namespace App\Http\Controllers;

use App\Logic\SMS;
use Illuminate\Http\Request;

class SMSController extends Controller
{
    public function register($mobile, $pattern, $data)
    {
        try {
            $smsLogicInstance = new SMS($mobile, $pattern);
            $smsLogicInstance->send($data);
            return true;
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
