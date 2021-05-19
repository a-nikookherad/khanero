<?php

namespace App\Modules\Special\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Special\Model\Special;
use App\Modules\Special\Model\Month;
use App\Modules\Special\Model\SpecialDate;
use App\Modules\Host\Model\Host;
use Morilog\Jalali\Facades\jDate;
use Morilog\Jalali\Facades\jDateTime;
use Carbon\Carbon;

class SpecialController extends Controller
{

      public function IndexSpecial()
      {
            $specialModel = Special::with('getHost')->whereHas('getHost', function ($Q) {
                  $Q->where('step', 100);
                  $Q->where('user_id', auth()->user()->id);
            })->get();
            $hostModel = Host::where('step', 100)->where('user_id', auth()->user()->id)->get();
            return view('Special::indexSpecial', compact(
                'specialModel',
                'hostModel'
            ));
      }

      public function StoreSpecial(Request $request)
      {
            $Message = [
                'host_id.required' => 'نام اقامتگاه نمیتواند خالی باشد .',
                'date.required' => 'تاریخ نمیتواند خالی باشد .',
                'price.required' => 'قیمت نمیتواند خالی باشد .',
                'price.numeric' => 'قیمت باید یک عدد صحیح باشد .',
            ];
            $this->validate($request, [
                'host_id' => 'required|numeric',
                'date' => 'required',
                'price' => 'required',
            ], $Message);
            $price = str_replace(',', '', $request->price);
            $hostModel = Host::where('id', $request->host_id)
                ->where('step', 100)
                ->where('user_id', auth()->user()->id)->first();
            if (empty($hostModel)) {
                  PrintMessage('اقامتگاه مورد نظر یافت نشد .', 'danger');
                  return back();
            }
            if ($price < 0 || !is_numeric($price)) {
                  PrintMessage('مقدار فیلد قیمت نامعتبر است .', 'danger');
                  return back();
            }
            $dateTime = jDateTime::ConvertToGeorgian($request->date, date('H:i:s'));
            $buffer = explode(' ', $dateTime);
            $specialTime = $buffer[0] . ' 00:00:00';
            $specialDayModel = Special::where('host_id', $request->host_id)->where('date', $specialTime)->first();
            if (!empty($specialDayModel)) {
                  PrintMessage('تاریخ مورد نظر قبلا در سیستم ثبت شده است ، لطفا برای ویرایش قیمت یا حذف در جدول زیر اقدام کنید .', 'danger');
                  return back();
            }

            $specialModel = new Special();
            $specialModel->host_id = $request->host_id;
            $specialModel->date = $specialTime;
            $specialModel->price = $price;
            if ($specialModel->save()) {
                  PrintMessage('ثبت قیمت در روز خاص موفقیت آمیز بود.', 'success');
                  return back();
            } else {
                  PrintMessage('ثبت قیمت موفقیت آمیز نبود.', 'danger');
                  return back();
            }
      }

      /****************
       * Edit Special
       ***************/
      public function EditSpecial($id)
      {
            $specialModel = Special::where('id', $id)->first();
            return response()->json(view('Special::Ajax.AjaxEditSpecial', compact('specialModel'))->render());
      }

      /****************
       * Update Special
       ***************/
      public function UpdateSpecial(Request $request)
      {
            $specialModel = Special::findOrfail($request->special_id);
            $Message = [
                'price.required' => 'قیمت نمیتواند خالی باشد .',
                'price.numeric' => 'قیمت باید یک عدد صحیح باشد .',
            ];
            $this->validate($request, [
                'price' => 'required|numeric',
            ], $Message);
            $specialModel->price = $request->price;
            if ($specialModel->save()) {
                  PrintMessage('ویرایش قیمت موفقیت آمیز بود.', 'info');
                  return back();
            } else {
                  PrintMessage('ویرایش قیمت موفقیت آمیز نبود.', 'danger');
                  return back();
            }
      }

