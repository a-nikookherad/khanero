<?php

namespace App\Http\Controllers;

use App\Modules\City\Model\Province;
use App\Modules\City\Model\Township;
use App\Modules\Host\Model\BlockedDay;
use App\Modules\Host\Model\Gallery;
use App\Modules\Host\Model\Host;
use App\Modules\Host\Model\HostPossibilities;
use App\Modules\Host\Model\Integrated;
use App\Modules\Host\Model\PriceDay;
use App\Modules\InfoCity\Model\InfoProvince;
use App\Modules\Possibilities\Model\Option;
use App\Modules\Possibilities\Model\PositionType;
use App\Modules\Rate\Model\Rate;
use App\Modules\Reserve\Model\Reserve;
use App\Modules\Rules\Model\Rule;
use App\Modules\Section\Model\Sections;
use App\Modules\SlideShow\Model\SlideShow;
use App\Modules\Special\Model\Month;
use App\Modules\Special\Model\Special;
use App\Modules\Special\Model\SpecialDate;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Melipayamak;
use Morilog\Jalali\Facades\jDate;
use Morilog\Jalali\Facades\jDateTime;
use Morilog\Jalali\Jalalian;

class AppController extends Controller
{
    public function HomePage()
    {
        $slideShowModel = SlideShow::all();

        return view('frontend.Page.HomePage', compact(
            'slideShowModel'
        ));
    }

    public function DetailHost($id)
    {
//        return $id;


        $hostModel = Host::query()
            ->where('id', $id)
            ->where('active', 1)
            ->where('status', 1)
            ->where('step', 100)
            ->with('getRate')
            ->with('getHostPossibilities.getOption')
            ->with('getHostRules.getRules')
            ->with('getRoom')
            ->with('getGallery')
            ->with('getPositionType')
            ->with('getRoomCommon')
            ->with('getProvince')
            ->with('getTownship')
            ->with('getUser')
            ->with('getBuildingType')
            ->with('getHomeType')
            ->with('getPriceDay.getWeek')
            ->with('getDiscount')
            ->first();
        if (empty($hostModel)) {
            return back();
        }

        // امکانات خانه ها
        $optionModel = Option::where('active', 1)->get();

        $arr_option[]= null;
        // هر خانه ای چه امکاناتی دارد
        foreach ($hostModel->getHostPossibilities as $key => $value) {
            $arr_option[] = $value->option_id;
        }
        //خانه در چه ناحیه ای قرار دارد ساحلی یا کویری یا ....
        $positionTypeModel = PositionType::where('active', 1)->get();

        // قیمت خانه در روز سه شنبه مختلف هفته
        $priceModelFirstWeek = DB::table('price_days')
            ->where('host_id', $id)
            ->where('week_id', 4)// tuesday
            ->first();

        // قیمت خانه در روز جمعه مختلف هفته

        $priceModelLastWeek = DB::table('price_days')
            ->where('host_id', $id)
            ->where('week_id', 6)// friday
            ->first();

        // از تاریخ فلان تا فلان مقدار 10 درصد تخفیف داده است
        $specialModel = Special::where('host_id', $hostModel->id)->get();

        // قیمت خانه در ایام هفته
        $dayPriceModel = PriceDay::with('getWeek')->where('host_id', $id)->orderBy('id', 'asc')->get();

        // قوانین و مقرراتی که باید رعایت شود
        $ruleModel = Rule::where('active', 1)->get();

        //قوانین و مقرراتی که باید برای این خانه رعایت شود
        $arr_rule[]=null;
        foreach ($hostModel->getHostRules as $key => $value) {
            $arr_rule[] = $value->rule_id;
        }

//        dd( $arr_rule);

        if (auth()->check()) {
            $reserveModel = Reserve::where('user_id', auth()->user()->id)
                ->where('submit_rate', 0)
                ->where('status', 2)
                ->where('host_id', $hostModel->id)
                ->first();
            if (empty($reserveModel)) {
                $reserveModel = array();
            }
        } else {
            $reserveModel = array();
        }

        // خانه های که در این شهر باشند و از این مدل ساختمان باشد مثلا اپارتمان
        $hostLike = Host::where('township_id', $hostModel->township_id)
            ->where('building_type_id', $hostModel->building_type_id)
            ->where('id', '!=', $hostModel->id)
            ->where('active', 1)
            ->where('status', 1)
            ->where('step', 100)
            ->get();


        /*************  Calendar  ************/

        $nowYearJalali = Jalalian::forge(date("Y/m/d"))->format('Y'); // get now year
        $nowMonthJalali = Jalalian::forge(date("Y/m/d"))->format('m'); // get now month

        $first_date_month_jalali = '' . $nowYearJalali . '/' . $nowMonthJalali . '/01'; // get first day now month
        $month_model = Month::where('id', $nowMonthJalali)->first(); // get detail now month
        $last_date_month_jalali = '' . $nowYearJalali . '/' . $nowMonthJalali . '/' . $month_model->number_day; // get count day now monthz

        $first_date_month_miladi = \Morilog\Jalali\CalendarUtils::toGregorian($nowYearJalali,$nowMonthJalali,1); // change first day now month jalali to miladi(AD)
        $last_date_month_miladi = \Morilog\Jalali\CalendarUtils::toGregorian($nowYearJalali,$nowMonthJalali,$month_model->number_day); // change last day now month jalali to miladi(AD)
        $first_date_month_miladi = $first_date_month_miladi[0].'/'.$first_date_month_miladi[1].'/'.$first_date_month_miladi[2];
        $last_date_month_miladi = $last_date_month_miladi[0].'/'.$last_date_month_miladi[1].'/'.$last_date_month_miladi[2];

//        $first_date_month_miladi = explode(' ', $first_date_month_miladi); // put date to array for separate date and time
//        $last_date_month_miladi = explode(' ', $last_date_month_miladi); // put date to array for separate date and time

        $first_date_month_miladi = $first_date_month_miladi . ' 00:00:00'; // change time to 00:00:00
        $last_date_month_miladi = $last_date_month_miladi . ' 00:00:00'; // change time to 00:00:00


        $first_date_month_miladi =$this->convertDateToMiladi($first_date_month_jalali,true);
        $last_date_month_miladi = $this->convertDateToMiladi($last_date_month_jalali,true);

        $special_date_model = SpecialDate::where('date', '>=', $first_date_month_miladi)
            ->where('date', '<=', $last_date_month_miladi)
            ->get();

        $holidays_now_month = array();
        foreach ($special_date_model as $key => $value) {
            $jalali_date = Jalalian::forge($value->date)->format('Y/m/d');
            $jalali_date = explode('/', $jalali_date);
            $holidays_now_month[] = $jalali_date[2];
        }
        // $holidays_now_month => this month's holidays [1, 8, 22, ...]
        list($year, $month, $day) = explode('/', '' . $nowYearJalali . '/' . $nowMonthJalali . '/01');
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
            case 0:
                $num_week_jalali = 3;
                break; //دوشنبه
            case 1:
                $num_week_jalali = 4;
                break; //سه شنبه
            case 2:
                $num_week_jalali = 5;
                break; //چهارشنبه
            case 3:
                $num_week_jalali = 6;
                break; //پنج شنبه
            case 4:
                $num_week_jalali = 7;
                break; //جمعه
            case 5:
                $num_week_jalali = 1;
                break; //شنبه
            case 6:
                $num_week_jalali = 2;
                break; //یکشنبه
        }

