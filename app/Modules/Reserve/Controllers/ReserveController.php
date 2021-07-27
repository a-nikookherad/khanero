<?php

namespace App\Modules\Reserve\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Host\Model\Host;
use App\Modules\Reserve\Model\Reserve;
use App\Modules\Host\Model\BlockedDay;
use App\Modules\Host\Model\PriceDay;
use App\Modules\Host\Model\ActiveReserve;
use App\Modules\Special\Model\Special;
use App\Modules\Special\Model\SpecialDate;
use App\Modules\Discount\Model\Discount;
use App\Modules\Message\Model\Message;
use App\Modules\Payment\Model\Payment;
use App\Modules\Payment\Model\Wallet;
use Morilog\Jalali\Facades\jDate;
use Morilog\Jalali\Facades\jDateTime;
use App\Modules\Sms\Controllers\SmsController;
use Carbon\Carbon;
use Melipayamak;
use App\User;
use DB;
use Morilog\Jalali\Jalalian;

class ReserveController extends Controller
{
    /*****************
     * Index Reserve *
     ****************/
    public function IndexReserve()
    {
//        $yourjson = {
//            "Token":"a8d7606bf50b45dab0dd27110c70ce63",
//          "SenderNumber":"50001",
//          "Mobile":"09355000000",
//          "Message" : "test"
//        };


//$ch = curl_init();
//
//curl_setopt($ch, CURLOPT_URL,"https://mysite.ir/api/v1/Send");
//curl_setopt($ch, CURLOPT_POST, 1);
//curl_setopt($ch, CURLOPT_POSTFIELDS,
//    "Token=a8d7606bf50b45dab0dd27110c70ce63&SenderNumber=10003031&Mobile=09396800779&Message=1234");

// In real life you should use something like:
// curl_setopt($ch, CURLOPT_POSTFIELDS,
//          http_build_query(array('postvar1' => 'value1')));

// Receive server response ...
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//
//$server_output = curl_exec($ch);
//
//curl_close ($ch);



        $reserveModel = Reserve::select('group_code')->where('user_id', auth()->user()->id)
//            ->orWhereHas('getHost', function ($Query) {
//            $Query->where('user_id', auth()->user()->id);
//        })
            ->orWhere('host_id',auth()->user()->id)
            ->get()->groupBy('group_code');


        $reserve = array();

        // جدا کردن رزرو های خود کاربر و میهمانان
        foreach ($reserveModel as $key => $value) {

            $res = Reserve::where('group_code', $key)->first();
            if($res->user_id == auth()->user()->id) {
                $type = 'my-reserve';
            } else {
                $type = 'my-guest';
            }
            $reserve[$key] = array('type' => $type, 'group_code' => $res->group_code);
        }
        return view('Reserve::indexReserve', compact('reserve'));
    }

    /*************************
     * Index Reserve My Host *
     ************************/
    public function IndexReserveMyHost()
    {
        $reserveModelCode_1 = Reserve::with('getHost')->whereHas('getHost', function ($Query) {
            $Query->where('user_id', auth()->user()->id);
        })
            ->orderBy('id', 'DESC')
            ->pluck('group_code');
        $array_code = [];
        foreach ($reserveModelCode_1 as $value) {
            $array_code[] = $value;
        }
        $reserveModelCode = array_unique($array_code);
        if (count($reserveModelCode) == 0) {
            $array_reserve = array();
            return view('Reserve::indexReserveMyHost', compact('array_reserve'));
        }
        $hostModel = Host::where('step', 100)->where('user_id', auth()->user()->id)->get();

        if (count($hostModel) > 0) {
            if (count($reserveModelCode) > 0) {
                foreach ($reserveModelCode as $key => $value) {
                    $s = Reserve::where('group_code', $value)->get();
                    $paymentModel = Payment::where('reserve_code', $value)
                        ->where('status', 1)->first();
                    foreach ($s as $index => $item) {
                        $hostModel = Host::where('id', $item->host_id)->first();
                        $array_reserve[$value]['id'] = $item->id;
                        $array_reserve[$value]['host_detail'] = $hostModel;
                        $array_reserve[$value]['reserve_user'] = $item->getUser;
                        $array_reserve[$value]['date_reserve'][] = $item->reserve_date;
                        $array_reserve[$value]['week_id'][] = $item->week_id;
                        $array_reserve[$value]['day_price'][] = $item->day_price;
                        $array_reserve[$value]['special'][] = $item->special;
                        $array_reserve[$value]['special_price'][] = $item->special_price;
                        $array_reserve[$value]['percent'][] = $item->percent;
                        $array_reserve[$value]['final_price'][] = $item->final_price;
                        $array_reserve[$value]['submit_rate'] = $item->submit_rate;
                        $array_reserve[$value]['status'] = $item->status;
                        $array_reserve[$value]['step'] = $item->step;
                        $array_reserve[$value]['level_reserve'] = $item->level_reserve;
                        $array_reserve[$value]['description'] = $item->description;
                        $array_reserve[$value]['payment'] = $paymentModel;
                    }
                }
            } else {
                $array_reserve = array();
            }
        } else {
            $array_reserve = array();
        }

        return view('Reserve::indexReserveMyHost', compact('array_reserve'));
    }

    /********************************************************
     * 'Calculate Reserve' And 'Store Reserve' By Date Ajax /
     *******************************************************/