      /****************
       * Delete Special
       ***************/
      public function DeleteSpecial($id)
      {
            $specialModel = Special::where('id', $id)->first();
            return response()->json(view('Special::Ajax.AjaxDeleteSpecial', compact('specialModel'))->render());
      }

      /****************
       * Special Delete
       ***************/
      public function SpecialDelete(Request $request)
      {
            $specialModel = Special::with('getHost')
                ->whereHas('getHost', function ($Query) {
                      $Query->where('user_id', auth()->user()->id);
                })
                ->where('id', $request->special_id)
                ->first();
            if (!empty($specialModel)) {
                  $specialModel->delete();
                  PrintMessage('حذف تاریخ موفقیت آمیز بود.', 'info');
                  return back();
            } else {
                  PrintMessage('عملیات حذف موفقیت آمیز نبود.', 'danger');
                  return back();
            }
      }

      /****************
       * Get Special
       ***************/
      public static function GetSpecial()
      {
            $specialModel = Special::where('active', 1)->get();
            return $specialModel;
      }

      /****************
       * Special Days
       ***************/
      public function SpecialDays(Request $request)
      {
            if ($request->price == "" || $request->price == 0) {
                  $Response = ["Success" => "0", "Message" => "قیمت نمی تواند خالی باشد ."];
                  return response()->json($Response);
            }
            $dateTime = jDateTime::ConvertToGeorgian($request->date, date('H:i:s'));
            $buffer = explode(' ', $dateTime);
            $specialTime = $buffer[0] . ' 00:00:00';
            $specialDayModel = Special::where('host_id', $request->host_id)->where('date', $specialTime)->first();
            if (!empty($specialDayModel)) {
                  $Response = ["Success" => "0", "Message" => "تاریخ مورد نظر قبلا در سیستم ثبت شده است ، لطفا برای ویرایش به قسمت تخفیفات و روزهای خاص در منو مراجعه کنید ."];
                  return response()->json($Response);
            }
            $specialDayModel = new Special();
            $specialDayModel->host_id = $request->host_id;
            $specialDayModel->date = $specialTime;
            $specialDayModel->price = $request->price;
            if ($specialDayModel->save()) {
                  $Response = ["Success" => "1", "Message" => "ثبت قیمت با موفقیت انجام شد ."];
                  return response()->json($Response);
            } else {
                  $Response = ["Success" => "0", "Message" => "عدم موفقیت در ثبت اطلاعات ، لطقا مجددا تلاش نمایید ."];
                  return response()->json($Response);
            }
      }

      /****************
       * Index Calendar
       ***************/
      public function IndexCalendar()
      {
          $nowYearJalali = jDate::forge(date("Y/m/d"))->format('Y');
          $nowMonthJalali = jDate::forge(date("Y/m/d"))->format('m');

          list($year, $month, $day) = explode('/', ''.$nowYearJalali.'/'.$nowMonthJalali.'/1');
          $timestamp = bmktime(0, 0, 0, $month, $day, $year);
          $day_info = bgetdate($timestamp);
          $num_week = Carbon::now()->dayOfWeek;
            $week = array(
                1 => 'شنبه',
                2 => 'یکشنبه',
                3 => 'دوشنبه',
                4 => 'سه شنبه',
                5 => 'چهارشنبه',
                6 => 'پنجشنبه',
                7 => 'جمعه'
            );
            switch ($num_week) {
                  case 1:
                        $num_week_jalali = 3;
                        break; //دوشنبه
                  case 2:
                        $num_week_jalali = 4;
                        break; //سه شنبه
                  case 3:
                        $num_week_jalali = 5;
                        break; //چهارشنبه
                  case 4:
                        $num_week_jalali = 6;
                        break; //پنج شنبه
                  case 5:
                        $num_week_jalali = 7;
                        break; //جمعه
                  case 6:
                        $num_week_jalali = 1;
                        break; //شنبه
                  case 0:
                        $num_week_jalali = 2;
                        break; //یکشنبه
            }
//            return $num_week_jalali;
//        return $week[$num_week_jalali]; // name today

            $now = Carbon::now();
            $month = jdate($now)->format('m');
//            $first_day = jdate(date('Y/m/01', time()))->format('l');

            foreach ($week as $key => $value) {
                  if ($value == $day_info['weekday']) {
                        $day_id = $key;
                  }
            }
            foreach ($week as $key => $value) {
                  if ($value == $week[$num_week_jalali]) {
                        $day_id_today = $key;
                  }
            }
            $detailMonth['start_day_month'] = array(
                'name_day' => $day_info['weekday'],
                'day_id' => $day_id
            );
            $monthModel = Month::where('id', $month)->first();
            $detailMonth['today'] = array(
                'day_id' => $day_id_today,
                'name_day' => $week[$num_week_jalali],
                'name_month' => $monthModel->name,
                'num_month' => $monthModel->id, // number month in year
                'year' => jdate($now)->format('Y'),
                'day' => jdate($now)->format('d')
            );
            for ($i = 1; $i <= $monthModel->number_day; $i++) {
                  $name_day = $week[$day_id];
                  $detailMonth['detail_days'][] = array('day' => $i, 'day_id' => $day_id, 'name_day' => $name_day);
                  $day_id++;
                  if ($day_id == 8) {
                        $day_id = 1;
                  }
            }
            $specialDateModel = SpecialDate::all();
            $calendar = view('Special::Ajax.Calendar', compact('detailMonth', 'week'));
            return view('Special::indexCalendar', compact('calendar', 'specialDateModel'));
      }


