<?php

namespace App\Modules\Sms\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Host\Model\ActiveReserve;
use App\Modules\Reserve\Model\Reserve;
use App\Modules\Host\Model\Host;
use App\Modules\Sms\Model\SmsUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Melipayamak;


class SmsController extends Controller
{
    public static function SendSMSRegister($Name, $Mobile, $Token)
    {
//        try {
//            $sms = melipayamak::sms();
//            $to = $Mobile;
//            $from = '10007514';
//            $text = ''.$Name.' عزیز
//به سایت رنت خوش آمدید
//کد فعالسازی "رنت" :'.$Token.'
//راهنمای نحوه رزرو :
//کانال تلگرام :
//شماره پشتیبانی :';
//            $sms->send($to, $from, $text);
//        } catch (Exception $e) {
//            echo $e->getMessage();
//        }
        return true;
    }
    public static function SendSMSRegister2($Mobile, $Token)
    {
//        try {
//            $sms = melipayamak::sms();
//            $to = $Mobile;
//            $from = '10007514';
//            $text = 'کد فعالسازی شما در رنت : ' . $Token . ' می باشد';
//            $sms->send($to, $from, $text);
//        } catch (Exception $e) {
//            echo $e->getMessage();
//        }
        return true;
    }


    public static function SendSMSWaitConfirmHost($Mobile)
    {
//        $userModel = User::where('mobile', $Mobile)->first();
//        if ($userModel->sex == 1) {
//            $sex = ' آقای ';
//        } else {
//            $sex = ' خانم ';
//        }
//        try {
//            $sms = melipayamak::sms();
//            $to = $Mobile;
//            $from = '10007514';
//            $text = ' '. auth()->user()->first_name . ' ' . auth()->user()->last_name .' عزیز
//درخواست میزبانی اقامتگاه شما در "رنت" ثبت شد و پس از بررسی های لازم و تایید توسط تیم "رنت" آگهی شما در سایت گذاشته خواهد شد
//شماره پشتیبانی :';
//            $sms->send($to, $from, $text);
//        } catch (Exception $e) {
//            echo $e->getMessage();
//        }
        return true;
    }


    public static function SendSMSSuccessConfirmHost($Mobile)
    {
//        $userModel = User::where('mobile', $Mobile)->first();
//        try {
//            $sms = melipayamak::sms();
//            $to = $Mobile;
//            $from = '10007514';
//            $text = ''.$userModel->first_name . ' ' . $userModel->last_name.' عزیز
//اقامتگاه شما توسط تیم "رنت" بررسی و تایید شد و اقامتگاه شما در "رنت" گذاشته شد
//شماره پشتیبانی :';
//            $sms->send($to, $from, $text);
//        } catch (Exception $e) {
//            echo $e->getMessage();
//        }
        return true;
    }


    public static function SendSMSWaitReserveCustomer($Mobile)
    {
//        try {
//            $sms = melipayamak::sms();
//            $to = $Mobile;
//            $from = '10007514';
//            $text = ''.auth()->user()->first_name . ' ' . auth()->user()->last_name.' عزیز
//درخواست شما با موفقیت در سیستم ثبت گردید و وضعیت رزرو شما حداکثر تا 3 ساعت کاری آینده از طریق پیامک به اطلاع شما خواهد رسید
//پیگیری رزرو : http://www.rentt.ir/index/reserve
//شماره پشتیبانی :';
//            $sms->send($to, $from, $text);
//        } catch (Exception $e) {
//            echo $e->getMessage();
//        }
        return true;
    }