    public function CalculateReserveHostByDateAjax(Request $request)
    {
        // داده های که ارسال میشود
        // count_guest :1 example
        // from_date :1400/4/26
        // from_to :1400/4/31
        // type : calculate
        // host_id : 5


        // new update ...
        $hostModel = Host::where('id', $request->host_id)->first();
        if ($request->host_id == "" || $request->host_id == null) {
            $Response = ["Success" => "0", "Message" => "اقامتگاه مورد نظر یافت نشد"];
            return response()->json($Response);
        }
        if ($request->from_date == "" || $request->to_date == '') {
            $Response = ["Success" => "0", "Message" => "ابتدا تاریخ رفت و برگشت را مشخص نمایید"];
            return response()->json($Response);
        }
        if ($request->count_guest > ($hostModel->count_guest + $hostModel->standard_guest) || $request->count_guest == 0) {
            $Response = ["Success" => "0", "Message" => "لطفا تعداد نفرات را مشخص کنید"];
            return response()->json($Response);
        }

        $standardGuest = $hostModel->standard_guest; // ظرفیت استاندارد
        $countGuest = $hostModel->count_guest; // ظرفیت مهمانان
        $countRequestGuest = $request->count_guest; // تعداد مهمان درخواست کننده


        $extraPriceForPerson = 0; // Extra person
        $total_sum_guest = 0;
        if($countRequestGuest > $standardGuest) {
            $sum_max = $countGuest+$standardGuest;
            if($countRequestGuest > $sum_max) { // درخواست بیش از حداکثر اقامتگاه
                $Response = ["Success" => "0", "Message" => "درخواست تعداد نفرات مهمان بیش از حداکثر اقامتگاه می باشد."];
                return response()->json($Response);
            } else {
                $total_sum_guest = $countRequestGuest - $standardGuest;
                $extraPriceForPerson = $hostModel->one_person_price * $total_sum_guest; // هزینه کل نفرات اضافی
            }
        }
        // اضافه کردن صفر به تاریخ شروع و پایان

//        $from = jDateTime::ConvertToGeorgian($request->from_date, date('H:i:s'));
//        $bufferFrom = explode(' ', $from);
//        $dateFrom = $bufferFrom[0] . ' 00:00:00';

        $t =$request->from_date;
        $t =explode('/',$t);
        $dateFrom = \Morilog\Jalali\CalendarUtils::toGregorian($t[0],$t[1],$t[2]);
        $dateFrom =$dateFrom[0].'/'.$dateFrom[1].'/'.$dateFrom[2].' '.'00:00:00';






//
//        $to = jDateTime::ConvertToGeorgian($request->to_date, date('H:i:s'));
//        $to = date('Y-m-d H:i:s', strtotime('-1 day', strtotime($to))); // کم کردن یه روز از تاریخ دوم
//        $bufferTo = explode(' ', $to);
//        $dateTo = $bufferTo[0] . ' 00:00:00';

        $t =$request->to_date;
        $t =explode('/',$t);
        $to = \Morilog\Jalali\CalendarUtils::toGregorian($t[0],$t[1],$t[2]-1);
        $dateTo =$to[0].'/'.$to[1].'/'.$to[2].' '.'00:00:00';








//        $dateTo = date('Y-m-d H:i:s', strtotime('-1 day', strtotime($to))); // کم کردن یه روز از تاریخ دوم


        $nowDate = date('Y-m-d 00:00:00');




        if ($dateFrom > $dateTo) { // چک کردن بزرگ نبودن تاریخ شروع از پایان
            $Response = ["Success" => "0", "Message" => array()];
            return response()->json($Response);
        }
        if ($dateFrom < $nowDate) { // چک کردن اینکه تاریخ شروع کوچک تر از الان نباشد
            $Response = ["Success" => "1", "Message" => array()];
            return response()->json($Response);
        }



        $date_from = Carbon::parse($dateFrom);
        $date_to = Carbon::parse($dateTo);


        // محاسبه اختلاف بین دو تاریخ
        $countDayReserve = $date_from->diffInDays($date_to);

        if($countDayReserve < $hostModel->min_reserve_day - 1) {
            $Response = ["Success" => "0", "Message" => "حداقل تعداد روز رزرو برای این اقامتگاه ". $hostModel->min_reserve_day ." روز می باشد."];
            return response()->json($Response);
        }


        $array_day_reserve = array();
        // وارد کردن روزهای انتخاب شده در آرایه
        for ($i = 0; $i <= $countDayReserve; $i++) {
            $array_day_reserve[] = date('Y-m-d 00:00:00', strtotime($date_from . ' + ' . $i . ' days'));
        }

        // چک کردن خالی بودن روزهای رزرو در سیستم
        foreach ($array_day_reserve as $key => $value) {
            $blockedDayModel = BlockedDay::where('host_id', $hostModel->id)
                ->where('date', $value)->first();
            if(!empty($blockedDayModel)) {
                $Response = ["Success" => "0", "Message" => "تاریخ ". Jalalian::forge(date('Y-m-d H:i:s', strtotime('-1 day', strtotime($value))))->format('Y/m/d') ." در تقویم مسدود می باشد، لطفا پس از بررسی مجددا تلاش نمایید."];
                return response()->json($Response);
            }
            $reserveModel = Reserve::where('host_id', $hostModel->id)
                ->where('reserve_date', $value)
                ->whereNotIn('status', array(0, 1, -1, -2))
//                ->whereIn('step', array()) // چک کردن مرحله رزرو
                ->first();
            if(!empty($reserveModel)) {
                $Response = ["Success" => "0", "Message" => "تاریخ ". Jalalian::forge(date('Y-m-d H:i:s', strtotime('+0 day', strtotime($value))))->format('Y/m/d') ." در تقویم رزرو می باشد، لطفا پس از بررسی مجددا تلاش نمایید."];
                return response()->json($Response);
            }
        }


        // چک کردن تخفیف برای چند روز رزرو
        $discountModel = Discount::where('host_id', $hostModel->id)
            ->orderBy('number_days', 'DESC')
            ->where('number_days', '<=', count($array_day_reserve))
            ->first();
        $total_price_reserve = 0; // قیمت کل رزرو
        $array_price_date = array();


        foreach ($array_day_reserve as $key => $value) {
            if (Carbon::parse($value)->format('N') == 6) {
                $id = 1; // shanbe
                $day = 'شنبه';
            } elseif (Carbon::parse($value)->format('N') == 7) {
                $id = 2; // yekshanbe
                $day = 'یک شنبه';
            } elseif (Carbon::parse($value)->format('N') == 1) {
                $id = 3; // doshanbe
                $day = 'دوشنبه';
            } elseif (Carbon::parse($value)->format('N') == 2) {
                $id = 4; // seshanbe
                $day = 'سه شنبه';
            } elseif (Carbon::parse($value)->format('N') == 3) {
                $id = 5; // charshanbe
                $day = 'چهارشنبه';
            } elseif (Carbon::parse($value)->format('N') == 4) {
                $id = 6; // panshanbe
                $day = 'پنجشنبه';
            } elseif (Carbon::parse($value)->format('N') == 5) {
                $id = 7; // jome
                $day = 'جمعه';
            }
            $description = 'یه روز خوب !';
            $priceDayModel = PriceDay::where('host_id', $hostModel->id)
                ->where('week_id', $id)
                ->first();
            $price_day = $priceDayModel->price;
            $final_price = $priceDayModel->price;
//            $specialDayModel = Special::where('host_id', $hostModel->id)
//                ->where('date', $value)
//                ->first();
            $special_price = 0;
            $check_special = 0;
            if(!empty($specialDayModel)) { // چک کردن تاریخ در روزهای ویژه
//                $special_price = $specialDayModel->price;
//                $check_special = 1;
//                $final_price = $specialDayModel->price;
            } else {
                $specialDateModel = SpecialDate::where('date', $value)->first();
                if (!empty($specialDateModel)) {
                    $special_price = $hostModel->special_price;
                    $check_special = 1;
                    $final_price = $hostModel->special_price;
                    $description = $specialDateModel->description;
                }
            }
            /** ****************************************************************************/
            // در صورت داشتن اولویت برای تخفیف ها و روزهای ویژه این قسمت تغییر باید تغییر کند
            /** ****************************************************************************/
            $percent = 0; // درصد تخفیف همین روز
            // اعمال تخفیف در صورت داشتن شرایط
            if (!empty($discountModel)) {
                $percentPrice = ($discountModel->percent / 100) * $final_price;
                $final_price = $final_price - $percentPrice;
                $percent = $discountModel->percent;
            }
            $array_price_date[] = array(
                'date' => $value,
                'host_id' => $hostModel->id,
                'week_id' => $id,
                'day_name' => $day,
                'day_price' => $price_day,
                'special_price' => $special_price,
                'special' => $check_special,
                'description' => $description,
                'percent' => $percent,
                'extra_price_person' => $extraPriceForPerson,
                'final_price' => $final_price,
            );
            $total_price_reserve = $total_price_reserve + $final_price;
        }
        /**  For Next Step We Need : 'type' */

        if($request->type == 'calculate') { // محاسبه و نمایش فاکتور قبل از رزرو

            $factor = view('Reserve::Ajax.AjaxFactorReserve', compact(
                'array_price_date',
                'extraPriceForPerson',
                'hostModel',
                'request',
                'total_price_reserve',
                'total_sum_guest'
            ));

            $Response = ["Success" => "1", "Message" => response()->json(view('Reserve::Ajax.AjaxPreFactor',
                compact('array_price_date',
                    'extraPriceForPerson',
                    'hostModel',
                    'request',
                    'total_price_reserve',
                    'factor'
                ))->render())];

            return $Response;

        } elseif($request->type == 'reserve') { // ثبت درخواست رزرو و ارسال پیامک

            if (!auth()->check()) {
                $Response = ["Success" => "0", "Message" => "برای درخواست رزرو ابتدا وارد سایت شوید"];
                return response()->json($Response);
            }
            // insert to reserve table
            $groupCode = RandomName().'|||'.time();
            foreach ($array_price_date as $key => $value) {
                $data[] = [
                    'user_id' => auth()->user()->id,
                    'host_id' => $hostModel->id,
                    'group_code' => $groupCode,
                    'reserve_date' => $value['date'],
                    'week_id' => $value['week_id'],
                    'day_price' => $value['day_price'],
                    'special' => $value['special'],
                    'special_price' => $value['special_price'],
                    'percent' => $value['percent'],
                    'extra_price_person' => $extraPriceForPerson,
                    'final_price' => $value['final_price'] + $extraPriceForPerson,
                    'description' => $value['description'],
                    'status' => 0,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
            }
            $countDayReserve = $countDayReserve + 1;
            if (DB::table('reserves')->insert($data)) {
                // insert to table message
                $messageModel = new Message();
                $messageModel->sender_id = auth()->user()->id;
                $messageModel->receiver_id = $hostModel->user_id;
                $messageModel->title = 'رزرو اقامتگاه';
                $messageModel->message = 'درخواست رزرو اقامتگاه ' . $hostModel->name . ' از طرف ' . auth()->user()->first_name . ' ' . auth()->user()->last_name . ' به مدت ' . $countDayReserve . ' شب برای شما فرستاده شده است';
                $messageModel->view = 0;
                $messageModel->parent_id = 0;
                $messageModel->save();
                // generate token for confirm reserve
                $Token = (rand(1000, 4999));
                $TokenCancel = rand(5000,9999);
                $checkActivation = ActiveReserve::where('token', $Token)->first();
                $checkCancelActivation = ActiveReserve::where('token_cancel', $TokenCancel)->first();
                if (!empty($checkActivation)) {
                    $Token = (rand(1000, 4999));
                    $checkActivation = ActiveReserve::where('token', $Token)->first();
                    if (!empty($checkActivation)) {
                        $Token = (rand(1000, 4999));
                    }
                }
                if (!empty($checkCancelActivation)) {
                    $TokenCancel = (rand(5000, 9999));
                    $checkCancelActivation = ActiveReserve::where('token_cancel', $TokenCancel)->first();
                    if (!empty($checkCancelActivation)) {
                        $TokenCancel = (rand(5000, 9999));
                    }
                }
                $Activation = new ActiveReserve();
                $Activation->user_id = auth()->user()->id;
                $Activation->user_host_id = $hostModel->user_id;
                $Activation->host_id = $hostModel->id;
                $Activation->group_code = $groupCode;
                $Activation->token = $Token;
                $Activation->token_cancel = $TokenCancel;
                $Activation->save();
                // send sms for users
                SmsController::SendSMSWaitReserveCustomer(auth()->user()->mobile);
                $userModel = User::where('id', $hostModel->user_id)->first();
                $reserveIdModel = Reserve::where('group_code', $groupCode)->first();
                $reserveId = $reserveIdModel->id;
                $total_price_reserve = $total_price_reserve + ($extraPriceForPerson * count($array_price_date));
                SmsController::SendSMSWaitReserveHost($userModel->mobile, $hostModel->id, $hostModel->name, $countDayReserve, $request->from_date, $request->to_date, $total_price_reserve, $Token, $TokenCancel, $request->count_guest,$reserveId);
                return 1;
            }
        }
    }

    /*******************************
     * Cancel Reserve By Host User *
     ******************************/
    public function CancelReserveByHostUser($id)
    {
        $reserveModel = Reserve::where('group_code', $id)->with('getHost')
            ->whereHas('getHost', function ($Query) {
                $Query->where('user_id', auth()->user()->id);
            })
            ->first();

        if (!empty($reserveModel)) {
            return response()->json(view('Reserve::Ajax.AjaxCancelReserve', compact('reserveModel'))->render());
        }
    }

    /*******************************
     * Delete Reserve By Host User *
     ******************************/
    public function DeleteReserveByHostUser(Request $request)
    {
        $reserveCheckModel = Reserve::where('id', $request->reserve_id)->first();
        Reserve::where('group_code', $reserveCheckModel->group_code)->with('getHost')
            ->whereHas('getHost', function ($Query) {
                $Query->where('user_id', auth()->user()->id);
            })->where('status', 0)
            ->update(['status' => -1]);
        $reserveModel_2 = Reserve::where('group_code', $reserveCheckModel->group_code)->with('getHost')->first();

        $userModelGuest = User::where('id', $reserveModel_2->user_id)->first();
        $userModelHost = User::where('id', $reserveModel_2->getHost->getUser->id)->first();

        $city = $reserveModel_2->getHost->getTownship->name;
        $city_id = $reserveModel_2->getHost->getTownship->id;
        $host_name = $reserveModel_2->getHost->name;
        $host_id = $reserveModel_2->getHost->id;

        // sms for guest
        try {
            $sms = melipayamak::sms();
            $to = $userModelGuest->mobile;
            $from = '10007514';
            $text = '' . $userModelGuest->first_name . ' ' . $userModelGuest->last_name . ' عزیز
درخواست رزرو برای اقامتگاه ' . $host_name . ' شهر ' . $city . ' توسط میزبان رد شد
شما میتوانید از طریق لینک زیر خانه دیگری در شهر ' . $city . ' را انتخاب کنید
http://www.rentt.ir/city/' . $city_id . '
پشتیبانی :';
            $sms->send($to, $from, $text);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        //sms for host
        try {
            $sms = melipayamak::sms();
            $to = $userModelHost->mobile;
            $from = '10007514';
            $text = '' . $userModelHost->first_name . ' ' . $userModelHost->last_name . ' عزیز
با موفقیت درخواست رزرو رد شد، لطفا تقویم خود را به روز رسانی کنید
لینک تقویم : http://www.rentt.ir/host/personalize/'.$host_id.'
پشتیبانی :';
            $sms->send($to, $from, $text);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        if (!empty($reserveModel_2)) {
            if ($request->message != "") {
                $messageModel = new Message();
                $messageModel->sender_id = auth()->user()->id;
                $messageModel->receiver_id = $reserveModel_2->user_id;
                $messageModel->title = 'انصراف از رزرو اقامتگاه';
                $messageModel->message = $request->message;
                $messageModel->view = 0;
                $messageModel->parent_id = 0;
                $messageModel->save();
            }
            PrintMessage('انصراف رزرو با موفقیت انجام شد', 'info');
            return redirect(route('IndexReserveMyHost'));
        }
    }

    /*******************************
     * Cancel Reserve By Client *
     ******************************/
    public function CancelReserveByClient($code)
    {
        $totalPrice = 0;
        $penaltyPrice = 0;
        $priceReserveHour = 0; // price reserve for 1 hour
        $sitePercent = config('setting.SitePercent') + config('setting.InvitePercent'); // site percent with invite percent

        $reserveModel = Reserve::where('group_code', $code)->where('user_id', auth()->user()->id)->get();
//        return count($reserveModel);
        if (empty($reserveModel)) {
            return 'خطا در انصراف اقامتگاه';
        }
        $hostModel = Host::find($reserveModel[0]->host_id);
        $hostUser = User::where('id', $hostModel->user_id)->first();
        $guestUser = User::where('id', $reserveModel[0]->user_id)->first();
        $cancelReserveRule = config('setting.CancelReserveRule');
        if ($reserveModel[0]->status == 2) { // paid money
            $paymentModel = Payment::where('reserve_code', $code)->where('status', 1)->first();
            $paidMoney = $paymentModel->price;
            if (!empty($hostModel)) {
                $buffer_date_reserve = explode(' ', $reserveModel[0]->reserve_date);
                $dateStartReserve = $buffer_date_reserve[0] . ' ' . $hostModel->time_enter . ':00:00'; // change to format time
                $hourToReserve = round((strtotime($dateStartReserve) - strtotime(date('Y-m-d H:i:s'))) / 60 / 60);
//                return $cancelReserveRule[$hostModel->cancel_rule_id]['time'];
                if ($hourToReserve > $cancelReserveRule[$hostModel->cancel_rule_id]['time'][1]['time']) { // // mode 1

                    /**************** ************************** ***************/
                    /**************** calculate penalty for user ***************/
                    /**************** ************************** ***************/

                    foreach ($reserveModel as $key => $value) {
                        /** all price */
                        $totalPrice = $totalPrice + $value->final_price;
                    }
                    $priceReserveHour = ($totalPrice / count($reserveModel)) / 24; // get price for 1 hour
                    if ($cancelReserveRule[$hostModel->cancel_rule_id]['time'][1]['percent'] == true) { // calculate penalty by percent
                        $penaltyPrice = $totalPrice * $cancelReserveRule[$hostModel->cancel_rule_id]['time'][1]['penalty'] / 100;
                        $remainingPriceFinal = $paidMoney - $penaltyPrice; // before calculate site percent
                        $sitePercent = $totalPrice * $sitePercent / 100;
                        $remainingPriceFinal = $remainingPriceFinal - $sitePercent; // after calculate site percent
                        if ($remainingPriceFinal < 0) {
                            $remainingPriceFinal = 0;
                        }
                        $result = array(
                            'total' => $totalPrice,
                            'penalty' => $penaltyPrice,
                            'site_percent' => $sitePercent,
                            'final' => $remainingPriceFinal,
                            'paid' => $paidMoney,
                            'status' => $reserveModel[0]->status,
                            'cancel_rule' => $cancelReserveRule[$hostModel->cancel_rule_id],
                        );
                    } else { // calculate penalty by hour

                        $sitePercent = $totalPrice * $sitePercent / 100;
                        $totalPrice_ = $totalPrice - $sitePercent;
                        $priceForOneDayReserve = $totalPrice_ / count($reserveModel); // price for one day reserve
                        $day = $cancelReserveRule[$hostModel->cancel_rule_id]['time'][2]['penalty'] / 24;
                        $penaltyPrice = $priceForOneDayReserve * $day;

                        $remainingPriceFinal = $paidMoney - $penaltyPrice; // before calculate site percent

                        $remainingPriceFinal = $remainingPriceFinal - $sitePercent; // after calculate site percent
                        if ($remainingPriceFinal < 0) {
                            $remainingPriceFinal = 0;
                        }
//                        $penaltyPrice = $priceReserveHour * $cancelReserveRule[$hostModel->cancel_rule_id]['time'][1]['penalty'];
//                        $remainingPriceFinal = $paidMoney - $penaltyPrice; // before calculate site percent
//                        $sitePercent = $totalPrice * $sitePercent / 100;
//                        $remainingPriceFinal = $remainingPriceFinal - $sitePercent; // after calculate site percent
//                        if($remainingPriceFinal < 0) {
//                            $remainingPriceFinal = 0;
//                        }
                        $result = array(
                            'total' => $totalPrice,
                            'penalty' => $penaltyPrice,
                            'site_percent' => $sitePercent,
                            'final' => $remainingPriceFinal,
                            'paid' => $paidMoney,
                            'status' => $reserveModel[0]->status,
                            'cancel_rule' => $cancelReserveRule[$hostModel->cancel_rule_id],
                        );
                    }
                } elseif ($hourToReserve > 0 && $hourToReserve < $cancelReserveRule[$hostModel->cancel_rule_id]['time'][2]['time']) { // mode 2

                    /**************** ************************** ***************/
                    /**************** calculate penalty for user ***************/
                    /**************** ************************** ***************/
                    foreach ($reserveModel as $key => $value) {
                        /** all price */
                        $totalPrice = $totalPrice + $value->final_price;
                    }
                    if (count($reserveModel) < 3 && count($reserveModel) > 0) {

                        $sitePercent = $totalPrice * $sitePercent / 100;
                        $penaltyPrice = $totalPrice - $sitePercent;
                        $remainingPriceFinal = $totalPrice - $sitePercent - $penaltyPrice; // after calculate site percent
                        if ($remainingPriceFinal < 0) {
                            $remainingPriceFinal = 0;
                        }
                        $result = array(
                            'total' => $totalPrice,
                            'penalty' => $penaltyPrice,
                            'site_percent' => $sitePercent,
                            'final' => $remainingPriceFinal,
                            'paid' => $paidMoney,
                            'status' => $reserveModel[0]->status,
                            'cancel_rule' => $cancelReserveRule[$hostModel->cancel_rule_id],
                        );
                    } else {

                        $priceReserveHour = ($totalPrice / count($reserveModel)) / 24; // get price for 1 hour
                        if ($cancelReserveRule[$hostModel->cancel_rule_id]['time'][2]['percent'] == true) { // calculate penalty by percent

                            //site_percent درصد سایت
                            //penalty جریمه
                            //site_percent + penalty کل جریمه
                            //final بازگشتی
                            $sitePercent = $totalPrice * $sitePercent / 100;
                            $totalPrice_ = $totalPrice - $sitePercent;
                            $penaltyPrice = $totalPrice_ * $cancelReserveRule[$hostModel->cancel_rule_id]['time'][2]['penalty'] / 100;
                            $remainingPriceFinal = $paidMoney - $penaltyPrice; // before calculate site percent

                            $remainingPriceFinal = $remainingPriceFinal - $sitePercent; // after calculate site percent
                            if ($remainingPriceFinal < 0) {
                                $remainingPriceFinal = 0;
                            }


                            $result = array(
                                'total' => $totalPrice,
                                'penalty' => $penaltyPrice,
                                'site_percent' => $sitePercent,
                                'final' => $remainingPriceFinal,
                                'paid' => $paidMoney,
                                'status' => $reserveModel[0]->status,
                                'cancel_rule' => $cancelReserveRule[$hostModel->cancel_rule_id],
                            );
                        } else { // calculate penalty by hour


                            $sitePercent = $totalPrice * $sitePercent / 100;
                            $totalPrice_ = $totalPrice - $sitePercent;
                            $priceForOneDayReserve = $totalPrice_ / count($reserveModel); // price for one day reserve
                            $day = $cancelReserveRule[$hostModel->cancel_rule_id]['time'][2]['penalty'] / 24;
                            $penaltyPrice = $priceForOneDayReserve * $day;

                            $remainingPriceFinal = $paidMoney - $penaltyPrice; // before calculate site percent

                            $remainingPriceFinal = $remainingPriceFinal - $sitePercent; // after calculate site percent
                            if ($remainingPriceFinal < 0) {
                                $remainingPriceFinal = 0;
                            }
                            $result = array(
                                'total' => $totalPrice,
                                'penalty' => $penaltyPrice,
                                'site_percent' => $sitePercent,
                                'final' => $remainingPriceFinal,
                                'paid' => $paidMoney,
                                'status' => $reserveModel[0]->status,
                                'cancel_rule' => $cancelReserveRule[$hostModel->cancel_rule_id],
                            );
                        }
                    }
                } elseif ($hourToReserve < 0) {
                    $hourToReserve = -1 * $hourToReserve;
                    if ($hourToReserve < $cancelReserveRule[$hostModel->cancel_rule_id]['time'][3]['time']) { // mode 3

                        /**************** ************************** ***************/
                        /**************** calculate penalty for user ***************/
                        /**************** ************************** ***************/
                        foreach ($reserveModel as $key => $value) {
                            /** all price */
                            $totalPrice = $totalPrice + $value->final_price;
                        }
                        if (count($reserveModel) < 3 && count($reserveModel) > 0) {
                            $sitePercent = $totalPrice * $sitePercent / 100;
                            $penaltyPrice = $totalPrice - $sitePercent;
                            $remainingPriceFinal = $totalPrice - $sitePercent - $penaltyPrice; // after calculate site percent
                            if ($remainingPriceFinal < 0) {
                                $remainingPriceFinal = 0;
                            }
                            $result = array(
                                'total' => $totalPrice,
                                'penalty' => $penaltyPrice,
                                'site_percent' => $sitePercent,
                                'final' => $remainingPriceFinal,
                                'paid' => $paidMoney,
                                'status' => $reserveModel[0]->status,
                                'cancel_rule' => $cancelReserveRule[$hostModel->cancel_rule_id],
                            );
                        } else {
                            $priceReserveHour = ($totalPrice / count($reserveModel)) / 24; // get price for 1 hour
                            if ($cancelReserveRule[$hostModel->cancel_rule_id]['time'][3]['percent'] == true) { // calculate penalty by percent
//                                $penaltyPrice = $totalPrice * $cancelReserveRule[$hostModel->cancel_rule_id]['time'][3]['penalty'] / 100;
//                                $remainingPriceFinal = $paidMoney - $penaltyPrice; // before calculate site percent
//                                $sitePercent = $totalPrice * $sitePercent / 100;
//                                $remainingPriceFinal = $remainingPriceFinal - $sitePercent; // after calculate site percent
//                                if($remainingPriceFinal < 0) {
//                                    $remainingPriceFinal = 0;
//                                }

                                //site_percent درصد سایت
                                //penalty جریمه
                                //site_percent + penalty کل جریمه
                                //final بازگشتی
                                $sitePercent = $totalPrice * $sitePercent / 100;
                                $totalPrice_ = $totalPrice - $sitePercent;
                                $penaltyPrice = $totalPrice_ * $cancelReserveRule[$hostModel->cancel_rule_id]['time'][3]['penalty'] / 100;
                                $remainingPriceFinal = $paidMoney - $penaltyPrice; // before calculate site percent

                                $remainingPriceFinal = $remainingPriceFinal - $sitePercent; // after calculate site percent
                                if ($remainingPriceFinal < 0) {
                                    $remainingPriceFinal = 0;
                                }

                                $result = array(
                                    'total' => $totalPrice,
                                    'penalty' => $penaltyPrice,
                                    'site_percent' => $sitePercent,
                                    'final' => $remainingPriceFinal,
                                    'paid' => $paidMoney,
                                    'status' => $reserveModel[0]->status,
                                    'cancel_rule' => $cancelReserveRule[$hostModel->cancel_rule_id],
                                );
                            } else { // calculate penalty by hour
//


                                $sitePercent = $totalPrice * $sitePercent / 100;
                                $totalPrice_ = $totalPrice - $sitePercent;
                                $priceForOneDayReserve = $totalPrice_ / count($reserveModel); // price for one day reserve
                                $day = $cancelReserveRule[$hostModel->cancel_rule_id]['time'][2]['penalty'] / 24;
                                $penaltyPrice = $priceForOneDayReserve * $day;

                                $remainingPriceFinal = $paidMoney - $penaltyPrice; // before calculate site percent

                                $remainingPriceFinal = $remainingPriceFinal - $sitePercent; // after calculate site percent
                                if ($remainingPriceFinal < 0) {
                                    $remainingPriceFinal = 0;
                                }


                                //site_percent درصد سایت
                                //penalty جریمه
                                //site_percent + penalty کل جریمه
                                //final بازگشتی
//                                $sitePercent = $totalPrice * $sitePercent / 100;
//                                $totalPrice_ = $totalPrice - $sitePercent;
//                                $penaltyPrice = $totalPrice_ * $cancelReserveRule[$hostModel->cancel_rule_id]['time'][3]['penalty'] / 100;
//                                $remainingPriceFinal = $paidMoney - $penaltyPrice; // before calculate site percent
//
//                                $remainingPriceFinal = $remainingPriceFinal - $sitePercent; // after calculate site percent
//                                if($remainingPriceFinal < 0) {
//                                    $remainingPriceFinal = 0;
//                                }


                                $result = array(
                                    'total' => $totalPrice,
                                    'penalty' => $penaltyPrice,
                                    'site_percent' => $sitePercent,
                                    'final' => $remainingPriceFinal,
                                    'paid' => $paidMoney,
                                    'status' => $reserveModel[0]->status,
                                    'cancel_rule' => $cancelReserveRule[$hostModel->cancel_rule_id],
                                );
                            }
                        }
                    } else { // sakhtgirane && saat reserve bish az saat taiin shode baraye cancel ast
                        $result = array(
                            'total' => -1,
                            'penalty' => -1,
                            'site_percent' => -1,
                            'final' => -1,
                            'paid' => -1,
                            'status' => 400,
                            'cancel_rule' => $cancelReserveRule[$hostModel->cancel_rule_id],
                        );
                    }
                } else {
//                    return $hourToReserve;
                    return 'انصراف در ساعت ورود امکان پذیر نمیباشد ،لطفاً ۳۰ دقیقه بعد از تاریخ ورود لغو را بزنید';
                }
            } else {
                return 'Host Not Found';
            }
        } else {
            $result = array(
                'total' => 0,
                'penalty' => 0,
                'site_percent' => 0,
                'final' => 0,
                'paid' => 0,
                'status' => $reserveModel[0]->status,
                'cancel_rule' => $cancelReserveRule[$hostModel->cancel_rule_id],
            );
        }
        return response()->json(view('Reserve::Ajax.AjaxCancelReserveByClient', compact('result', 'code'))->render());
    }

    /*******************************
     * *** Detail Price Reserve ****
     ******************************/
    public function DetailPriceReserve($code)
    {
        $reserveModel = Reserve::where('group_code', $code)->get();
        if (!empty($reserveModel)) {
            return response()->json(view('Reserve::Ajax.AjaxDetailPrice', compact('reserveModel'))->render());
        }
    }

    /*******************************
     * Delete Reserve By Client *
     ******************************/
    public function DeleteReserveByClient(Request $request)
    {
        $code = $request->group_code;
        $totalPrice = 0;
        $penaltyPrice = 0;
        $priceReserveHour = 0; // price reserve for 1 hour
        $sitePercent = config('setting.SitePercent') + config('setting.InvitePercent'); // site percent with invite percent

        $reserveModel = Reserve::where('group_code', $code)->where('user_id', auth()->user()->id)->get();
        if (empty($reserveModel)) {
            return 'خطا در انصراف اقامتگاه';
        }
        $hostModel = Host::with('getUser')->where('id', $reserveModel[0]->host_id)->first();
        $hostUser = User::where('id', $hostModel->user_id)->first();
        $guestUser = User::where('id', $reserveModel[0]->user_id)->first();
        $cancelReserveRule = config('setting.CancelReserveRule');

        // sms for guest
        try {
            $sms = melipayamak::sms();
            $to = auth()->user()->mobile;
            $from = '10007514';
            $text = '' . auth()->user()->first_name . ' ' . auth()->user()->last_name . ' عزیز
درخواست رزرو برای اقامتگاه' . $hostModel->name . ' توسط شما رد شد
شما میتوانید از طریق لینک زیر خانه دیگری در شهر' . $hostModel->getTownship->name . ' را انتخاب کنید
لینک :
پشتیبانی :';
            $sms->send($to, $from, $text);
        } catch (Exception $e) {
            echo $e->getMessage();
        }



        if ($reserveModel[0]->status == 2) { // paid money
            //sms for host
            try {
                $sms = melipayamak::sms();
                $to = $hostModel->getUser->mobile;
                $from = '10007514';
                $text = '' . $hostModel->getUser->first_name . ' ' . $hostModel->getUser->last_name . ' عزیز
مهمان از درخواست رزرو خود منصرف شد، منتظر درخواست های بعدی باشید
مبلغ جریمه به حساب کاربری شما واریز شد، برای برداشت از حساب کاربری خود به قسمت امور مالی مراجعه کنید
لینک :
پشتیبانی :';
                $sms->send($to, $from, $text);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
            $paymentModel = Payment::where('reserve_code', $code)->where('status', 1)->first();
            $paidMoney = $paymentModel->price;

            if (!empty($hostModel)) {
                $buffer_date_reserve = explode(' ', $reserveModel[0]->reserve_date);
                $dateStartReserve = $buffer_date_reserve[0] . ' ' . $hostModel->time_enter . ':00:00'; // change to format time
                $hourToReserve = round((strtotime($dateStartReserve) - strtotime(date('Y-m-d H:i:s'))) / 60 / 60);

//                return $cancelReserveRule[$hostModel->cancel_rule_id]['time'];
                if ($hourToReserve > $cancelReserveRule[$hostModel->cancel_rule_id]['time'][1]['time']) { // // mode 1

                    /**************** ************************** ***************/
                    /**************** calculate penalty for user ***************/
                    /**************** ************************** ***************/
                    foreach ($reserveModel as $key => $value) {
                        /** all price */
                        $totalPrice = $totalPrice + $value->final_price;
                    }
                    $priceReserveHour = ($totalPrice / count($reserveModel)) / 24; // get price for 1 hour
                    if ($cancelReserveRule[$hostModel->cancel_rule_id]['time'][1]['percent'] == true) { // calculate penalty by percent
                        $penaltyPrice = $totalPrice * $cancelReserveRule[$hostModel->cancel_rule_id]['time'][1]['penalty'] / 100;
                        $remainingPriceFinal = $paidMoney - $penaltyPrice; // before calculate site percent
                        $sitePercent = $totalPrice * $sitePercent / 100;
                        $remainingPriceFinal = $remainingPriceFinal - $sitePercent; // after calculate site percent
                        if ($remainingPriceFinal < 0) {
                            $remainingPriceFinal = 0;
                        }
                        /** calculate price for users (penalty , ...) */
                        /** Deposit into host_user's wallet */

                        $walletModel = new Wallet();
                        $walletModel->user_id = $hostUser->id;
                        $walletModel->reserve_code = $reserveModel[0]->group_code;
                        $walletModel->payment_id = $paymentModel->id;
                        $walletModel->price = $penaltyPrice;
                        $walletModel->type = 1;
                        $walletModel->award = 0;
                        $walletModel->description = 'واریز به کیف پول میزبان بابت انصراف از رزرو توسط میهمان';
                        if ($walletModel->save()) {
                            $userHostModel = User::where('id', $hostUser->id)->first();
                            $userHostModel->credit = $userHostModel->credit + $penaltyPrice;
                            if ($userHostModel->save()) {
                                // save calculate
                            } else {
                                return '00000000000000000000ERR-Wal37621';
                            }
                        } else {
                            return '00000000000000000000ERR-Cre33925';
                        }

                        /** Deposit into guest_user's wallet */
                        $walletModel = new Wallet();
                        $walletModel->user_id = $guestUser->id;
                        $walletModel->reserve_code = $reserveModel[0]->group_code;
                        $walletModel->payment_id = $paymentModel->id;
                        $walletModel->price = $remainingPriceFinal;
                        $walletModel->type = 1;
                        $walletModel->award = 0;
                        $walletModel->description = 'واریز به کیف پول میهمان بابت انصراف از رزرو با احتساب جریمه';
                        if ($walletModel->save()) {
                            $userGuestModel = User::where('id', $guestUser->id)->first();
                            $userGuestModel->credit = $userGuestModel->credit + $remainingPriceFinal;
                            if ($userGuestModel->save()) {
                                // save calculate
                            } else {
                                return '00000000000000000000ERR-Wal87621';
                            }
                        } else {
                            return '00000000000000000000ERR-Cre83925';
                        }

                    } else { // calculate penalty by hour

                        $sitePercent = $totalPrice * $sitePercent / 100;
                        $totalPrice_ = $totalPrice - $sitePercent;
                        $priceForOneDayReserve = $totalPrice_ / count($reserveModel); // price for one day reserve

                        $day = $cancelReserveRule[$hostModel->cancel_rule_id]['time'][2]['penalty'] / 24;

                        $penaltyPrice = $priceForOneDayReserve * $day;

                        $remainingPriceFinal = $paidMoney - $penaltyPrice; // before calculate site percent

                        $remainingPriceFinal = $remainingPriceFinal - $sitePercent; // after calculate site percent


                        if ($remainingPriceFinal < 0) {
                            $remainingPriceFinal = 0;
                        }


//                        $penaltyPrice = $priceReserveHour * $cancelReserveRule[$hostModel->cancel_rule_id]['time'][1]['penalty'];
//                        $remainingPriceFinal = $paidMoney - $penaltyPrice; // before calculate site percent
//                        $sitePercent = $totalPrice * $sitePercent / 100;
//                        $remainingPriceFinal = $remainingPriceFinal - $sitePercent; // after calculate site percent
//                        if($remainingPriceFinal < 0) {
//                            $remainingPriceFinal = 0;
//                        }
                        /** calculate price for users (penalty , ...) */
                        /** Deposit into host_user's wallet */

                        $walletModel = new Wallet();
                        $walletModel->user_id = $hostUser->id;
                        $walletModel->reserve_code = $reserveModel[0]->group_code;
                        $walletModel->payment_id = $paymentModel->id;
                        $walletModel->price = $penaltyPrice;
                        $walletModel->type = 1;
                        $walletModel->award = 0;
                        $walletModel->description = 'واریز به کیف پول میزبان بابت انصراف از رزرو توسط میهمان';
                        if ($walletModel->save()) {
                            $userHostModel = User::where('id', $hostUser->id)->first();
                            $userHostModel->credit = $userHostModel->credit + $penaltyPrice;
                            if ($userHostModel->save()) {
                                // save calculate
                            } else {
                                return '00000000000000000000ERR-Wal37621';
                            }
                        } else {
                            return '00000000000000000000ERR-Cre33925';
                        }

                        /** Deposit into guest_user's wallet */
                        $walletModel = new Wallet();
                        $walletModel->user_id = $guestUser->id;
                        $walletModel->reserve_code = $reserveModel[0]->group_code;
                        $walletModel->payment_id = $paymentModel->id;
                        $walletModel->price = $remainingPriceFinal;
                        $walletModel->type = 1;
                        $walletModel->award = 0;
                        $walletModel->description = 'واریز به کیف پول میهمان بابت انصراف از رزرو با احتساب جریمه';
                        if ($walletModel->save()) {
                            $userGuestModel = User::where('id', $guestUser->id)->first();
                            $userGuestModel->credit = $userGuestModel->credit + $remainingPriceFinal;
                            if ($userGuestModel->save()) {
                                // save calculate
                            } else {
                                return '00000000000000000000ERR-Wal87621';
                            }
                        } else {
                            return '00000000000000000000ERR-Cre83925';
                        }

                    }
                } elseif ($hourToReserve > 0 && $hourToReserve < $cancelReserveRule[$hostModel->cancel_rule_id]['time'][2]['time']) { // mode 2

                    /**************** ************************** ***************/
                    /**************** calculate penalty for user ***************/
                    /**************** ************************** ***************/
                    foreach ($reserveModel as $key => $value) {
                        /** all price */
                        $totalPrice = $totalPrice + $value->final_price;
                    }
                    if (count($reserveModel) < 3 && count($reserveModel) > 0) { // check reserve between 1 and 2 days
                        $sitePercent = $totalPrice * $sitePercent / 100;
                        $penaltyPrice = $totalPrice - $sitePercent;
                        $remainingPriceFinal = $totalPrice - $sitePercent - $penaltyPrice; // after calculate site percent
                        if ($remainingPriceFinal < 0) {
                            $remainingPriceFinal = 0;
                        }
                        /** calculate price for users (penalty , ...) */
                        /** Deposit into host_user's wallet */

                        $walletModel = new Wallet();
                        $walletModel->user_id = $hostUser->id;
                        $walletModel->reserve_code = $reserveModel[0]->group_code;
                        $walletModel->payment_id = $paymentModel->id;
                        $walletModel->price = $penaltyPrice;
                        $walletModel->type = 1;
                        $walletModel->award = 0;
                        $walletModel->description = 'واریز به کیف پول میزبان بابت انصراف از رزرو توسط میهمان';
                        if ($walletModel->save()) {
                            $userHostModel = User::where('id', $hostUser->id)->first();
                            $userHostModel->credit = $userHostModel->credit + $penaltyPrice;
                            if ($userHostModel->save()) {
                                // save calculate
                            } else {
                                return '00000000000000000000ERR-Wal37621';
                            }
                        } else {
                            return '00000000000000000000ERR-Cre33925';
                        }

                        /** Deposit into guest_user's wallet */
                        $walletModel = new Wallet();
                        $walletModel->user_id = $guestUser->id;
                        $walletModel->reserve_code = $reserveModel[0]->group_code;
                        $walletModel->payment_id = $paymentModel->id;
                        $walletModel->price = $remainingPriceFinal;
                        $walletModel->type = 1;
                        $walletModel->award = 0;
                        $walletModel->description = 'واریز به کیف پول میهمان بابت انصراف از رزرو با احتساب جریمه';
                        if ($walletModel->save()) {
                            $userGuestModel = User::where('id', $guestUser->id)->first();
                            $userGuestModel->credit = $userGuestModel->credit + $remainingPriceFinal;
                            if ($userGuestModel->save()) {
                                // save calculate
                            } else {
                                return '00000000000000000000ERR-Wal87621';
                            }
                        } else {
                            return '00000000000000000000ERR-Cre83925';
                        }
                    } else {
                        $priceReserveHour = ($totalPrice / count($reserveModel)) / 24; // get price for 1 hour
                        if ($cancelReserveRule[$hostModel->cancel_rule_id]['time'][2]['percent'] == true) { // calculate penalty by percent


                            //site_percent درصد سایت
                            //penalty جریمه
                            //site_percent + penalty کل جریمه
                            //final بازگشتی

                            $sitePercent = $totalPrice * $sitePercent / 100;
                            $totalPrice_ = $totalPrice - $sitePercent;
                            $penaltyPrice = $totalPrice_ * $cancelReserveRule[$hostModel->cancel_rule_id]['time'][2]['penalty'] / 100;
                            $remainingPriceFinal = $paidMoney - $penaltyPrice; // before calculate site percent
                            $remainingPriceFinal = $remainingPriceFinal - $sitePercent; // after calculate site percent
                            if ($remainingPriceFinal < 0) {
                                $remainingPriceFinal = 0;
                            }


                            /** calculate price for users (penalty , ...) */
                            /** Deposit into host_user's wallet */

                            $walletModel = new Wallet();
                            $walletModel->user_id = $hostUser->id;
                            $walletModel->reserve_code = $reserveModel[0]->group_code;
                            $walletModel->payment_id = $paymentModel->id;
                            $walletModel->price = $penaltyPrice;
                            $walletModel->type = 1;
                            $walletModel->award = 0;
                            $walletModel->description = 'واریز به کیف پول میزبان بابت انصراف از رزرو توسط میهمان';
                            if ($walletModel->save()) {
                                $userHostModel = User::where('id', $hostUser->id)->first();
                                $userHostModel->credit = $userHostModel->credit + $penaltyPrice;
                                if ($userHostModel->save()) {
                                    // save calculate
                                } else {
                                    return '00000000000000000000ERR-Wal37621';
                                }
                            } else {
                                return '00000000000000000000ERR-Cre33925';
                            }

                            /** Deposit into guest_user's wallet */
                            $walletModel = new Wallet();
                            $walletModel->user_id = $guestUser->id;
                            $walletModel->reserve_code = $reserveModel[0]->group_code;
                            $walletModel->payment_id = $paymentModel->id;
                            $walletModel->price = $remainingPriceFinal;
                            $walletModel->type = 1;
                            $walletModel->award = 0;
                            $walletModel->description = 'واریز به کیف پول میهمان بابت انصراف از رزرو با احتساب جریمه';
                            if ($walletModel->save()) {
                                $userGuestModel = User::where('id', $guestUser->id)->first();
                                $userGuestModel->credit = $userGuestModel->credit + $remainingPriceFinal;
                                if ($userGuestModel->save()) {
                                    // save calculate
                                } else {
                                    return '00000000000000000000ERR-Wal87621';
                                }
                            } else {
                                return '00000000000000000000ERR-Cre83925';
                            }
                        } else { // calculate penalty by hour


                            $sitePercent = $totalPrice * $sitePercent / 100;
                            $totalPrice_ = $totalPrice - $sitePercent;
                            $priceForOneDayReserve = $totalPrice_ / count($reserveModel); // price for one day reserve

                            $day = $cancelReserveRule[$hostModel->cancel_rule_id]['time'][2]['penalty'] / 24;

                            $penaltyPrice = $priceForOneDayReserve * $day;

                            $remainingPriceFinal = $paidMoney - $penaltyPrice; // before calculate site percent

                            $remainingPriceFinal = $remainingPriceFinal - $sitePercent; // after calculate site percent


                            if ($remainingPriceFinal < 0) {
                                $remainingPriceFinal = 0;
                            }

                            /** calculate price for users (penalty , ...) */
                            /** Deposit into host_user's wallet */

                            $walletModel = new Wallet();
                            $walletModel->user_id = $hostUser->id;
                            $walletModel->reserve_code = $reserveModel[0]->group_code;
                            $walletModel->payment_id = $paymentModel->id;
                            $walletModel->price = $penaltyPrice;
                            $walletModel->type = 1;
                            $walletModel->award = 0;
                            $walletModel->description = 'واریز به کیف پول میزبان بابت انصراف از رزرو توسط میهمان';
                            if ($walletModel->save()) {
                                $userHostModel = User::where('id', $hostUser->id)->first();
                                $userHostModel->credit = $userHostModel->credit + $penaltyPrice;
                                if ($userHostModel->save()) {
                                    // save calculate
                                } else {
                                    return '00000000000000000000ERR-Wal37621';
                                }
                            } else {
                                return '00000000000000000000ERR-Cre33925';
                            }

                            /** Deposit into guest_user's wallet */
                            $walletModel = new Wallet();
                            $walletModel->user_id = $guestUser->id;
                            $walletModel->reserve_code = $reserveModel[0]->group_code;
                            $walletModel->payment_id = $paymentModel->id;
                            $walletModel->price = $remainingPriceFinal;
                            $walletModel->type = 1;
                            $walletModel->award = 0;
                            $walletModel->description = 'واریز به کیف پول میهمان بابت انصراف از رزرو با احتساب جریمه';
                            if ($walletModel->save()) {
                                $userGuestModel = User::where('id', $guestUser->id)->first();
                                $userGuestModel->credit = $userGuestModel->credit + $remainingPriceFinal;
                                if ($userGuestModel->save()) {
                                    // save calculate
                                } else {
                                    return '00000000000000000000ERR-Wal87621';
                                }
                            } else {
                                return '00000000000000000000ERR-Cre83925';
                            }

                        }
                    }
                } elseif ($hourToReserve < 0) {
                    $hourToReserve = -1 * $hourToReserve;
                    if ($hourToReserve < $cancelReserveRule[$hostModel->cancel_rule_id]['time'][3]['time']) { // mode 3

                        /**************** ************************** ***************/
                        /**************** calculate penalty for user ***************/
                        /**************** ************************** ***************/
                        foreach ($reserveModel as $key => $value) {
                            /** all price */
                            $totalPrice = $totalPrice + $value->final_price;
                        }
                        if (count($reserveModel) < 3 && count($reserveModel) > 0) { // check reserve between 1 and 2 days
                            $sitePercent = $totalPrice * $sitePercent / 100;
                            $penaltyPrice = $totalPrice - $sitePercent;
                            $remainingPriceFinal = $totalPrice - $sitePercent - $penaltyPrice; // after calculate site percent
                            if ($remainingPriceFinal < 0) {
                                $remainingPriceFinal = 0;
                            }
                            /** calculate price for users (penalty , ...) */
                            /** Deposit into host_user's wallet */

                            $walletModel = new Wallet();
                            $walletModel->user_id = $hostUser->id;
                            $walletModel->reserve_code = $reserveModel[0]->group_code;
                            $walletModel->payment_id = $paymentModel->id;
                            $walletModel->price = $penaltyPrice;
                            $walletModel->type = 1;
                            $walletModel->award = 0;
                            $walletModel->description = 'واریز به کیف پول میزبان بابت انصراف از رزرو توسط میهمان';
                            if ($walletModel->save()) {
                                $userHostModel = User::where('id', $hostUser->id)->first();
                                $userHostModel->credit = $userHostModel->credit + $penaltyPrice;
                                if ($userHostModel->save()) {
                                    // save calculate
                                } else {
                                    return '00000000000000000000ERR-Wal37621';
                                }
                            } else {
                                return '00000000000000000000ERR-Cre33925';
                            }

                            /** Deposit into guest_user's wallet */
                            $walletModel = new Wallet();
                            $walletModel->user_id = $guestUser->id;
                            $walletModel->reserve_code = $reserveModel[0]->group_code;
                            $walletModel->payment_id = $paymentModel->id;
                            $walletModel->price = $remainingPriceFinal;
                            $walletModel->type = 1;
                            $walletModel->award = 0;
                            $walletModel->description = 'واریز به کیف پول میهمان بابت انصراف از رزرو با احتساب جریمه';
                            if ($walletModel->save()) {
                                $userGuestModel = User::where('id', $guestUser->id)->first();
                                $userGuestModel->credit = $userGuestModel->credit + $remainingPriceFinal;
                                if ($userGuestModel->save()) {
                                    // save calculate
                                } else {
                                    return '00000000000000000000ERR-Wal87621';
                                }
                            } else {
                                return '00000000000000000000ERR-Cre83925';
                            }
                        } else {
                            $priceReserveHour = ($totalPrice / count($reserveModel)) / 24; // get price for 1 hour
                            if ($cancelReserveRule[$hostModel->cancel_rule_id]['time'][3]['percent'] == true) { // calculate penalty by percent
                                $penaltyPrice = $totalPrice * $cancelReserveRule[$hostModel->cancel_rule_id]['time'][3]['penalty'] / 100;
                                $remainingPriceFinal = $paidMoney - $penaltyPrice; // before calculate site percent
                                $sitePercent = $totalPrice * $sitePercent / 100;
                                $remainingPriceFinal = $remainingPriceFinal - $sitePercent; // after calculate site percent
                                if ($remainingPriceFinal < 0) {
                                    $remainingPriceFinal = 0;
                                }
                                /** calculate price for users (penalty , ...) */
                                /** Deposit into host_user's wallet */

                                $walletModel = new Wallet();
                                $walletModel->user_id = $hostUser->id;
                                $walletModel->reserve_code = $reserveModel[0]->group_code;
                                $walletModel->payment_id = $paymentModel->id;
                                $walletModel->price = $penaltyPrice;
                                $walletModel->type = 1;
                                $walletModel->award = 0;
                                $walletModel->description = 'واریز به کیف پول میزبان بابت انصراف از رزرو توسط میهمان';
                                if ($walletModel->save()) {
                                    $userHostModel = User::where('id', $hostUser->id)->first();
                                    $userHostModel->credit = $userHostModel->credit + $penaltyPrice;
                                    if ($userHostModel->save()) {
                                        // save calculate
                                    } else {
                                        return '00000000000000000000ERR-Wal37621';
                                    }
                                } else {
                                    return '00000000000000000000ERR-Cre33925';
                                }

                                /** Deposit into guest_user's wallet */
                                $walletModel = new Wallet();
                                $walletModel->user_id = $guestUser->id;
                                $walletModel->reserve_code = $reserveModel[0]->group_code;
                                $walletModel->payment_id = $paymentModel->id;
                                $walletModel->price = $remainingPriceFinal;
                                $walletModel->type = 1;
                                $walletModel->award = 0;
                                $walletModel->description = 'واریز به کیف پول میهمان بابت انصراف از رزرو با احتساب جریمه';
                                if ($walletModel->save()) {
                                    $userGuestModel = User::where('id', $guestUser->id)->first();
                                    $userGuestModel->credit = $userGuestModel->credit + $remainingPriceFinal;
                                    if ($userGuestModel->save()) {
                                        // save calculate
                                    } else {
                                        return '00000000000000000000ERR-Wal87621';
                                    }
                                } else {
                                    return '00000000000000000000ERR-Cre83925';
                                }

                            } else { // calculate penalty by hour


                                $sitePercent = $totalPrice * $sitePercent / 100;
                                $totalPrice_ = $totalPrice - $sitePercent;
                                $priceForOneDayReserve = $totalPrice_ / count($reserveModel); // price for one day reserve

                                $day = $cancelReserveRule[$hostModel->cancel_rule_id]['time'][2]['penalty'] / 24;

                                $penaltyPrice = $priceForOneDayReserve * $day;

                                $remainingPriceFinal = $paidMoney - $penaltyPrice; // before calculate site percent

                                $remainingPriceFinal = $remainingPriceFinal - $sitePercent; // after calculate site percent


                                if ($remainingPriceFinal < 0) {
                                    $remainingPriceFinal = 0;
                                }


//                                $penaltyPrice = $priceReserveHour * $cancelReserveRule[$hostModel->cancel_rule_id]['time'][3]['penalty'];
//                                $remainingPriceFinal = $paidMoney - $penaltyPrice; // before calculate site percent
//                                $sitePercent = $totalPrice * $sitePercent / 100;
//                                $remainingPriceFinal = $remainingPriceFinal - $sitePercent; // after calculate site percent
//                                if($remainingPriceFinal < 0) {
//                                    $remainingPriceFinal = 0;
//                                }
                                /** calculate price for users (penalty , ...) */
                                /** Deposit into host_user's wallet */

                                $walletModel = new Wallet();
                                $walletModel->user_id = $hostUser->id;
                                $walletModel->reserve_code = $reserveModel[0]->group_code;
                                $walletModel->payment_id = $paymentModel->id;
                                $walletModel->price = $penaltyPrice;
                                $walletModel->type = 1;
                                $walletModel->award = 0;
                                $walletModel->description = 'واریز به کیف پول میزبان بابت انصراف از رزرو توسط میهمان';
                                if ($walletModel->save()) {
                                    $userHostModel = User::where('id', $hostUser->id)->first();
                                    $userHostModel->credit = $userHostModel->credit + $penaltyPrice;
                                    if ($userHostModel->save()) {
                                        // save calculate
                                    } else {
                                        return '00000000000000000000ERR-Wal37621';
                                    }
                                } else {
                                    return '00000000000000000000ERR-Cre33925';
                                }

                                /** Deposit into guest_user's wallet */
                                $walletModel = new Wallet();
                                $walletModel->user_id = $guestUser->id;
                                $walletModel->reserve_code = $reserveModel[0]->group_code;
                                $walletModel->payment_id = $paymentModel->id;
                                $walletModel->price = $remainingPriceFinal;
                                $walletModel->type = 1;
                                $walletModel->award = 0;
                                $walletModel->description = 'واریز به کیف پول میهمان بابت انصراف از رزرو با احتساب جریمه';
                                if ($walletModel->save()) {
                                    $userGuestModel = User::where('id', $guestUser->id)->first();
                                    $userGuestModel->credit = $userGuestModel->credit + $remainingPriceFinal;
                                    if ($userGuestModel->save()) {
                                        // save calculate
                                    } else {
                                        return '00000000000000000000ERR-Wal87621';
                                    }
                                } else {
                                    return '00000000000000000000ERR-Cre83925';
                                }
                            }
                        }
                    } else {
                        PrintMessage('خطا در ارسال داده ها', 'warning');
                        return back();
                    }
                } else {
                    PrintMessage('خطا در ارسال داده ها', 'warning');
                    return back();
                }
            } else {
                PrintMessage('خطا در ارسال داده ها', 'warning');
                return back();
            }
        } elseif ($reserveModel[0]->status == -2) {
            PrintMessage('انصراف از رزرو این اقامتگاه قبلا در سیستم ثبت شده است', 'info');
            return back();
        } else {
            //sms for host
            try {
                $sms = melipayamak::sms();
                $to = $hostModel->getUser->mobile;
                $from = '10007514';
                $text = '' . $hostModel->getUser->first_name . ' ' . $hostModel->getUser->last_name . ' عزیز
مهمان از درخواست رزرو خود منصرف شد، منتظر درخواست های بعدی باشید
لینک :
پشتیبانی :';
                $sms->send($to, $from, $text);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
            foreach ($reserveModel as $key => $value) {
                $value->status = -2;
                $value->save();
            }
            PrintMessage('انصراف از رزرو با موفقیت انجام شد', 'success');
            return back();
        }
        DB::table('reserves')
            ->where('group_code', $code)
            ->where('status', 2)
            ->update(['status' => -2]);
        PrintMessage('انصراف از رزرو با موفقیت انجام شد', 'success');

        return redirect(route('IndexReserve'));

    }


    public function ReserveBySMS($code)
    {
        $reserveToken = Reserve::with('getHost')->whereHas('getHost', function ($Query) {
            $Query->where('user_id', auth()->user()->id);
        })->where('group_code', $code)->where('status', 0)->first();
        if (!empty($reserveToken)) {
            DB::table('reserves')
                ->where('group_code', $code)
                ->where('status', 0)
                ->update(['status' => 1, 'step' => 2]); // success by host user and waiting payment for customer
            // Delete Token
            ActiveReserve::where('user_id', $reserveToken->user_id)
                ->where('user_host_id', $reserveToken->getHost->user_id)
                ->where('host_id', $reserveToken->getHost->id)
                ->where('group_code', $code)
                ->delete();
            // Send Sms For Payment
            $userModel = User::where('id', $reserveToken->user_id)->first();
            $userHostModel = User::where('id', $reserveToken->getHost->user_id)->first();
            // guest user
            try {
                $sms = melipayamak::sms();
                $to = $userModel->mobile;
                $from = '10007514';
                $text = '' . $userModel->first_name . ' ' . $userModel->last_name . ' عزیز
میزبان درخواست شما را تایید کرد حال برای پرداخت و نهایی کردن رزرو خود تا 2 ساعت وقت دارید مبلغ را با لینک زیر پرداخت کنید
www.rentt.ir/index/reserve
پشتیبانی :
';
                $sms->send($to, $from, $text);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
            // host user
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
            $Response = ["Success" => "1", "Message" => 'تایید رزرو با موفقیت در سیستم ثبت شد.'];
        } else {
            $Response = ["Success" => "0", "Message" => 'اطلاعاتی با این مشخصات یافت نشد، لطفا با پشتیبانی تماس بگیرید.'];
        }
        return $Response;
    }


    public function DescriptionCancel(Request $request)
    {
        Reserve::where('group_code', $request->group_code)
            ->where('status', -2)
            ->update(['description' => $request->description]);
        PrintMessage('عملیات ثبت با موفقیت انجام شد', 'info');
        return back();
    }


    public function CalculateExpireTimeReserve()
    {

//        return;

//        $info = getdate();
//        $hour = $info['hours'];
//        if($hour >= 9 && $hour <= 00) {
//            $myfile = fopen("update-expire-reserve.txt", "w");
//            $time = jDate::forge(date('H:i:s'))->format('Y/m/d H:i:s');
//            fwrite($myfile, $time);
//            fclose($myfile);
//            $dateAfter3Hours = Carbon::parse(date('Y-m-d H:i:s'))->subHour(3);
//
//            $reserveModel = Reserve::where(function ($Q) {
//                $Q->where('status', 0);
//                $Q->orWhere('status', 1);
//            })
//            ->where('created_at', '<', $dateAfter3Hours)
//            ->get();
//            dd($reserveModel);
//            foreach ($reserveModel as $key => $value) {
//                $mobileUser = User::where('id', $value->user_id)->first();
//                try {
//                    $sms = melipayamak::sms();
//                    $to = $mobileUser->mobile;
//                    $from = '10007514';
//                    $text = '' . $mobileUser->first_name . ' ' . $mobileUser->last_name . ' عزیز
//شما نسبت به پرداخت مهلت 2 ساعته خود را برای اقامتگاه تست از دست داده اید و تا 1 ساعت دیگر درخواست منقضی شده و دیگر نمی توانید پرداخت کنید
//لطفا به درخواست های خود اطمینان حاصل فرمایید
//پشتیبانی :
//                ';
//                    $sms->send($to, $from, $text);
//                } catch (Exception $e) {
//                    echo $e->getMessage();
//                }
//            }
//
//
//            Reserve::where(function ($Q) {
//                $Q->where('status', 0);
//                $Q->orWhere('status', 1);
//            })
//                ->where('created_at', '<', $dateAfter3Hours)
//                ->update(['status' => -100]);
//
//
//            return 'true';
//        }
//        return 'hour in not supported';
    }


    public function CalculateExpireTimeReserveBeforeResultHost()
    {

//        return;

//        $myfile = fopen("update-expire-reserve-2.txt", "w");
//        $time = jDate::forge(date('H:i:s'))->format('Y/m/d H:i:s');
//        fwrite($myfile, $time);
//        fclose($myfile);
//        $dateAfter2Hours = Carbon::parse(date('Y-m-d H:i:s'))->subHour(2);
//        $reserveModel = Reserve::where(function ($Q) {
//            $Q->where('status', 1);
//        })
//        ->where('created_at', '<', $dateAfter2Hours)
//        ->get();
//
//        foreach ($reserveModel as $key => $value) {
//            $mobileUser = User::where('id', $value->user_id)->first();
//            try {
//                $sms = melipayamak::sms();
//                $to = $mobileUser->mobile;
//                $from = '10007514';
//                $text = '' . $mobileUser->first_name . ' ' . $mobileUser->last_name . ' عزیز
//                شما نسبت به پرداخت مهلت 2 ساعته خود را برای اقامتگاه از دست داده اید و تا 1 ساعت دیگر درخواست منقضی شده و دیگر نمی توانید پرداخت کنید
//                لطفا به درخواست های خود اطمینان حاصل فرمایید
//                پشتیبانی :
//                ';
//                $sms->send($to, $from, $text);
//            } catch (Exception $e) {
//                echo $e->getMessage();
//            }
//        }
//
//
//        $myfile1 = fopen("update-expire-reserve-3.txt", "w");
//        $time1 = jDate::forge(date('H:i:s'))->format('Y/m/d H:i:s');
//        fwrite($myfile1, $time1);
//        fclose($myfile1);
//        $dateAfter3Hours = Carbon::parse(date('Y-m-d H:i:s'))->subHour(3);
//        $dateAfter4Hours = Carbon::parse(date('Y-m-d H:i:s'))->subHour(4);
//
//
//
//
//        /** Delete Active Reserve Code after 4 hours */
//        ActiveReserve::where('created_at', '<', $dateAfter4Hours)->delete();
//
//
//
//
//
//        /** Get Reserve after 4 hours */
//        $reserveModel2 = Reserve::where(function ($Q) {
//            $Q->where('status', 1);
//        })
//            ->where('created_at', '>', $dateAfter3Hours)
//            ->get();
//
//        foreach ($reserveModel2 as $key => $value) {
//            $hostModel = Host::with('getUser')->where('id', $value->host_id)->first();
//            try {
//                $sms = melipayamak::sms();
//                $to = $hostModel->getUser->mobile;
//                $from = '10007514';
//                $text = '' . $hostModel->getUser->first_name . ' ' . $hostModel->getUser->last_name . ' عزیز
//متاسفانه پس از 3 ساعت تاکنون مهمان مبلغ را پرداخت نکرده و درخواست منقضی شد
//منتظر درخواست های بعدی باشید.
//پشتیبانی : ';
//                $sms->send($to, $from, $text);
//            } catch (Exception $e) {
//                echo $e->getMessage();
//            }
//        }
//        // update record
//        Reserve::where(function ($Q) {
//            $Q->where('status', 1);
//        })
//            ->where('created_at', '>', $dateAfter3Hours)
//            ->update(['status' => -100]);
//
//
//
//
//
//        $myfile4 = fopen("update-expire-reserve-4.txt", "w");
//        $time4 = jDate::forge(date('H:i:s'))->format('Y/m/d H:i:s');
//        fwrite($myfile4, $time4);
//        fclose($myfile4);
//        $dateAfter2Hours = Carbon::parse(date('Y-m-d H:i:s'))->subHour(2);
//        $reserveModel4 = Reserve::where('status', 0)
//            ->where('created_at', '<', $dateAfter2Hours)
//            ->get();
//
//        foreach ($reserveModel4 as $key => $value) {
//            $mobileUser = User::where('id', $value->user_id)->first();
//            try {
//                $sms = melipayamak::sms();
//                $to = $mobileUser->mobile;
//                $from = '10007514';
//                $text = '' . $mobileUser->first_name . ' ' . $mobileUser->last_name . ' عزیز
//درخواست شما پس از 2 ساعت تاکنون توسط میزبان پاسخ داده نشده
//درخواست شما تا 1 ساعت دیگر معتبر بوده و سپس منقضی می شود، اگر مایل نیستید بیشتر در انتظار تایید میزبان بمانید از طریق لینک زیر اقامتگاه های دیگری در شهر ' . $value->getHost->getTownship->name . ' انتخاب کنید
//http://www.rentt.ir/city/' . $value->getHost->getTownship->id . '
//پشتیبانی :
//                ';
//                $sms->send($to, $from, $text);
//            } catch (Exception $e) {
//                echo $e->getMessage();
//            }
//        }
//
//
//        return 'true';
    }

}