      public function CalendarChange(Request $request)
      {
            sleep(0.5);
            $week = array(
                1 => 'شنبه',
                2 => 'یکشنبه',
                3 => 'دوشنبه',
                4 => 'سه شنبه',
                5 => 'چهارشنبه',
                6 => 'پنجشنبه',
                7 => 'جمعه'
            );
            $month_now = $request->num_month;
            $year_now = $request->year;
            $next_month = $month_now+1;
            $day_id = $request->day_id+1;
            if($day_id == 8) {
                  $day_id =1;
            }
            $first_day = $week[$day_id];
            if($next_month == 13) {
                  $next_month = 1;
                  $year_now = $year_now + 1;
            }
            $monthModel = Month::where('id', $next_month)->first();
            $detailMonth['start_day_month'] = array(
                'name_day' => $first_day,
                'day_id' => $day_id
            );
            $detailMonth['today'] = array(
                'day_id' => $day_id,
                'name_day' => $week[$day_id],
                'name_month' => $monthModel->name,
                'num_month' => $monthModel->id, // number month in year
                'year' => $year_now,
                'day' => 01
            );
            for ($i = 1; $i <= $monthModel->number_day; $i++) {
                  $name_day = $week[$day_id];
                  $detailMonth['detail_days'][] = array('day' => $i, 'day_id' => $day_id, 'name_day' => $name_day);
                  $day_id++;
                  if ($day_id == 8) {
                        $day_id = 1;
                  }
            }
            return response()->json(view('Special::Ajax.Calendar', compact('detailMonth', 'week'))->render());
      }


      public function SetDateCalendar(Request $request) {
          if($request->date == '') {
              $Response = ['Success' => 0, 'Message' => 'فیلد تاریخ نمی تواند خالی باشد'];
              return $Response;
          } else {
              $dateTime = jDateTime::ConvertToGeorgian($request->date, date('H:i:s'));
              $buffer = explode(' ', $dateTime);
              $specialDate = $buffer[0] . ' 00:00:00';
              $specialDateModel = new SpecialDate();
              $specialDateModel->date = $specialDate;
              $specialDateModel->description = $request->description;
              if($specialDateModel->save()) {
                  $Response = [
                      'Success' => 1,
                      'Message' => 'ثبت تاریخ با موفقیت انجام شد',
                      'date' => $specialDateModel->date,
                      'description' => $request->date
                  ];
                  return $Response;
              }
          }
      }


      public function DeleteDateCalendar($id) {
          SpecialDate::where('id', $id)->delete();
          return back();
      }


}