    public static function SendSMSWaitReserveHost($Mobile, $HostId, $HostName, $CountDayReserve, $DateFrom, $DateTo, $TotalPrice, $Token, $TokenCancel, $CountGuest,$reserveId)
    {
//        $userModel = User::where('mobile', $Mobile)->first();
//        $percent = $TotalPrice*5 / 100;
//        $TotalPrice = $TotalPrice - $percent;
//        $perDay = $TotalPrice / $CountDayReserve;
//        try {
//            $sms = melipayamak::sms();
//            $to = $Mobile;
//            $from = '10007514';
//            $text = ''.$userModel->first_name . ' ' . $userModel->last_name.' عزیز
//مهمانی با قیمت خالص '.$TotalPrice.' تومان با میانگین شبی '.round($perDay).' تومان اقامتگاه '.$HostName.' شما را به مدت '.$CountDayReserve.' شب از تاریخ '.$DateFrom.' تا تاریخ '.$DateTo.' با '.$CountGuest.' مهمان درخواست رزرو کرده است
//در صورتی که امکان اراِئه سرویس به این مهمان را دارید تا 2 ساعت آینده وقت دارید به این پیام پاسخ دهید تا لینک پرداخت برای مهمان ارسال شود
//در صورت تایید کد : '. $Token .'
//عدم تایید کد : '.$TokenCancel.'
//را به همین شماره ارسال کنید
//توجه داشته باشید دیر پاسخ دادن به درخواست ممکن است مهمان منزل دیگری را انتخاب کند
//شماره رزرو :'.$reserveId.'
//شماره پشتیبانی :
//     ';
//            $sms->send($to, $from, $text);
//        } catch (Exception $e) {
//            echo $e->getMessage();
//        }
        return true;
    }


    public static function SendSms()
    {
        return view('Sms::indexSendSmsUser', compact('userModel'));
    }



    public static function SendSMSRecovery($Mobile, $Password) {

//        try {
//            $sms = melipayamak::sms();
//            $to = $Mobile;
//            $from = '10007514';
//            $text = 'رمز جدید شما '.$Password.' می باشد.';
//            $sms->send($to, $from, $text);
//        } catch (Exception $e) {
//            echo $e->getMessage();
//        }
        return true;
    }