        $now = Carbon::now();
        $month = jdate($now)->format('m');

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

//        return response()->json($detailMonth);

        $specialDateModel = SpecialDate::all();

        // نمایش لیست قیمت های روز هفته برای خانه مورد نظر
        $priceModel = PriceDay::where('host_id', $hostModel->id)->get();

        for ($i = 1; $i <= $monthModel->number_day; $i++) {

            if ($i<10){
                $dayCalendarJalali = '' . $nowYearJalali . '/' . $nowMonthJalali . '/' . '0'.$i;
            }else{
                $dayCalendarJalali = '' . $nowYearJalali . '/' . $nowMonthJalali . '/' .$i;
            }

            $dayCalendarMiladi = \Morilog\Jalali\CalendarUtils::toGregorian($nowYearJalali,$nowMonthJalali,$i);
//            dd($dayCalendarJalali);
            $dayCalendarMiladi =$this->convertDateToMiladi($dayCalendarJalali,true);

            $name_day = $week[$day_id];
            foreach ($priceModel as $key => $value) {
                if ($value->week_id == $day_id) {
                    $priceDay = $value->price;
                }
            }

            foreach ($specialDateModel as $key => $value) {
                if ($value->date == $dayCalendarMiladi) {
                    $priceDay = $hostModel->special_price;
                }
            }
//            $specialModel = Special::query()->with('getHost')
//                ->whereHas('getHost', function ($Q) use ($id) {
//                $Q->where('getHost.step','=', 100);
//                $Q->where('getHost.id','=', $id);
//            })->get();

            $specialModel = Special::query()
                ->leftJoin('hosts','special_days.host_id','=','hosts.id')
                ->where('hosts.step','=',100)
                ->where('hosts.id','=',$id)
                ->get();


//            foreach ($specialModel as $key => $value) {
//                if ($value->date == $dayCalendarMiladi) {
//                    $priceDay = $value->price;
//                }
//            }

            $blockDay = 0;
//            $blockedDayModel = BlockedDay::with('getHost')->whereHas('getHost', function ($Q) use ($id) {
//                $Q->where('step', 100);
//                $Q->where('id', $id);
//            })->orderBy('host_id')->orderBy('date')->get();

            $blockedDayModel = BlockedDay::query()
                ->leftJoin('hosts','blocked_days.host_id','=','hosts.id')
                ->where('hosts.step','=',100)
                ->where('hosts.id','=',$id)
                ->orderBy('blocked_days.host_id')
                ->orderBy('blocked_days.date')
                ->get();

            foreach ($blockedDayModel as $key => $value) {
                if ($value->date == $dayCalendarMiladi) {
                    $blockDay = 1;
                }
            }
            // نشان دهنده اینه که روزی که رزرو شده با روزی که رزور کردم یکیه
            $blockedDayReserve = Reserve::where('host_id', $id)
                ->whereIn('status', [1,2])->get(); // array(1,2)
            foreach ($blockedDayReserve as $key => $value) {
                if ($value->reserve_date == $dayCalendarMiladi) {
                    $blockDay = 1;
                }
            }



////            $reserveModelUser = Reserve::where('host_id', $hostModel->id)
////                ->where('reserve_date', $dayCalendarMiladi)
////                ->where('status', 0)
////                ->first();
////
////            if(!empty($reserveModelUser)) {
////                if($reserveModelUser->reserve_date == $dayCalendarMiladi) {
////                    $blockDay = 1;
////                }
////            }

            $detailMonth['detail_days'][] = array(
                'day' => $i,
                'day_id' => $day_id,
                'name_day' => $name_day,
                'price' => $priceDay,
                'date' => $dayCalendarJalali,
                'date_ad' => $dayCalendarMiladi,
                'block_day' => $blockDay
            );
            $day_id++;
            if ($day_id == 8) {
                $day_id = 1;
            }
        }


        $calendar = view('Host::Calendar.CalendarReserve', compact(
            'detailMonth',
            'week',
            'holidays_now_month',
            'hostModel'
        ));

        /*********** End Calendar **********/







        return view('frontend.Page.Host.DetailHost', compact(
            'hostModel',
            'optionModel',
            'dayPriceModel',
            'positionTypeModel',
            'specialModel',
            'priceModelFirstWeek',
            'priceModelLastWeek',
            'ruleModel',
            'arr_rule',
            'arr_option',
            'reserveModel',
//            'commentModel',
            'calendar',
            'hostLike',
            'monthModel'
        ));
    }

    public function SearchHost(Request $request)
    {
        if ($request->date_from != "" && $request->date_to != "") {
            $from = jDateTime::ConvertToGeorgian($request->date_from, date('H:i:s'));
            $bufferFrom = explode(' ', $from);
            $dateFrom = $bufferFrom[0] . ' 00:00:00';
            $to = jDateTime::ConvertToGeorgian($request->date_to, date('H:i:s'));
            $bufferTo = explode(' ', $to);
            $dateTo = $bufferTo[0] . ' 00:00:00';

            $nowDate = date('Y-m-d 00:00:00');
            if ($dateFrom > $dateTo) {
                $Response = ["Success" => "2", "Message" => "تاریخ شروع نباید بزرگتر از تاریخ پایان باشد"];
                return response()->json($Response);
            }
            if ($dateFrom < $nowDate) {
                $Response = ["Success" => "2", "Message" => "تاریخ شروع نباید کوچکتر از تاریخ امروز باشد"];
                return response()->json($Response);
            }

            $hostModel = Host::with('getPriceDay')->whereHas('getPriceDay', function ($Query) use ($request) {
                $Query->where('price', '>=', (int)$request->range_1);
                $Query->where('price', '<=', (int)$request->range_2);
                $Query->groupBy('host_id');
            })
                ->with('getRate')
                ->where('name', 'like', '%' . $request->word . '%')
                ->where('active', 1)->where('status', 1)->where('step', 100)->get();

            $galleryModel = Gallery::where('active', 1)->get();
            if ($request->building_type > 0) {
                foreach ($hostModel as $key => $value) { // building type
                    if ($value->building_type_id != $request->building_type) {
                        unset($hostModel[$key]);
                    }
                }
            }
            if ($request->home_type > 0) { // home type
                foreach ($hostModel as $key => $value) {
                    if ($value->home_type_id != $request->home_type) {
                        unset($hostModel[$key]);
                    }
                }
            }
            if ($request->speed_reserve == 1) { // speed reserve
                foreach ($hostModel as $key => $value) {
                    if ($value->closest_time_reserve > 0) {
                        unset($hostModel[$key]);
                    }
                }
            }
            if ($request->count_room > 0) {
                foreach ($hostModel as $key => $value) {
                    if ($value->count_room < $request->count_room) {
                        unset($hostModel[$key]);
                    }
                }
            }
            if ($request->count_bathroom > 0) {
                foreach ($hostModel as $key => $value) {
                    if ($value->count_bathroom < $request->count_bathroom) {
                        unset($hostModel[$key]);
                    }
                }
            }
            if ($request->count_toilet > 0) {
                foreach ($hostModel as $key => $value) {
                    if ($value->count_toilet < $request->count_toilet) {
                        unset($hostModel[$key]);
                    }
                }
            }
            if ($request->count_bed > 0) {
                foreach ($hostModel as $key => $value) {
                    $count = 0;
                    foreach ($value->getRoom as $item => $index) {
                        $count += $index->single_beds + $index->double_beds;
                    }
                    if ($count < $request->count_bed) {
                        unset($hostModel[$key]);
                    }
                }
            }
            if ($request->option != null) {
                $array_option = explode(',', $request->option);
                foreach ($hostModel as $key => $value) {
                    foreach ($array_option as $item) {
                        $hostPossibilities = HostPossibilities::where('host_id', $value->id)
                            ->where('option_id', $item)
                            ->first();
                        if (empty($hostPossibilities)) {
                            unset($hostModel[$key]);
                        }
                    }
                }
            }

            $date_from = Carbon::parse($dateFrom);
            $date_to = Carbon::parse($dateTo);
            // Calculate Difference Between two dates
            $countDayReserve = $date_from->diffInDays($date_to);
            return $countDayReserve;
            $array_day_reserve = array();
            for ($i = 0; $i <= $countDayReserve; $i++) {
                $array_day_reserve[] = date('Y-m-d 00:00:00', strtotime($date_from . ' + ' . $i . ' days'));
            }
            foreach ($hostModel as $key => $value) {
                $reserveModel = Reserve::where('id', $value->id)->first();
                if (!empty($reserveModel)) {
                    if (in_array($reserveModel->reserve_date, $array_day_reserve)) {
                        unset($hostModel[$key]);
                    }
                }
            }
            if ($request->capacity == "" || $request->capacity == 0 || $request->capacity < 0) {
                $Capacity = 100;
            } else {
                $Capacity = $request->capacity;
            }
            foreach ($hostModel as $key => $value) {
                if ($Capacity != 100) {
                    if ($value->count_guest < $Capacity) {
                        unset($hostModel[$key]);
                    }
                }
            }

            $priceModel = DB::table('price_days')
                ->select(DB::raw('min(price) as price'), 'host_id')
                ->groupBy('host_id')
                ->get();
            $array_location = array();
            // calculate min and max location map
            foreach ($hostModel as $key => $value) {
                $array_location['latitude'][] = $value->latitude;
                $array_location['longitude'][] = $value->longitude;
            }
//            return ($array_location);

            $zoom = 8;
            if (empty($array_location)) {
                $zoom = 4;
                $array_location['latitude'][] = '32.1194058';
                $array_location['longitude'][] = '51.3288805';
            }

            $Response = ["Success" => "1", "Message" => response()->json(view('frontend.Page.SearchHostAjax', compact('hostModel',
                'galleryModel', 'priceModel', 'array_location', 'zoom'))->render())];
            return response()->json($Response);
        } else {

            $hostModel = Host::with('getPriceDay')->whereHas('getPriceDay', function ($Query) use ($request) {
                $Query->where('price', '>=', $request->range_1);
                $Query->where('price', '<=', $request->range_2);
                $Query->groupBy('host_id');
            })
                ->with('getRate')
                ->where('name', 'like', '%' . $request->word . '%')
                ->where('active', 1)->where('status', 1)->where('step', 100)->get();
            $galleryModel = Gallery::where('active', 1)->get();

            if ($request->building_type > 0) {
                foreach ($hostModel as $key => $value) { // building type
                    if ($value->building_type_id != $request->building_type) {
                        unset($hostModel[$key]);
                    }
                }
            }
            if ($request->home_type > 0) { // home type
                foreach ($hostModel as $key => $value) {
                    if ($value->home_type_id != $request->home_type) {
                        unset($hostModel[$key]);
                    }
                }
            }
            if ($request->speed_reserve == 1) { // speed reserve
                foreach ($hostModel as $key => $value) {
                    if ($value->closest_time_reserve > 0) {
                        unset($hostModel[$key]);
                    }
                }
            }
            if ($request->count_room > 0) {
                foreach ($hostModel as $key => $value) {
                    if ($value->count_room < $request->count_room) {
                        unset($hostModel[$key]);
                    }
                }
            }
            if ($request->count_bathroom > 0) {
                foreach ($hostModel as $key => $value) {
                    if ($value->count_bathroom < $request->count_bathroom) {
                        unset($hostModel[$key]);
                    }
                }
            }
            if ($request->count_toilet > 0) {
                foreach ($hostModel as $key => $value) {
                    if ($value->count_toilet < $request->count_toilet) {
                        unset($hostModel[$key]);
                    }
                }
            }
            if ($request->count_bed > 0) {
                foreach ($hostModel as $key => $value) {
                    $count = 0;
                    foreach ($value->getRoom as $item => $index) {
                        $count += $index->single_beds + $index->double_beds;
                    }
                    if ($count < $request->count_bed) {
                        unset($hostModel[$key]);
                    }
                }
            }
            if ($request->option != null) {
                $array_option = explode(',', $request->option);
                foreach ($hostModel as $key => $value) {
                    foreach ($array_option as $item) {
                        $hostPossibilities = HostPossibilities::where('host_id', $value->id)
                            ->where('option_id', $item)
                            ->first();
                        if (empty($hostPossibilities)) {
                            unset($hostModel[$key]);
                        }
                    }
                }
            }
            foreach ($hostModel as $key => $value) {
                if ($request->capacity != "" || $request->capacity != 0 || $request->capacity > 0) {
                    if ($value->count_guest < $request->capacity) {
                        unset($hostModel[$key]);
                    }
                }
            }
            // calculate min price for any host
            $priceModel = DB::table('price_days')
                ->select(DB::raw('min(price) as price'), 'host_id')
                ->groupBy('host_id')
                ->get();

            $array_location = array();
            // calculate min and max location map
            foreach ($hostModel as $key => $value) {
                $array_location['latitude'][] = $value->latitude;
                $array_location['longitude'][] = $value->longitude;
            }
//            return ($array_location);

            $zoom = 8;
            if (empty($array_location)) {
                $zoom = 4;
                $array_location['latitude'][] = '32.1194058';
                $array_location['longitude'][] = '51.3288805';
            }
            $Response = ["Success" => "1", "Message" => response()->json(view('frontend.Page.SearchHostAjax', compact('hostModel',
                'galleryModel', 'priceModel', 'array_location', 'zoom'))->render())];
            return response()->json($Response);
        }
    }


    public function SearchHostByCode(Request $request)
    {
        $hostModel = Host::where('id', $request->code)
//            ->with('getRate')
            ->where('active', 1)
            ->where('status', 1)
            ->where('step', 100)
            ->first();
        if (!empty($hostModel)) {
            $url = asset('detail/host' . '/' . $hostModel->id);
            $Response = ["Success" => "1", "Message" => $url];
            return response()->json($Response);
        } else {
            $Response = ["Success" => "0", "Message" => "اقامتگاهی با کد مورد نظر در سیستم ثبت نشده است"];
            return response()->json($Response);
        }
    }


    public function SearchKeyWord(Request $request)
    {
        $word = $request->word;
        $hostModel = Host::where('name', 'like', '%' . $word . '%')
            ->where('active', 1)
            ->where('status', 1)
            ->where('step', 100)
            ->get();
        $galleryModel = Gallery::where('active', 1)->get();
        $priceModel = DB::table('price_days')
            ->select(DB::raw('min(price) as price'), 'host_id')
            ->groupBy('host_id')
            ->get();
        $postSearch = 1;
        return view('frontend.Page.HomePage', compact('hostModel', 'galleryModel', 'priceModel', 'word', 'postSearch'));
    }


    public static function SectionHomePage()
    {
        $section = Sections::first();
        return $section;
    }


    public function DetailCancelRule()
    {
        $cancelRule = config('setting');
        dd($cancelRule);
    }


    public function LoginJangi($mobile)
    {
        dd(3453);
        $userModel = User::where('mobile', $mobile)->first();
        if (!empty($userModel)) {
            Auth::loginUsingId($userModel->id);
            return redirect(route('HomePage'));
        }
    }

    public function convertDateToMiladi($date, $parameters=false)
    {

//        dd($date);
        $date=\Morilog\Jalali\CalendarUtils::createCarbonFromFormat('Y/m/d', $date)->format('Y-m-d'); //2016-05-8
//
        if($parameters){
            $date = $date.' 00:00:00';
        }

        return $date;

    }

}