    public static function SendSmsUser(Request $request)
    {

        return 2323;
        /**
         * $arr_mobile => array mobile users
         */
        if($request->user_type == 1) {
            $userModelAll = DB::table('users')->where('id', '!=', 1)->select('mobile')->get();
            foreach ($userModelAll as $key => $value) {
                $arr_mobile[] = $value->mobile;
            }
        } elseif($request->user_type == 2) {
            $hostModel = DB::table('hosts')
                ->select('user_id')
                ->groupBy('user_id')
                ->get();
            foreach ($hostModel as $key => $value) {
                $arr_id[] = $value->user_id;
            }
            $userModelHost = DB::table('users')
                ->select('mobile')
                ->where('role_id', '!=', 1)
                ->whereIn('id', $arr_id)
                ->groupBy('mobile')
                ->get();
            foreach ($userModelHost as $key => $value) {
                $arr_mobile[] = $value->mobile;
            }
        } else {
            $hostModel = DB::table('hosts')
                ->select('user_id')
                ->groupBy('user_id')
                ->get();
            foreach ($hostModel as $key => $value) {
                $arr_id[] = $value->user_id;
            }
            $userModelHost = DB::table('users')
                ->select('mobile')
                ->where('role_id', '!=', 1)
                ->whereNotIn('id', $arr_id)
                ->groupBy('mobile')
                ->get();
            foreach ($userModelHost as $key => $value) {
                $arr_mobile[] = $value->mobile;
            }
        }

        for($i = 1; $i <= count($arr_mobile); $i++) {
            $arr_message[] = $request->message;
        }


        foreach ($arr_mobile as $key => $value) {
            try {
                $sms = melipayamak::sms();
                $to = $value;
                $from = '10007514';
                $text = $request->message;
                $sms->send($to, $from, $text);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }



        $smsUser = new SmsUser();
        $smsUser->user_type = $request->user_type;
        $smsUser->message = $request->message;
        if($smsUser->save()) {
            PrintMessage('ارسال پیام موفقیت آمیز بود.', 'success');
        } else {
            PrintMessage('خطا در ارسال پیامک، لطفا مجددا تلاش نمایید.', 'danger');
        }
        return back();
    }


    /*
     *    http://www.rentt.ir/get-sms?from=$FROM$&to=$TO$&body=$TEXT$
     */


    public function GetSms()
    {
        $Message = $_REQUEST['body'];
        $From = $_REQUEST['from'];
        $To = $_REQUEST['to'];
        $activeReserveModel = ActiveReserve::where('token', $Message)->first();


        if(empty($activeReserveModel)) {
            $check = 'cancel';
        } else {
            $check = 'confirm';
        }

        // Cancel reserve ///////////////////////////////
        if($check == 'cancel') {
            $activeReserveModel = ActiveReserve::where('token_cancel', $Message)->first();
            if(empty($activeReserveModel)) {
                return 0; // not found !
            }
            /** ****************************************************************** */
            /** ********* REJECT ************************************************* */
            /** ****************************************************************** */
            $reserveModel = Reserve::where('user_id', $activeReserveModel->user_id)
                ->where('group_code', $activeReserveModel->group_code)
                ->where('host_id', $activeReserveModel->host_id)
                ->where('status', 0)
                ->orderBy('id', 'DESC')
                ->first();
            if (!empty($reserveModel)) {
                DB::table('reserves')
                    ->where('user_id', $activeReserveModel->user_id)
                    ->where('host_id', $activeReserveModel->host_id)
                    ->where('group_code', $reserveModel->group_code)
                    ->where('status', 0)
                    ->update(['status' => -1]); // reject reserve by host user
                // Delete Token
                // 09385468772 meli payamak
                ActiveReserve::where('token_cancel', $Message)->delete();
                // Send Sms For Payment
                $userModel = User::where('id', $activeReserveModel->user_id)->first();
                $hostModel = Host::where('id', $activeReserveModel->host_id)->with('getTownship', 'getUser')->first();
                $userHostModel = User::where('id', $hostModel->user_id)->first();
                // sms for guest
                try {
                    $sms = melipayamak::sms();
                    $to = $userModel->mobile;
                    $from = '10007514';
                    $text = ''.$userModel->first_name . ' ' . $userModel->last_name.' عزیز
درخواست رزرو برای اقامتگاه'. $hostModel->name .' توسط میزبان رد شد
شما میتوانید از طریق لینک زیر خانه دیگری در شهر'. $hostModel->getTownship->name .' را انتخاب کنید
لینک : http://www.rentt.ir/city/'.$hostModel->getTownship->id.'
پشتیبانی :';
                    $sms->send($to, $from, $text);
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
                // sms for host
                try {
                    $sms = melipayamak::sms();
                    $to = $userHostModel->mobile;
                    $from = '10007514';
                    $text = ''.$userHostModel->first_name . ' ' . $userHostModel->last_name.' عزیز
درخواست رزرو با موفقیت رد شد، لطفا تقویم خود را به روز رسانی کنید
لینک تقویم :
پشتیبانی :';
                    $sms->send($to, $from, $text);
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
                return true;
            } else {
                return 0; // not found !
            }
        } else {
            $activeReserveModel = ActiveReserve::where('token', $Message)->first();
            if (!empty($activeReserveModel)) {
                // confirm reserve by user host (get token code)
//                File::put('frontend/121212.txt', $Message);
                /** ****************************************************************** */
                /** ********* CONFIRM ************************************************ */
                /** ****************************************************************** */
                $reserveModel = Reserve::where('user_id', $activeReserveModel->user_id)
                    ->where('group_code', $activeReserveModel->group_code)
                    ->where('host_id', $activeReserveModel->host_id)
                    ->where('status', 0)
                    ->orderBy('id', 'DESC')
                    ->first();
                if (!empty($reserveModel)) {
                    DB::table('reserves')
                        ->where('user_id', $activeReserveModel->user_id)
                        ->where('host_id', $activeReserveModel->host_id)
                        ->where('group_code', $activeReserveModel->group_code)
                        ->where('status', 0)
                        ->update(['status' => 1, 'step' => 2]); // success by host user and waiting payment for customer
                    // Delete Token
                    ActiveReserve::where('token', $Message)->delete();
                    // Send Sms For Payment
                    $userModel = User::where('id', $activeReserveModel->user_id)->first();
                    $hostModel = Host::where('id', $activeReserveModel->host_id)->with('getTownship', 'getUser')->first();
                    $userHostModel = User::where('id', $hostModel->user_id)->first();
                    // sms for guest
                    try {
                        $sms = melipayamak::sms();
                        $to = $userModel->mobile;
                        $from = '10007514';
                        $text = ''.$userModel->first_name . ' ' . $userModel->last_name.' عزیز
میزبان درخواست شما را تایید کرد حال برای پرداخت و نهایی کردن رزرو خود تا 2 ساعت وقت دارید مبلغ را با لینک زیر پرداخت کنید
www.rentt.ir/index/reserve
پشتیبانی :';
                        $sms->send($to, $from, $text);
                    } catch (Exception $e) {
                        echo $e->getMessage();
                    }
                    // sms for host
                    try {
                        $sms = melipayamak::sms();
                        $to = $userHostModel->mobile;
                        $from = '10007514';
                        $text = ''.$userHostModel->first_name . ' ' . $userHostModel->last_name.' عزیز
با موفقیت درخواست رزرو تایید شد لطفا تا 3 ساعت برای پرداخت از طرف مهمان منتظر بمانید
پشتیبانی :';
                        $sms->send($to, $from, $text);
                    } catch (Exception $e) {
                        echo $e->getMessage();
                    }
                    return true;
                } else {
                    return 0;
                }
            } else {
                return 0; // not found !
            }
        }

    }


    public static function SendSuccessSMS($MobileHost, $Mobile, $price)
    {
//        $sitePercent = config('setting.SitePercent') + config('setting.InvitePercent');
//        $p = ($price*$sitePercent)/100;
//        $price = $price-$p;
        $userModel = User::where('mobile', $MobileHost)->first();
        try {
            $sms = melipayamak::sms();
            $to = $MobileHost;
            $from = '10007514';
            $text = ''.$userModel->first_name .' '.$userModel->last_name.' عزیز
مهمان مبلغ '. $price .' را به حساب سایت رنت پرداخت کرد، برای اطمینان مهمان مبلغ 24 ساعت بعد از تحویل اقامتگاه به حساب شما واریز خواهد شد
شماره تماس مهمان'.$Mobile.'
لطفا برای مهمان نوازی هماهنگی های لازم را انجام دهید
اگر پیش پرداخت انجام شده شما بایستی مابقی را حضورا از مهمان دریافت کنید
پشتیبانی :';
            $sms->send($to, $from, $text);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return true;
    }


    public static function SendSuccessSMS2($Mobile, $MobileHost, $Lat, $Long, $Address)
    {
        $userModel = User::where('mobile', $Mobile)->first();
        try {
            $sms = melipayamak::sms();
            $to = $Mobile;
            $from = '10007514';
            $text = ''.$userModel->first_name .' '.$userModel->last_name.' عزیز
            فاکتور با موفقیت پرداخت شد
شماره میزبان :'. $MobileHost .'
آدرس میزبان :'. $Address .'
لطفا جهت هماهنگی های بیشتر با میزبان تماس بگیرید
 لوکیشن : https://www.waze.com/livemap?ll='.$Lat.','.$Long.'&amp;navigate=yes
با تشکر از اعتمادتان، سفر خوبی برایتان آرزومندیم
رنت را به دوستان خود معرفی کرده و پولدار شوید
پشتیبانی :';
            $sms->send($to, $from, $text);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return true;
    }
}






// last func for get sms

//public function GetSms()
//{
//    $Message = $_REQUEST['body'];
//    $From = $_REQUEST['from'];
//    $To = $_REQUEST['to'];
//    $activeReserveModel = ActiveReserve::where('token', $Message)->first();
//    if (!empty($activeReserveModel)) {
//        if ($Message == '0') { // reject reserve by host user
//            File::put('frontend/1221.txt', $Message);
//            /** ****************************************************************** */
//            /** ********* REJECT ************************************************* */
//            /** ****************************************************************** */
//            $reserveModel = Reserve::where('user_id', $activeReserveModel->user_id)
//                ->where('host_id', $activeReserveModel->host_id)
//                ->where('status', 0)
//                ->orderBy('id', 'DESC')
//                ->first();
//            if (!empty($reserveModel)) {
//                DB::table('reserves')
//                    ->where('user_id', $activeReserveModel->user_id)
//                    ->where('host_id', $activeReserveModel->host_id)
//                    ->where('group_code', $reserveModel->group_code)
//                    ->where('status', 0)
//                    ->update(['status' => -1]); // reject reserve by host user
//                // Delete Token
//                // 09385468772 meli payamak
//                ActiveReserve::where('token', $Message)->delete();
//                // Send Sms For Payment
//                $userModel = User::where('id', $activeReserveModel->user_id)->first();
//                if ($userModel->sex == 1) {
//                    $sex = ' آقای ';
//                } else {
//                    $sex = ' خانم ';
//                }
//                try {
//                    $sms = melipayamak::sms();
//                    $to = $userModel->mobile;
//                    $from = '5000106001176';
//                    $text = $sex . $userModel->first_name . ' ' . $userModel->last_name . ' عزیز ، میزبان با درخواست شما مخالفت کرده است، لطفا پس از بازدید دوباره از سایت اقامتگاه دیگری را انتخاب کنید باتشکر. پیگیری رزرو : 3333 شماره پشتیبانی : 2222';
//                    $sms->send($to, $from, $text);
//                } catch (Exception $e) {
//                    echo $e->getMessage();
//                }
//                return true;
//            } else {
//                return 0; // not found !
//            }
//        } else {
//            // confirm reserve by user host (get token code)
//            File::put('frontend/121212.txt', $Message);
//            /** ****************************************************************** */
//            /** ********* CONFIRM ************************************************ */
//            /** ****************************************************************** */
//            $reserveModel = Reserve::where('user_id', $activeReserveModel->user_id)
//                ->where('host_id', $activeReserveModel->host_id)
//                ->where('status', 0)
//                ->orderBy('id', 'DESC')
//                ->first();
//            if (!empty($reserveModel)) {
//                DB::table('reserves')
//                    ->where('user_id', $activeReserveModel->user_id)
//                    ->where('host_id', $activeReserveModel->host_id)
//                    ->where('group_code', $reserveModel->group_code)
//                    ->where('status', 0)
//                    ->update(['status' => 1]); // success by host user and waiting payment for customer
//                // Delete Token
//                ActiveReserve::where('token', $Message)->delete();
//                // Send Sms For Payment
//                $userModel = User::where('id', $activeReserveModel->user_id)->first();
//                if ($userModel->sex == 1) {
//                    $sex = ' آقای ';
//                } else {
//                    $sex = ' خانم ';
//                }
//                try {
//                    $sms = melipayamak::sms();
//                    $to = $userModel->mobile;
//                    $from = '5000106001176';
//                    $text = $sex . $userModel->first_name . ' ' . $userModel->last_name . ' عزیز ، میزبان درخواست شما را تایید کرد حال برای پرداخت و نهایی کردن رزرو خود تا 3 ساعت وقت دارید به پنل کاربری خود مراجعه کرده و در قسمت "رزرو های من" مبلغ را پرداخت کنید. پیگیری رزرو : 3333 شماره پشتیبانی : 2222';
//                    $sms->send($to, $from, $text);
//                } catch (Exception $e) {
//                    echo $e->getMessage();
//                }
//                return true;
//            } else {
//                return 0;
//            }
//        }
//    } else {
//        return 0; // not found !
//    }
//}