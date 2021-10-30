<?php

namespace App\Modules\Host\Controllers;


use App\Helper\DateHelper;
use App\Http\Controllers\Controller;
use App\Modules\Host\Model\Host;
use App\Modules\Host\Model\Integrated;
use App\Modules\Host\Model\Gallery;
use App\Modules\Host\Model\GalleryIntegrated;
use App\Modules\Host\Model\RoomCommons;
use App\Modules\Host\Model\HostPossibilities;
use App\Modules\Host\Model\BlockedDay;
use App\Modules\Host\Model\Room;
use App\Modules\Host\Model\HostRules;
use App\Modules\Host\Model\PriceDay;
use App\Modules\Host\Model\InstantBooking;
use App\Modules\Host\Model\LastMinuteReserve;
use App\Modules\City\Model\Province;
use App\Modules\City\Model\Township;
use App\Modules\Possibilities\Model\Option;
use App\Modules\Rate\Model\Rate;
use App\Modules\Sms\Controllers\SmsController;
use App\Modules\Week\Model\Week;
use App\Modules\Discount\Model\Discount;
use App\Modules\Special\Model\Special;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use DB;
use Morilog\Jalali\Facades\jDate;
use Morilog\Jalali\Facades\jDateTime;
use App\Modules\Special\Model\Month;
use App\Modules\Special\Model\SpecialDate;
use App\Modules\Reserve\Model\Reserve;
use Carbon\Carbon;
use App\ImageManager;
use Image;



class HostController extends Controller
{
    /**************
     * Index Host
     ***************/
    public function IndexHost($type)
    {
        if (auth()->user()->role_id == 1) {
            $host = Host::where('is_deleted', 0)->where('step', 100)->orderBy('id', 'DESC');
            if($type == 'all') {
                // all records
            } elseif($type == 'review') {
                $host->where('status', 1); // در حال بررسی
            } elseif($type == 'confirm') {
                $host->where('status', 2); // منتشر شده
            } elseif($type == 'imperfect') {
                $host->where('status', 0); // ناقص
            } elseif($type == 'disable') {
                $host->where('status', -1); // غیر فعال
            } else {
                abort(404);
            }
            $hostModel = $host->get();
        } else { // user
            $host = Host::where('user_id', auth()->user()->id)->where('is_deleted', 0)->where('step', 100)->orderBy('id', 'DESC');

            if($type == 'all') {
                // all records
            } elseif($type == 'review') {
                $host->where('status', 1); // در حال بررسی
            } elseif($type == 'confirm') {
                $host->where('status', 2); // منتشر شده
            } elseif($type == 'imperfect') {
                $host->where('status', 0); // ناقص
            } elseif($type == 'disable') {
                $host->where('status', -1); // غیر فعال
            } else {
                abort(404);
            }
            $hostModel = $host->get();
        }

        return view('Host::indexHost', compact('hostModel', 'type'));
    }


    public function SearchIndexHost(Request $request) {
        $type = $request->type;
        if (auth()->user()->role_id == 1) {
            $host = Host::where('is_deleted', 0)->where('step', 100)->orderBy('id', 'DESC');
            if($request->id != '') {
                $host->where('id', $request->id-5000);
            }
            if($request->mobile != '') {
                $host->whereHas('getUser', function ($Query) use($request) {
                    $Query->where('mobile', $request->mobile);
                });
            }
            if($type == 'all') {
                // all records
            } elseif($type == 'review') {
                $host->where('status', 1); // در حال بررسی
            } elseif($type == 'confirm') {
                $host->where('status', 2); // منتشر شده
            } elseif($type == 'imperfect') {
                $host->where('status', 0); // ناقص
            } elseif($type == 'disable') {
                $host->where('status', -1); // غیر فعال
            } else {
                abort(404);
            }
            $hostModel = $host->get();
        } else { // user
            $host = Host::where('user_id', auth()->user()->id)->where('is_deleted', 0)->where('step', 100)->orderBy('id', 'DESC');
            if($type == 'all') {
                // all records
            } elseif($type == 'review') {
                $host->where('status', 1); // در حال بررسی
            } elseif($type == 'confirm') {
                $host->where('status', 2); // منتشر شده
            } elseif($type == 'imperfect') {
                $host->where('status', 0); // ناقص
            } elseif($type == 'disable') {
                $host->where('status', -1); // غیر فعال
            } else {
                abort(404);
            }
            $hostModel = $host->get();
        }
        return view('Host::indexHost', compact('hostModel', 'type', 'request'));
    }

    /**************
     * Index Integrated
     ***************/
    public function IndexIntegrated()
    {
        if(auth()->user()->role_id == 1) {
            $integratedModel = Integrated::all();
        } else {
            $integratedModel = Integrated::where('user_id', auth()->user()->id)->get();
        }
        return view('Host::indexIntegrated', compact('integratedModel'));
    }

    /***************
     * Create Host
     ***************/
    public function CreateHost()
    {
        if(auth()->user()->role_id != 1) {
//            return 'waiting ...';
        }
//        return redirect(route('HostFactor'));
        $provinceModel = Province::where('country_id', 114)->where('active', 1)->get();
        $optionModel   = Option::where('active', 1)->get();
        $hostModel     = Host::where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->first();
//        return $hostModel;
        if (empty($hostModel) || (!empty($hostModel) && $hostModel->step == 100)) {
            $hostModel = new Host();
            $hostModel->user_id = auth()->user()->id;
            $hostModel->save();
        }
        $galleryModel = Gallery::where('host_id', $hostModel->id)->get();
//        dd($hostModel->getRoom);
        if (auth()->user()->confirm_rules != 0) {
            return view('Host::createHost', compact(
                    'provinceModel',
                         'optionModel',
                            'hostModel',
                            'galleryModel'
            ));
        } else {
            return view('Host::rules');
        }
    }

    /***************
     * Confirm Rules
     ***************/
    public function ConfirmRules(Request $request)
    {
        if ($request->has('confirm')) {
            $userModel = User::where('id', auth()->user()->id)->first();
            $userModel->confirm_rules = 1;
            if ($userModel->save()) {
                PrintMessage('لطفا تمامی فرم های زیر را با دقت پر کنید .', 'info');
                return redirect(route('CreateHost'));
            } else {
                PrintMessage('خطا در تایید قوانین لطفا مجددا سعی کنید .', 'info');
                return redirect(route('CreateHost'));
            }
        } else {
            return redirect(route('CreateHost'));
        }
    }

    /***************
     * Store Host Step1
     ***************/
    public function StoreHostStep1(Request $request)
    {
        $Message = [
            'host_id.required'          => 'فیلد آی دی آگهی نمیتواند خالی باشد',
            'building_type_id.required' => 'فیلد نوع اقامتگاه نمیتواند خالی باشد',
            'standard_guest.required'   => 'ظرفیت استاندارد اجباری است',
            'count_guest.required'      => 'حداکثر ظرفیت اجباری است',
            'host_name.required'        => 'عنوان نمیتواند خالی باشد',
            'meter.required'            => 'متراژ نمیتواند خالی باشد',
        ];
        $validator = Validator::make($request->all(),
            [
                'host_id'          => 'required',
                'building_type_id' => 'required',
                'standard_guest'   => 'required',
                'count_guest'      => 'required',
                'host_name'        => 'required',
                'meter'            => 'required',
            ],
            $Message);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $Response = ["Success" => "0", "Message" => $errors->first()];
            return response()->json($Response);
        }

        if($request->has('edit_host')) { // edit host
            if(auth()->user()->role_id == 1) {
                $hostModel = Host::where('id', $request->host_id)->first();
            } else {
                $hostModel = Host::where('id', $request->host_id)->where('user_id', auth()->user()->id)->first();
            }
        } else {
            $hostModel = Host::where('id', $request->host_id)
                ->where('user_id', auth()->user()->id)
                ->where('step', '!=', 100)
                ->orderBy('id', 'DESC')
                ->first();
        }
        if (empty($hostModel)) {
            return false;
        }

        $hostModel->name = $request->host_name;
        $hostModel->meter = $request->meter;
        $hostModel->meter_total = $request->meter_total;
        $hostModel->building_type_id = $request->building_type_id;
        $hostModel->building_floor = $request->building_floor;
        $hostModel->reconstruction = $request->reconstruction;
        $hostModel->shape_host = $request->shape_host;
        $hostModel->single_bed_reception = $request->single_bed_reception; //فضای حال تحت یک نفره
        $hostModel->double_bed_reception = $request->double_bed_reception; // فضای حال تخت دو نفره
        $hostModel->sofa_bed_reception = $request->sofa_bed_reception; // فضای حال مبل تخت خواب شو
        $hostModel->traditional_bedding_reception = $request->traditional_bedding_reception; // فضای حال رختخواب کف
        $hostModel->type_rent = $request->type_rent;// ۱ مجزا - ۲ دربستی - ۳ واحد خصوصی
        $hostModel->register_by = $request->register_by;
        $hostModel->units_per_floor = $request->units_per_floor;
        $hostModel->count_room = $request->count_room;
        $hostModel->standard_guest = $request->standard_guest;
        $hostModel->count_guest = $request->count_guest;
        $hostModel->year = $request->year;

        $hostModel->save();

        // check room common after update host record
        Room::where('host_id', $request->host_id)->delete();
        $Room = json_decode($request->rooms);

        if (count($Room) > 0) {
            foreach ($Room as $key => $value) {
                $data[] = [
                    'host_id'          => $request->host_id,
                    'single_beds'      => ($value[0] == null) ? 0 : $value[0],
                    'double_beds'      => ($value[1] == null) ? 0 : $value[1],
                    'sofa_beds'        => ($value[2] == null) ? 0 : $value[2],
                    'traditional_beds' => ($value[3] == null) ? 0 : $value[3],
                    'active'           => 1,
                    'created_at'       => date('Y-m-d H:i:s'),
                    'updated_at'       => date('Y-m-d H:i:s')
                ];
            }
            DB::table('rooms')->insert($data);
        }


        if($request->has('edit_host')) { // edit host
            $Response = ["Success" => "1", "Message" => "ویرایش اقامتگاه موفقیت آمیز بود."];
            return response()->json($Response);
        } else {
            if ($hostModel->step == 0 && $hostModel->step != 100) {
                $provinceModel = Province::where('country_id', 114)->where('active', 1)->get();
                $hostModel->step = 1;
                if ($hostModel->save()) {
                    $Response = ["Success" => "1", "Message" => response()->json(view('Host::step.step2', compact('provinceModel', 'hostModel'))->render())];
                    return response()->json($Response);
                }
            } elseif ($hostModel->step != 100) {
                $step = $hostModel->step;
                $Response = ["Success" => "1", "Message" => response()->json(view('Host::step.step' . $step . '', compact('hostModel'))->render())];
                return response()->json($Response);
            }
        }

    }

    /***************
     * Store Host Step2
     ***************/
    public function StoreHostStep2(Request $request)
    {
//        return $request->all();
        $Message = [
            'host_id.required'     => 'فیلد آی دی آگهی نمیتواند خالی باشد',
            'province_id.required' => 'استان نمیتواند خالی باشد',
            'township_id.required' => 'شهرستان نمیتواند خالی باشد',
            'floor.required'       => 'طبقه نمیتواند خالی باشد',
            'address.required'     => 'آدرس نمیتواند خالی باشد',
//           'position_id.required'=>'فیلد موقعیت نمیتواند خالی باشد',
            'latitude.required'    => 'مختصات نقشه نمیتواند خالی باشد',
            'longitude.required'   => 'مختصات نقشه نمیتواند خالی باشد',
        ];
        $validator = Validator::make($request->all(),
            [
                'host_id'     => 'required',
                'province_id' => 'required',
                'township_id' => 'required',
                'floor'       => 'required',
                'address'     => 'required',
//              'position_id' => 'required',
                'latitude'    => 'required',
                'longitude'   => 'required',
            ],
            $Message);
        if ($validator->fails()) {
            $errors   = $validator->errors();
            $Response = ["Success" => "0", "Message" => $errors->first()];
            return response()->json($Response);
        }

        if($request->has('edit_host')) { // edit host
            if(auth()->user()->role_id == 1) {
                $hostModel = Host::where('id', $request->host_id)->first();
            } else {
                $hostModel = Host::where('id', $request->host_id)->where('user_id', auth()->user()->id)->first();
            }
        } else {
            $hostModel = Host::where('id', $request->host_id)
                ->where('user_id', auth()->user()->id)
                ->where('step', '!=', 100)
                ->orderBy('id', 'DESC')
                ->first();
        }

        $buffer_1   = explode(',', $request->select_array_1);
        $position_1 = serialize($buffer_1);

        // fill record
        $hostModel->province_id       = $request->province_id;
        $hostModel->township_id       = $request->township_id;
        $hostModel->floor             = $request->floor;
        $hostModel->plaque            = $request->plaque;
        $hostModel->postal_code       = $request->postal_code;
        $hostModel->unit              = $request->unit;
        $hostModel->district          = $request->district;
        $hostModel->address           = $request->address;
        $hostModel->position_array_1  = $position_1; //بافت منطقه
        $hostModel->vision            = $request->vision;
        $hostModel->distance_shopping = $request->distance_shopping;
        $hostModel->parking           = $request->parking;
        $hostModel->other_position    = $request->other_position;
        $hostModel->latitude          = $request->latitude;
        $hostModel->longitude         = $request->longitude;

        $hostModel->save();

        if($request->has('edit_host')) { // edit host
            $Response = ["Success" => "1", "Message" => "ویرایش اقامتگاه موفقیت آمیز بود."];
            return response()->json($Response);
        } else {
            if ($hostModel->step == 1 && $hostModel->step != 100) {
                $hostModel->step = 2;
                if ($hostModel->save()) {
                    $Response = ["Success" => "1", "Message" => response()->json(view('Host::step.step3', compact('hostModel'))->render())];
                    return response()->json($Response);
                }
            } elseif ($hostModel->step != 100) {
                $step = $hostModel->step;
                $Response = ["Success" => "1", "Message" => response()->json(view('Host::step.step' . $step . '', compact('hostModel'))->render())];
                return response()->json($Response);
            }
        }

    }

    /***************
     * Store Host Step3
     ***************/
    public function StoreHostStep3(Request $request)
    {
        $Message = [
            'host_id.required'      => 'فیلد آی دی آگهی نمیتواند خالی باشد',
            'select_array.required' => 'انتخاب حداقل یک مورد از فیلد های زیر اجباری است',
        ];
        $validator = Validator::make($request->all(),
            [
                'host_id'      => 'required',
                'select_array' => 'required',
            ],
            $Message);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $Response = ["Success" => "0", "Message" => $errors->first()];
            return response()->json($Response);
        }

        if($request->has('edit_host')) { // edit host
            if(auth()->user()->role_id == 1) {
                $hostModel = Host::where('id', $request->host_id)->first();
            } else {
                $hostModel = Host::where('id', $request->host_id)->where('user_id', auth()->user()->id)->first();
            }
        } else {
            $hostModel = Host::where('id', $request->host_id)
                ->where('user_id', auth()->user()->id)
                ->where('step', '!=', 100)
                ->orderBy('id', 'DESC')
                ->first();
        }
        HostPossibilities::where('host_id', $hostModel->id)->delete();
        $buffer = explode(',', $request->select_array);
        $buffer2 = explode(',', $request->description_array);
        foreach ($buffer as $key => $value) {
            $data[] = [
                'host_id'     => $hostModel->id,
                'option_id'   => $buffer[$key],
                'description' => $buffer2[$key],
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s')
            ];
        }
        DB::table('host_possibilities')->insert($data);

        if($request->has('edit_host')) { // edit host
            $Response = ["Success" => "1", "Message" => "ویرایش اقامتگاه موفقیت آمیز بود."];
            return response()->json($Response);
        } else {
            if ($hostModel->step == 2 && $hostModel->step != 100) {
                $hostModel->step = 3;
                if ($hostModel->save()) {
                    $Response = ["Success" => "1", "Message" => response()->json(view('Host::step.step4', compact('hostModel'))->render())];
                    return response()->json($Response);
                }
            } elseif ($hostModel->step != 100) {
                $step = $hostModel->step;
                $Response = ["Success" => "1", "Message" => response()->json(view('Host::step.step' . $step . '', compact('hostModel'))->render())];
                return response()->json($Response);
            }
        }
    }

    /***************
     * Store Host Step4
     ***************/
    public function StoreHostStep4(Request $request)
    {
        $galleryModel = Gallery::where('host_id', $request->host_id)->first();
        $hostModel = Host::where('id', $request->host_id)
            ->where('step', '!=', 100)
            ->orderBy('id', 'DESC')
            ->first();
        if (empty($galleryModel)) {
            $Response = ["Success" => "0", "Message" => "وارد کردن حداقل یک عکس الزامی می باشد"];
            return response()->json($Response);
        }

//        $Message = [
//            'img.required' => 'تصویر شاخص نمیتواند خالی باشد',
////            'img.max' => 'حجم عکس نمیتواند بیش از 5000 KB باشد',
//            'img.mimes' => 'تصویر شاخص باید از نوع "png" یا "jpg" باشد'
//        ];
//        $validator = Validator::make($request->all(), [
//            'img' => 'required|mimes:png,jpg,jpeg', //max:5000
//        ], $Message);
//        if ($validator->fails()) {
//            $errors = $validator->errors();
//            $Response = ["Success" => "0", "Message" => $errors->first()];
//            return response()->json($Response);
//        }
//        $file = $request->file('img');
//        if ($file) {
//            $image = Image::make($request->img)->resize(1200, 700)->encode('jpg', 100);
//            $title = rand(10000,99999) . time() . '.jpg';
//            if ($image->save('Uploaded/Gallery/Img' . '/' . $title)) {
//                $hostModel->img = $title;
//                $hostModel->save();
//            }
//        }

        if ($hostModel->step == 3 && $hostModel->step != 100) {
            $hostModel->step = 4;
            if ($hostModel->save()) {
                $Response = ["Success" => "1", "Message" => response()->json(view('Host::step.step5', compact( 'hostModel'))->render())];
                return response()->json($Response);
            }
        } elseif ($hostModel->step != 100) {
            $step = $hostModel->step;
            $Response = ["Success" => "1", "Message" => response()->json(view('Host::step.step' . $step . '', compact('hostModel'))->render())];
            return response()->json($Response);
        }
    }

    /***************
     * Store Host Step5
     ***************/
    public function StoreHostStep5(Request $request)
    {

        $Message = [
            'host_id.required'         => 'فیلد آی دی آگهی نمیتواند خالی باشد',
            'time_enter_from.required' => 'وارد کردن ساعت ورود اجباری است',
            'time_enter_to.required'   => 'وارد کردن ساعت ورود اجباری است',
            'time_exit.required'       => 'وارد کردن ساعت خروج اجباری است',
            'min_reserve.required'     => 'وارد کردن حداقل تعداد روز رزرو اجباری است',
//            'select_array.required'  => 'انتخاب حداقل یک فیلد از قوانین اجباری است',
        ];
        $validator = Validator::make($request->all(),
            [
                'host_id'         => 'required',
                'time_enter_from' => 'required',
                'time_enter_to'   => 'required',
                'time_exit'       => 'required',
                'min_reserve'     => 'required',
//                'select_array'  => 'required',
            ],
            $Message);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $Response = ["Success" => "0", "Message" => $errors->first()];
            return response()->json($Response);
        }

        if($request->has('edit_host')) { // edit host
            if(auth()->user()->role_id == 1) {
                $hostModel = Host::where('id', $request->host_id)->first();
            } else {
                $hostModel = Host::where('id', $request->host_id)->where('user_id', auth()->user()->id)->first();
            }
        } else {
            $hostModel = Host::where('id', $request->host_id)
                ->where('user_id', auth()->user()->id)
                ->where('step', '!=', 100)
                ->orderBy('id', 'DESC')
                ->first();
        }
        if (empty($hostModel)) {
            return false;
        }


        $hostModel->time_enter_from = $request->time_enter_from;
        $hostModel->time_enter_to = $request->time_enter_to;
        $hostModel->time_exit = $request->time_exit;
        $hostModel->min_reserve_day = $request->min_reserve;
        $hostModel->new_rule = $request->new_rule;
        $hostModel->save();

        DB::table('host_rules')->where('host_id', $hostModel->id)->delete();

        $buffer = explode(',', $request->select_array);
        $buffer2 = explode(',', $request->description_array);
        if (!empty($buffer)) {
            foreach ($buffer as $key => $value) {
                $data[] = [
                    'host_id'     => $hostModel->id,
                    'rule_id'     => $buffer[$key],
                    'description' => $buffer2[$key],
                    'created_at'  => date('Y-m-d H:i:s'),
                    'updated_at'  => date('Y-m-d H:i:s')
                ];
            }
            DB::table('host_rules')->insert($data);
        }

        if($request->has('edit_host')) { // edit host
            $Response = ["Success" => "1", "Message" => "ویرایش اقامتگاه موفقیت آمیز بود."];
            return response()->json($Response);
        } else {
            if ($hostModel->step == 4 && $hostModel->step != 100) {
                $hostModel->step = 5;
                if ($hostModel->save()) {
                    $Response = ["Success" => "1", "Message" => response()->json(view('Host::step.step6', compact('hostModel'))->render())];
                    return response()->json($Response);
                } else {
                    return 'error-427';
                }
            } elseif ($hostModel->step != 100) {
                $step = $hostModel->step;
                $Response = ["Success" => "1", "Message" => response()->json(view('Host::step.step' . $step . '', compact('hostModel'))->render())];
                return response()->json($Response);
            }
        }
    }

    /***************
     * Store Host Step6
     ***************/
    public function StoreHostStep6(Request $request)
    {

//        $dateString = \Morilog\Jalali\jDateTime::convertNumbers('۱۳۹۵-۰۲-۱۹', true); // 1395-02-19
//        $dateString =\Morilog\Jalali\jDateTime::createCarbonFromFormat('Y/m/d', $request->day_turn_discount_from)->format('Y/m/d'); //2016-05-8
//        dd($dateString);
//        return $request->all();
        $Message = [
            'host_id.required'         => 'فیلد آی دی آگهی نمیتواند خالی باشد',
            'price_saturday.required'  => 'وارد کردن قیمت روز شنبه اجباری است',
            'price_sunday.required'    => 'وارد کردن قیمت روز یک شنبه اجباری است',
            'price_monday.required'    => 'وارد کردن قیمت روز دوشنبه اجباری است',
            'price_tuesday.required'   => 'وارد کردن قیمت روز سه شنبه اجباری است',
            'price_wednesday.required' => 'وارد کردن قیمت روز چهارشنبه اجباری است',
            'price_thursday.required'  => 'وارد کردن قیمت روز پنج شنبه اجباری است',
            'price_friday.required'    => 'وارد کردن قیمت روز جمعه اجباری است',
//            'price_special_day.required' => 'وارد کردن قیمت روزهای خاص تقویم اجباری است',
//            'one_person_price.required' => 'وارد کردن قیمت به ازای هر نفر اجباری است',
        ];
        $validator = Validator::make($request->all(),
            [
                'host_id'         => 'required',
                'price_saturday'  => 'required',
                'price_sunday'    => 'required',
                'price_monday'    => 'required',
                'price_tuesday'   => 'required',
                'price_wednesday' => 'required',
                'price_thursday'  => 'required',
                'price_friday'    => 'required',
//                'price_special_day' => 'required',
//                'one_person_price' => 'required',
            ],
            $Message);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $Response = ["Success" => "0", "Message" => $errors->first()];
            return response()->json($Response);
        }
        $i = 1;

        if($request->has('edit_host')) { // edit host
            if(auth()->user()->role_id == 1) {
                $hostModel = Host::where('id', $request->host_id)->first();
            } else {
                $hostModel = Host::where('id', $request->host_id)->where('user_id', auth()->user()->id)->first();
            }
        } else {
            $hostModel = Host::where('id', $request->host_id)
                ->where('user_id', auth()->user()->id)
                ->where('step', '!=', 100)
                ->orderBy('id', 'DESC')
                ->first();
        }
        if (empty($hostModel)) {
            return false;
        }

        DB::table('price_days')->where('host_id', $hostModel->id)->delete();
        foreach ($request->all() as $key => $value) {
            if ($key == 'host_id' || $key == 'percent_discount' || $key == 'day_discount' || $key == 'percent_discount_2' || $key == 'day_discount_2' || $key == 'max_day_show_calendar' || $key == 'price_one_person' || $key == 'price_special_day' || $key == 'day_turn_discount_from' || $key == 'day_turn_discount_to' || $key == 'turn_discount' || $key == 'edit_host') {
                continue;
            }
            if($value == 'NaN') {
                $Response = ["Success" => "0", "Message" => 'خطا در ثبت قیمت های هفته، لطفا پس از بررسی مجددا تلاش نمایید'];
                return response()->json($Response);
            }
            $price = str_replace(',', '', $value);
            $data_3[] = [
                'host_id' => $request->host_id,
                'week_id' => $i,
                'price' => $price * 10,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            $i++;
        }
//        return $data_3;
        DB::table('price_days')->insert($data_3);


        $priceSpecial   = str_replace(',', '', $request->price_special_day); // صفر ارسال می شود
        $onePersonPrice = str_replace(',', '', $request->price_one_person);
        $hostModel->special_price = $priceSpecial ;
        $hostModel->one_person_price = $onePersonPrice * 10;
        $hostModel->max_day_show_calendar = $request->max_day_show_calendar;
        $hostModel->save();
        Discount::where('host_id', $hostModel->id)->delete();
        if($request->day_discount != 0 && $request->percent_discount != 0) {
            $discountModel = new Discount();
            $discountModel->host_id     = $hostModel->id;
            $discountModel->number_days = $request->day_discount;
            $discountModel->percent     = $request->percent_discount;
            $discountModel->save();
        }
        if($request->day_discount_2 != 0 && $request->percent_discount_2 != 0) {
            $discountModel              = new Discount();
            $discountModel->host_id     = $hostModel->id;
            $discountModel->number_days = $request->day_discount_2;
            $discountModel->percent     = $request->percent_discount_2;
            $discountModel->save();
        }


        // ثبت بازه تخفیف دار
        //موقتا حذف میشود - البته در این قسمت کدتاریخ به درستی در دیتابیس ثبت نمیشود

        if($request->turn_discount != '' && $request->day_turn_discount_from != '' && $request->day_turn_discount_to != '') {
//            $dateTime_1 = jDateTime::ConvertToGeorgian($request->day_turn_discount_from,date('H:i:s'));
//            $buffer_1 = explode(' ', $dateTime_1);
            $buffer_1 = \Morilog\Jalali\jDateTime::createCarbonFromFormat('Y/m/d', $request->day_turn_discount_from)->format('Y-m-d'); //2016-05-8
//            dd($dateString);
            $dayTimeFrom = $buffer_1.' 00:00:00';

//            $dateTime_2= jDateTime::ConvertToGeorgian($request->day_turn_discount_to,date('H:i:s'));
//            $buffer_2 = explode(' ', $dateTime_2);
            $buffer_2 = \Morilog\Jalali\jDateTime::createCarbonFromFormat('Y/m/d', $request->day_turn_discount_from)->format('Y-m-d'); //2016-05-8
//
            $dayTimeTo = $buffer_2 .' 00:00:00';

//            $specialModel = new Special();
//            $specialModel->host_id = $hostModel->id;
//            $specialModel->date_from = $dayTimeFrom;
//            $specialModel->date_to = $dayTimeTo;
//            $specialModel->percent = $request->turn_discount;
//            $specialModel->save();
        }

        if($request->has('edit_host')) { // edit host
            $Response = ["Success" => "1", "Message" => "ویرایش اقامتگاه موفقیت آمیز بود."];
            return response()->json($Response);
        } else {
            if ($hostModel->step == 5 && $hostModel->step != 100) {
                $hostModel->step = 100;
                $hostModel->active = 1;
                if ($hostModel->save()) {
                    SmsController::SendSMSConfirmHost(auth()->user()->mobile);
                    PrintMessage('ثبت اقامتگاه با موفقیت انجام شد', 'success');
                    $Response = ["Success" => "1", "Message" => "ثبت اقامتگاه با موفقیت انجام شد"];
                    return response()->json($Response);
                } else {
                    return 'error-427';
                }
            } elseif ($hostModel->step != 100) {
                $step = $hostModel->step;
                $Response = ["Success" => "1", "Message" => response()->json(view('Host::step.step' . $step . '', compact('hostModel'))->render())];
                return response()->json($Response);
            }
        }
    }

    /***************
     * Store Host Step7
     ***************/
    public function StoreHostStep7(Request $request)
    {
        $Message = [
            'host_id.required'   => 'فیلد آی دی آگهی نمیتواند خالی باشد',
            'host_name.required' => 'وارد کردن نام اقامتگاه اجباری است',
//            'cancel_rule_id.required' => 'انتخاب قوانین لغو رزرو اجباری است',
//            'cancel_rule_id.numeric' => 'انتخاب قوانین لغو رزرو اجباری است',
        ];
        $validator = Validator::make($request->all(),
            [
                'host_id'   => 'required',
                'host_name' => 'required',
//                'cancel_rule_id' => 'required',
//                'cancel_rule_id' => 'numeric',
            ],
            $Message);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $Response = ["Success" => "0", "Message" => $errors->first()];
            return response()->json($Response);
        }
        $hostModel = Host::where('id', $request->host_id)
            ->where('step', '!=', 100)
            ->orderBy('id', 'DESC')
            ->first();
        if (!empty($hostModel)) {
            $hostModel->name = $request->host_name;
            $hostModel->description = $request->description;
            $hostModel->cancel_rule_id = 0;
            $hostModel->save();
        } else {
            $Response = ["Success" => "100", "Message" => "NotFount"];
            return response()->json($Response);
        }

        if ($hostModel->step == 6 && $hostModel->step != 100) {
            $hostModel->step = 100;
            $hostModel->active = 1;
            if ($hostModel->save()) {
                SmsController::SendSMSWaitConfirmHost(auth()->user()->mobile);
                PrintMessage('ثبت اقامتگاه با موفقیت انجام شد', 'success');
                $Response = ["Success" => "1", "Message" => "ثبت اقامتگاه با موفقیت انجام شد"];
                return response()->json($Response);
            } else {
                return 'error-427';
            }
        } elseif ($hostModel->step != 100) {
            $step = $hostModel->step;
            $Response = ["Success" => "1", "Message" => response()->json(view('Host::step.step' . $step . '', compact('hostModel'))->render())];
            return response()->json($Response);
        }
    }


    public function CreateHostStep($id, $step) {
        $hostModel = Host::where('id', $id)->where('user_id', auth()->user()->id)->first();
        if(!empty($hostModel)) {
            if($step < 0 || $step > 6 || $hostModel->step < $step) {
                return back();
            } else {
                $hostModel->step = $step;
                $hostModel->save();
                return redirect(route('CreateHost'));
            }
        }
    }
    

    /*******************
     * Store Image Host
     ******************/
    public function StoreImageHost(Request $request)
    {
//        dd($request->all());

        $Message = [
            'img.required' => 'عکس نمیتواند خالی باشد',
//            'img.max' => 'حجم عکس نمیتواند بیش از 5000 KB باشد',
            'img.mimes' => 'تصویر باید از نوع "png" یا "jpg" باشد'
        ];
        $validator = Validator::make($request->all(), [
            'img' => 'required|mimes:png,jpg,jpeg', //max:5000
        ], $Message);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $Response = ["Success" => "0", "Message" => $errors->first()];
            return response()->json($Response);
        }
        $file = $request->file('img');
        if ($file) {
            $hostModel = Host::where('id', $request->id)
                ->orderBy('id', 'DESC')
                ->first();
            $countGallery = Gallery::where('host_id', $hostModel->id)->count();
            if ($countGallery >= 20) { // maximum count upload img
                $Response = ["Success" => "0", "Message" => "count_upload"];
                return response()->json($Response);
            }
            if (!empty($hostModel)) {

                $image = Image::make($request->img)->resize(1200,700)->encode('jpg', 75);
                $title = uniqid(time() . '_' . auth()->user()->id . "_") . '.jpg';
                if ($image->save('Uploaded/Gallery/Img' . '/' . $title)) {
                    $galleryModel = new Gallery();
                    $galleryModel->host_id = $hostModel->id;
                    $galleryModel->img = $title;
                    if ($galleryModel->save()) {
                        $id       = $galleryModel->id;
                        $hostId   = $hostModel->id;
                        $Response = ["Success" => "1", "Message" => "true", "url" => response()->json(view('Host::Ajax.GalleryStep1', compact('title', 'id', 'hostId', 'countGallery'))->render()), "id" => $id];
                        return response()->json($Response);
                    } else {
                        $Response = ["Success" => "0", "Message" => "false"];
                        return response()->json($Response);
                    }
                }
            } else {
                $Response = ["Success" => "0", "Message" => "error"];
                return response()->json($Response);
            }
        } else {
            $Response = ["Success" => "0", "Message" => "none"];
            return response()->json($Response);
        }
    }


    public function RemoveImageHost(Request $request) {
        $galleryModel = Gallery::where('host_id', $request->host_id)
            ->where('id', $request->id)->first();
        if(file_exists('Uploaded/Gallery/Img/'.$galleryModel->img))
        {
            unlink('Uploaded/Gallery/Img/'.$galleryModel->img);
            File::delete('Uploaded/Gallery/Img/'.$galleryModel->img);
        }
        $galleryModel->delete();
        return $request->id;
    }

    /*******************
     * Delete Ajax Image
     ******************/
    public function AjaxDeleteImg(Request $request)
    {
        $galleryCount = Gallery::where('host_id', $request->host_id)->count();
        if($galleryCount == 1){
            return 'limited';
        }
        $galleryModel = Gallery::where('id', $request->img_id)->where('host_id', $request->host_id)->first();
        $imageUrl = $galleryModel->img;
        if(!empty($galleryModel)) {
            if($galleryModel->delete()) {
                if(file_exists('Uploaded/Gallery/Img/'.$imageUrl))
                {
                    unlink('Uploaded/Gallery/Img/'.$imageUrl);
                }
                return 'deleted';
            } else {
                return 'un-deleted';
            }
        }
    }

    /*******************
     * Delete Ajax Image Integrated
     ******************/
    public function AjaxDeleteImgIntegrated(Request $request)
    {
        $galleryCount = GalleryIntegrated::where('integrated_id', $request->integrated_id)->count();
        if($galleryCount == 1){
            return 'limited';
        }
        $galleryModel = GalleryIntegrated::where('id', $request->img_id)->where('integrated_id', $request->integrated_id)->first();


        $imageUrl = $galleryModel->url;


        if(!empty($galleryModel)) {
            if($galleryModel->delete()) {
                if(file_exists('Uploaded/Gallery/Integrated/File/'.$imageUrl))
                {
                    unlink('Uploaded/Gallery/Integrated/File/'.$imageUrl);
                }
                return 'deleted';
            } else {
                return 'un-deleted';
            }
        }
    }

    /*******************
     * Edit Host
     ******************/
    public function EditHost($id, $step) {
        if(auth()->user()->role_id == 1) {
            $hostModel = Host::where('id', $id)->first();
        } else {
            $hostModel = Host::where('user_id', auth()->user()->id)->where('id', $id)->first();
        }
        if(empty($hostModel)) {
            abort(404);
        }
        return view('Host::editHost', compact(
            'hostModel',
            'step'
        ));
    }

    /*******************
     * Edit Step Host
     ******************/
    public function UpdateHost(Request $request) {
//        return $request->all();
        $Message = [
            'host_id.required' => 'فیلد آی دی آگهی نمیتواند خالی باشد',

            'home_type_id.required' => 'فیلد نوع خانه نمیتواند خالی باشد',
            'building_type_id.required' => 'فیلد نوع ساختمان نمیتواند خالی باشد',
            'meter.required' => 'فیلد متراژ نمیتواند خالی باشد',
            'shared_yard.required' => 'فیلد حیاط مشترک نمیتواند خالی باشد',
            'count_man.required' => 'فیلد تعداد مرد نمیتواند خالی باشد',
            'count_woman.required' => 'فیلد تعداد زن نمیتواند خالی باشد',
            'count_child.required' => 'فیلد تعداد بچه نمیتواند خالی باشد',

            'province_id.required' => 'فیلد استان نمیتواند خالی باشد',
            'township_id.required' => 'فیلد شهرستان نمیتواند خالی باشد',
            'district.required' => 'فیلد محله نمیتواند خالی باشد',
            'address.required' => 'فیلد آدرس نمیتواند خالی باشد',
            'select_array1.required'=>'حداقل انتخاب یکی از فیلد های موقعیت اجباری میباشد',
            'latitude.required' => 'مختصات نقشه نمیتواند خالی باشد',
            'longitude.required' => 'مختصات نقشه نمیتواند خالی باشد',

            'standard_guest.required' => 'وارد کردن تعداد میهمان اجباری است',
            'count_guest.required' => 'وارد کردن تعداد میهمان اجباری است',
            'count_room.required' => 'وارد کردن تعداد اتاق خواب اجباری است',
            'count_toilet.required' => 'وارد کردن تعداد سرویس بهداشتی اجباری است',
            'count_bathroom.required' => 'وارد کردن تعداد حمام اجباری است',

            'select_array2.required' => 'انتخاب حداقل یک مورد از فیلد های زیر اجباری است',

            'time_enter.required' => 'وارد کردن ساعت ورود اجباری است',
            'time_exit.required' => 'وارد کردن ساعت خروج اجباری است',
            'min_reserve.required' => 'وارد کردن حداقل تعداد روز رزرو اجباری است',
            'select_array3.required' => 'انتخاب حداقل یک فیلد از قوانین اجباری است',

            'price_saturday.required' => 'وارد کردن قیمت روز شنبه اجباری است',
            'price_saturday.numeric' => 'قیمت باید یک عدد صحیح باشد ',
            'price_saturday.min' => 'قیمت باید حداقل 100000  ریال باشد ',
            'price_saturday.max' => 'قیمت نمیتواند بیش از 100000000  ریال باشد ',
            'price_sunday.required' => 'وارد کردن قیمت روز یک شنبه اجباری است',
            'price_sunday.numeric' => 'قیمت باید یک عدد صحیح باشد ',
            'price_sunday.min' => 'قیمت باید حداقل 100000  ریال باشد ',
            'price_sunday.max' => 'قیمت نمیتواند بیش از 100000000  ریال باشد ',
            'price_monday.required' => 'وارد کردن قیمت روز دوشنبه اجباری است',
            'price_monday.numeric' => 'قیمت باید یک عدد صحیح باشد ',
            'price_monday.min' => 'قیمت باید حداقل 100000 ریال باشد ',
            'price_monday.max' => 'قیمت نمیتواند بیش از 100000000  ریال باشد ',
            'price_tuesday.required' => 'وارد کردن قیمت روز سه شنبه اجباری است',
            'price_tuesday.numeric' => 'قیمت باید یک عدد صحیح باشد ',
            'price_tuesday.min' => 'قیمت باید حداقل 100000  ریال باشد ',
            'price_tuesday.max' => 'قیمت نمیتواند بیش از 100000000  ریال باشد ',
            'price_wednesday.required' => 'وارد کردن قیمت روز چهارشنبه اجباری است',
            'price_wednesday.numeric' => 'قیمت باید یک عدد صحیح باشد ',
            'price_wednesday.min' => 'قیمت باید حداقل 100000  ریال باشد ',
            'price_wednesday.max' => 'قیمت نمیتواند بیش از 100000000  ریال باشد ',
            'price_thursday.required' => 'وارد کردن قیمت روز پنج شنبه اجباری است',
            'price_thursday.numeric' => 'قیمت باید یک عدد صحیح باشد ',
            'price_thursday.min' => 'قیمت باید حداقل 100000  ریال باشد ',
            'price_thursday.max' => 'قیمت نمیتواند بیش از 100000000  ریال باشد ',
            'price_friday.required' => 'وارد کردن قیمت روز جمعه اجباری است',
            'price_friday.numeric' => 'قیمت باید یک عدد صحیح باشد ',
            'price_friday.min' => 'قیمت باید حداقل 100000  ریال باشد ',
            'price_friday.max' => 'قیمت نمیتواند بیش از 100000000  ریال باشد ',

            'special_price.required' => 'قیمت روزهای ویژه نمی تواند خالی باشد',
            'one_person_price.required' => 'قیمت به ازای هر نفر نمی تواند خالی باشد',

            'host_name.required' => 'وارد کردن نام اقامتگاه اجباری است',
        ];
        $validator = Validator::make($request->all(),
            [
                'host_id' => 'required',

                'home_type_id' => 'required',
                'building_type_id' => 'required',
                'meter' => 'required',
                'shared_yard' => 'required',
                'count_man' => 'required',
                'count_woman' => 'required',
                'count_child' => 'required',

                'province_id' => 'required',
                'township_id' => 'required',
                'district' => 'required',
                'address' => 'required',
                'select_array1' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',

                'standard_guest' => 'required',
                'count_guest' => 'required',
                'count_room' => 'required',
                'count_toilet' => 'required',
                'count_bathroom' => 'required',

                'select_array2' => 'required',

                'time_enter' => 'required',
                'time_exit' => 'required',
                'min_reserve' => 'required',
                'select_array3' => 'required',

                'price_saturday' => 'required',
                'price_sunday' => 'required',
                'price_monday' => 'required',
                'price_tuesday' => 'required',
                'price_wednesday' => 'required',
                'price_thursday' => 'required',
                'price_friday' => 'required',

                'special_price' => 'required',
                'one_person_price' => 'required',

                'host_name' => 'required',
            ],
            $Message);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $Response = ["Success" => "0", "Message" => $errors->first()];
            return response()->json($Response);
        }

        if(auth()->user()->role_id == 1) {
            $hostModel = Host::where('id', $request->host_id)->first();
        } else {
            $hostModel = Host::where('id', $request->host_id)->where('user_id', auth()->user()->id)->first();
        }

        $galleryCount = Gallery::where('host_id', $request->host_id)->count();
        if($galleryCount == 0) {
            $Response = ["Success" => "0", "Message" => "گالری نمی تواند خالی باشد"];
            return response()->json($Response);
        }

        // step 1
        $hostModel->home_type_id = $request->home_type_id;
        $hostModel->building_type_id = $request->building_type_id;
        $hostModel->meter = $request->meter;
        $hostModel->shared_yard = $request->shared_yard;
        // check room common after update host record
        $roomCommonsModel_check = RoomCommons::where('host_id', $request->host_id)->first();
        if (!empty($roomCommonsModel_check)) {
            RoomCommons::where('host_id', $request->host_id)->delete();
        }
        if ($request->home_type_id == 2 || $request->home_type_id == 3) // common room
        {
            $roomCommonsModel = new RoomCommons();
            $roomCommonsModel->host_id = $request->host_id;
            $roomCommonsModel->count_man = $request->count_man;
            $roomCommonsModel->count_woman = $request->count_woman;
            $roomCommonsModel->count_child = $request->count_child;
            $roomCommonsModel->save();
        }
        // step 2
        $buffer = explode(',', $request->select_array1);
        $position = serialize($buffer);
        // fill record
        $hostModel->province_id = $request->province_id;
        $hostModel->township_id = $request->township_id;
        $hostModel->district = $request->district;
        $hostModel->address = $request->address;
        $hostModel->position_array = $position;
        $hostModel->latitude = $request->latitude;
        $hostModel->longitude = $request->longitude;
        // step 3
        $hostModel->standard_guest = $request->standard_guest;
        $hostModel->count_guest = $request->count_guest;
        $hostModel->count_room = $request->count_room;
        $hostModel->count_toilet = $request->count_toilet;
        $hostModel->count_bathroom = $request->count_bathroom;
        $hostModel->count_traditional_bed = $request->count_traditional_bed;
        $hostModel->single_bed = $request->count_single_bed;
        $hostModel->double_bed = $request->count_double_bed;
        $Room = json_decode($request->rooms);
        Room::where('host_id', $hostModel->id)->delete();
        if (count($Room) > 0) {
            foreach ($Room as $key => $value) {
                $data1[] = [
                    'host_id' => $request->host_id,
                    'single_beds' => $value[1],
                    'double_beds' => $value[0],
                    'toilet_bathroom' => $value[2],
                    'active' => 1,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
            }
            DB::table('rooms')->insert($data1);
        }
        // step 4
        HostPossibilities::where('host_id', $hostModel->id)->delete();
        $buffer1 = explode(',', $request->select_array2);
        $buffer2 = explode(',', $request->description_array);
        foreach ($buffer1 as $key => $value) {
            $data2[] = [
                'host_id' => $hostModel->id,
                'option_id' => $buffer1[$key],
                'description' => $buffer2[$key],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }
        DB::table('host_possibilities')->insert($data2);
        // step 5
        $hostModel->time_enter = $request->time_enter;
        $hostModel->time_exit = $request->time_exit;
        $hostModel->min_reserve_day = $request->min_reserve;
        $hostModel->new_rule = $request->new_rule;
        HostRules::where('host_id', $hostModel->id)->delete();
        $buffer2 = explode(',', $request->select_array3);
        if (!empty($buffer2)) {
            foreach ($buffer2 as $key => $value) {
                $data3[] = [
                    'host_id' => $hostModel->id,
                    'rule_id' => $buffer2[$key],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
            }
            DB::table('host_rules')->insert($data3);
        }
        // step 6
        $i = 1;

        foreach ($request->all() as $key => $value) {
            if (!($key == 'price_saturday' || $key == 'price_sunday' || $key == 'price_monday' || $key == 'price_tuesday' || $key == 'price_wednesday' || $key == 'price_thursday' || $key == 'price_friday')) {
                continue;
            }
            $price = str_replace(',', '', $value);
            if(!is_numeric($price)) {
                $Response = ["Success" => "0", "Message" => "قیمت باید به صورت عدد وارد شود"];
                return response()->json($Response);
            }
//            if($price < 10000 || $price > 100000000) {
//                $Response = ["Success" => "0", "Message" => "قیمت باید بین 10000 تا 10000000 تومان باشد"];
//                return response()->json($Response);
//            }
            $data4[] = [
                'host_id' => $request->host_id,
                'week_id' => $i,
                'price' => $price,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            $i++;
        }
        PriceDay::where('host_id', $hostModel->id)->delete();
        DB::table('price_days')->insert($data4);
        $specialPrice = str_replace(',', '', $request->special_price);
        $onePersonPrice = str_replace(',', '', $request->one_person_price);
        $hostModel->closest_time_reserve = $request->closest_time_reserve;
        $hostModel->percent_instantaneous = $request->percent_instantaneous;
        $hostModel->special_price = $specialPrice;
        $hostModel->one_person_price = $onePersonPrice;
        // step 7
        $hostModel->name = $request->host_name;
        $hostModel->description = $request->description;
        $hostModel->cancel_rule_id = 0;

        $hostModel->status = 0;
        if ($hostModel->save()) {
            $Response = ["Success" => "1", "Message" => "اطلاعات با موفیقیت ذخیره شد، پس از بررسی کارشناسان آگهی شما در سایت گذاشته خواهد شد"];
            return response()->json($Response);
        } else {
            $Response = ["Success" => "0", "Message" => "خطا در ثبت اطلاعات"];
            return response()->json($Response);
        }

    }

    /*******************
     * Edit Step Host
     ******************/
    public function EditStep(Request $request)
    {
        $hostModel = Host::where('id', $request->host_id)
            ->where('step', '!=', 100)
            ->where('user_id', auth()->user()->id)
            ->first();
        if (empty($hostModel)) {
            $Response = ["Success" => "1", "Message" => "اقامتگاه مورد نظر یافت نشد ."];
            return response()->json($Response);
        }
        if($request->step == 1) {
            if($hostModel->step >= 1) {
                $galleryModel = Gallery::where('host_id', $hostModel->id)->get();
                $roomCommonsModel = RoomCommons::where('host_id', $hostModel->id)->orderBy('id', 'DESC')->first();
                $Response = ["Success" => "1", "Message" => response()->json(view('Host::editStep.editStep1', compact(
                    'hostModel',
                    'galleryModel',
                    'roomCommonsModel'
                ))->render())];
                return response()->json($Response);
            }
        } else if($request->step == 2) {
            if($hostModel->step >= 2) {
                $provinceModel = Province::where('country_id', 114)->where('active', 1)->get();
                $townshipModel = Township::where('province_id', $hostModel->province_id)->get();
                $Response = ["Success" => "1", "Message" => response()->json(view('Host::editStep.editStep2', compact(
                    'hostModel',
                    'provinceModel',
                    'townshipModel'
                ))->render())];
                return response()->json($Response);
            }
        } else if($request->step == 3) {
            if($hostModel->step >= 3) {
                $roomModel = Room::where('host_id', $hostModel->id)->get();
                $Response = ["Success" => "1", "Message" => response()->json(view('Host::editStep.editStep3', compact(
                    'hostModel',
                    'roomModel'
                ))->render())];
                return response()->json($Response);
            }
        } else if($request->step == 4) {
            if($hostModel->step >= 4) {
                $hostPossibilitiesModel = HostPossibilities::where('host_id', $hostModel->id)->get();
                foreach ($hostPossibilitiesModel as $key => $value) {
                    $arr_option[] = $value->option_id;
                }
                $Response = ["Success" => "1", "Message" => response()->json(view('Host::editStep.editStep4', compact(
                    'hostModel',
                    'arr_option'
                ))->render())];
                return response()->json($Response);
            }
        } else if($request->step == 5) {
            if($hostModel->step >= 5) {
                $hostRuleModel = HostRules::where('host_id', $hostModel->id)->get();
                foreach ($hostRuleModel as $key => $value) {
                    $arr_rule[] = $value->rule_id;
                }
                $Response = ["Success" => "1", "Message" => response()->json(view('Host::editStep.editStep5', compact(
                    'hostModel',
                    'arr_rule'
                ))->render())];
                return response()->json($Response);
            }
        } else if($request->step == 6) {
            if($hostModel->step >= 6) {
                $priceDayModel = PriceDay::where('host_id', $hostModel->id)->get();
                $weekModel = Week::where('active', 1)->get();
                $Response = ["Success" => "1", "Message" => response()->json(view('Host::editStep.editStep6', compact(
                    'hostModel',
                    'priceDayModel',
                    'weekModel'
                ))->render())];
                return response()->json($Response);
            }
        }
    }

    /*******************
     * Update Step Host
     ******************/

    public function UpdateHostStep(Request $request) {
//        return $request->all();
        $hostModel = Host::where('id', $request->host_id)->first();
        if($request->step == 1) {
            $Message = [
                'host_id.required' => 'فیلد آی دی آگهی نمیتواند خالی باشد',
                'home_type_id.required' => 'فیلد نوع خانه نمیتواند خالی باشد',
                'building_type_id.required' => 'فیلد نوع ساختمان نمیتواند خالی باشد',
                'meter.required' => 'فیلد متراژ نمیتواند خالی باشد',
                'meter_total.required' => 'فیلد متراژ کل نمیتواند خالی باشد',
                'shared_yard.required' => 'فیلد حیاط مشترک نمیتواند خالی باشد',
                'count_man.required' => 'فیلد تعداد مرد نمیتواند خالی باشد',
                'count_woman.required' => 'فیلد تعداد زن نمیتواند خالی باشد',
                'count_child.required' => 'فیلد تعداد بچه نمیتواند خالی باشد',
            ];
            $validator = Validator::make($request->all(),
                [
                    'host_id' => 'required',
                    'home_type_id' => 'required',
                    'building_type_id' => 'required',
                    'meter' => 'required',
                    'meter_total' => 'required',
                    'shared_yard' => 'required',
                    'count_man' => 'required',
                    'count_woman' => 'required',
                    'count_child' => 'required',
                ],
                $Message);
            if ($validator->fails()) {
                $errors = $validator->errors();
                $Response = ["Success" => "0", "Message" => $errors->first()];
                return response()->json($Response);
            }
            $galleryModel = Gallery::where('host_id', $request->host_id)->first();
            if (empty($galleryModel)) {
                $Response = ["Success" => "0", "Message" => "وارد کردن حداقل یک عکس الزامی می باشد"];
                return response()->json($Response);
            }
            $hostModel->home_type_id = $request->home_type_id;
            $hostModel->building_type_id = $request->building_type_id;
            $hostModel->meter = $request->meter;
            $hostModel->meter_total = $request->meter_total;
            $hostModel->shared_yard = $request->shared_yard;
            // check room common after update host record
            $roomCommonsModel_check = RoomCommons::where('host_id', $request->host_id)->first();
            if (!empty($roomCommonsModel_check)) {
                RoomCommons::where('host_id', $request->host_id)->delete();
            }
            if ($request->home_type_id == 2 || $request->home_type_id == 3) // common room
            {
                $roomCommonsModel = new RoomCommons();
                $roomCommonsModel->host_id = $request->host_id;
                $roomCommonsModel->count_man = $request->count_man;
                $roomCommonsModel->count_woman = $request->count_woman;
                $roomCommonsModel->count_child = $request->count_child;
                $roomCommonsModel->save();
            }
            if ($hostModel->save()) {
                $Response = ["Success" => "1", "Message" => "Success"];
                return response()->json($Response);
            } else {
                $Response = ["Success" => "0", "Message" => "خطا در ثبت اطلاعات"];
                return response()->json($Response);
            }
        }
        elseif ($request->step == 2) {
//            return $request->all();
            $Message = [
                'host_id.required' => 'فیلد آی دی آگهی نمیتواند خالی باشد',
                'province_id.required' => 'فیلد استان نمیتواند خالی باشد',
                'township_id.required' => 'فیلد شهرستان نمیتواند خالی باشد',
                'district.required' => 'فیلد محله نمیتواند خالی باشد',
                'address.required' => 'فیلد آدرس نمیتواند خالی باشد',
                'select_array.required'=>'حداقل انتخاب یکی از فیلد های موقعیت اجباری میباشد',
                'latitude.required' => 'مختصات نقشه نمیتواند خالی باشد',
                'longitude.required' => 'مختصات نقشه نمیتواند خالی باشد',
            ];
            $validator = Validator::make($request->all(),
                [
                    'host_id' => 'required',
                    'province_id' => 'required',
                    'township_id' => 'required',
                    'district' => 'required',
                    'address' => 'required',
                    'select_array' => 'required',
                    'latitude' => 'required',
                    'longitude' => 'required',
                ],
                $Message);
            if ($validator->fails()) {
                $errors = $validator->errors();
                $Response = ["Success" => "0", "Message" => $errors->first()];
                return response()->json($Response);
            }

            $buffer = explode(',', $request->select_array);
            $position = serialize($buffer);
            // fill record
            $hostModel->province_id = $request->province_id;
            $hostModel->township_id = $request->township_id;
            $hostModel->district = $request->district;
            $hostModel->address = $request->address;
            $hostModel->position_array = $position;
            $hostModel->latitude = $request->latitude;
            $hostModel->longitude = $request->longitude;
            if ($hostModel->save()) {
                $Response = ["Success" => "1", "Message" => "Success"];
                return response()->json($Response);
            } else {
                $Response = ["Success" => "0", "Message" => "خطا در ثبت اطلاعات"];
                return response()->json($Response);
            }

        }
        elseif ($request->step == 3) {

            $Message = [
                'host_id.required' => 'فیلد آی دی آگهی نمیتواند خالی باشد',
                'count_guest.required' => 'وارد کردن تعداد میهمان اجباری است',
                'count_room.required' => 'وارد کردن تعداد اتاق خواب اجباری است',
                'count_toilet.required' => 'وارد کردن تعداد سرویس بهداشتی اجباری است',
                'count_bathroom.required' => 'وارد کردن تعداد حمام اجباری است',
            ];
            $validator = Validator::make($request->all(),
            [
                'host_id' => 'required',
                'count_guest' => 'required',
                'count_room' => 'required',
                'count_toilet' => 'required',
                'count_bathroom' => 'required',
            ],
            $Message);
            if ($validator->fails()) {
                $errors = $validator->errors();
                $Response = ["Success" => "0", "Message" => $errors->first()];
                return response()->json($Response);
            }

            $hostModel->standard_guest = $request->standard_guest;
            $hostModel->count_guest = $request->count_guest;
            $hostModel->count_room = $request->count_room;
            $hostModel->count_toilet = $request->count_toilet;
            $hostModel->count_bathroom = $request->count_bathroom;
            $hostModel->count_traditional_bed = $request->count_traditional_bed;
            $hostModel->single_bed = $request->count_double_bed;
            $hostModel->double_bed = $request->count_single_bed;
            $Room = json_decode($request->rooms);
            Room::where('host_id', $hostModel->id)->delete();
            if (count($Room) > 0) {
                foreach ($Room as $key => $value) {
                    $data[] = [
                        'host_id' => $request->host_id,
                        'single_beds' => $value[1],
                        'double_beds' => $value[0],
                        'toilet_bathroom' => $value[2],
                        'active' => 1,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ];
                }
                DB::table('rooms')->insert($data);
            }
            if ($hostModel->save()) {
                $Response = ["Success" => "1", "Message" => "Success"];
                return response()->json($Response);
            } else {
                $Response = ["Success" => "0", "Message" => "خطا در ثبت اطلاعات"];
                return response()->json($Response);
            }
        }
        elseif ($request->step == 4) {
            $Message = [
                'host_id.required' => 'فیلد آی دی آگهی نمیتواند خالی باشد',
                'select_array.required' => 'انتخاب حداقل یک مورد از فیلد های زیر اجباری است',
            ];
            $validator = Validator::make($request->all(),
                [
                    'host_id' => 'required',
                    'select_array' => 'required',
                ],
                $Message);
            if ($validator->fails()) {
                $errors = $validator->errors();
                $Response = ["Success" => "0", "Message" => $errors->first()];
                return response()->json($Response);
            }
            HostPossibilities::where('host_id', $hostModel->id)->delete();
            $buffer = explode(',', $request->select_array);
            foreach ($buffer as $key => $value) {
                $data[] = [
                    'host_id' => $hostModel->id,
                    'option_id' => $buffer[$key],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
            }
            DB::table('host_possibilities')->insert($data);

            $Response = ["Success" => "1", "Message" => "Success"];
            return response()->json($Response);
        }
        elseif ($request->step == 5) {
            $Message = [
                'host_id.required' => 'فیلد آی دی آگهی نمیتواند خالی باشد',
                'time_enter.required' => 'وارد کردن ساعت ورود اجباری است',
                'time_exit.required' => 'وارد کردن ساعت خروج اجباری است',
                'min_reserve.required' => 'وارد کردن حداقل تعداد روز رزرو اجباری است',
                'select_array.required' => 'انتخاب حداقل یک فیلد از قوانین اجباری است',
            ];
            $validator = Validator::make($request->all(),
                [
                    'host_id' => 'required',
                    'time_enter' => 'required',
                    'time_exit' => 'required',
                    'min_reserve' => 'required',
                    'select_array' => 'required',
                ],
                $Message);
            if ($validator->fails()) {
                $errors = $validator->errors();
                $Response = ["Success" => "0", "Message" => $errors->first()];
                return response()->json($Response);
            }

            $hostModel->time_enter = $request->time_enter;
            $hostModel->time_exit = $request->time_exit;
            $hostModel->min_reserve_day = $request->min_reserve;
            $hostModel->new_rule = $request->new_rule;
            HostRules::where('host_id', $hostModel->id)->delete();
            $buffer = explode(',', $request->select_array);
            if (!empty($buffer)) {
                foreach ($buffer as $key => $value) {
                    $data[] = [
                        'host_id' => $hostModel->id,
                        'rule_id' => $buffer[$key],
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ];
                }
                DB::table('host_rules')->insert($data);
            }
            if ($hostModel->save()) {
                $Response = ["Success" => "1", "Message" => "Success"];
                return response()->json($Response);
            } else {
                $Response = ["Success" => "0", "Message" => "خطا در ثبت اطلاعات"];
                return response()->json($Response);
            }
        }
        elseif ($request->step == 6) {
            $Message = [
                'host_id.required' => 'فیلد آی دی آگهی نمیتواند خالی باشد',
                'price_saturday.required' => 'وارد کردن قیمت روز شنبه اجباری است',
                'price_sunday.required' => 'وارد کردن قیمت روز یک شنبه اجباری است',
                'price_monday.required' => 'وارد کردن قیمت روز دوشنبه اجباری است',
                'price_tuesday.required' => 'وارد کردن قیمت روز سه شنبه اجباری است',
                'price_wednesday.required' => 'وارد کردن قیمت روز چهارشنبه اجباری است',
                'price_thursday.required' => 'وارد کردن قیمت روز پنج شنبه اجباری است',
                'price_friday.required' => 'وارد کردن قیمت روز جمعه اجباری است',
                'price_special_day.required' => 'وارد کردن قیمت روز خاص تقویم اجباری است',
            ];
            $validator = Validator::make($request->all(),
                [
                    'host_id' => 'required',
                    'price_saturday' => 'required',
                    'price_sunday' => 'required',
                    'price_monday' => 'required',
                    'price_tuesday' => 'required',
                    'price_wednesday' => 'required',
                    'price_thursday' => 'required',
                    'price_friday' => 'required',
                    'price_special_day' => 'required',
                ],
                $Message);
            if ($validator->fails()) {
                $errors = $validator->errors();
                $Response = ["Success" => "0", "Message" => $errors->first()];
                return response()->json($Response);
            }
            $i = 1;
            PriceDay::where('host_id', $hostModel->id)->delete();
            foreach ($request->all() as $key => $value) {
                if ($key == 'host_id' || $key == 'step' || $key == 'closest_time_reserve') {
                    continue;
                }

                $data[] = [
                    'host_id' => $request->host_id,
                    'week_id' => $i,
                    'price' => $value,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                $i++;
            }
            DB::table('price_days')->insert($data);

            $priceSpecial = str_replace(',', '', $request->price_special_day);
            $hostModel->closest_time_reserve = $request->closest_time_reserve;
            $hostModel->percent_instantaneous = $request->percent_instantaneous;
            $hostModel->special_price = $priceSpecial;
            if ($hostModel->save()) {
                $Response = ["Success" => "1", "Message" => "Success"];
                return response()->json($Response);
            } else {
                $Response = ["Success" => "0", "Message" => "خطا در ثبت اطلاعات"];
                return response()->json($Response);
            }
        }
    }
    /******************
     * Price Set Type
     *****************/

    public function PriceSetType(Request $request)
    {
        if ($request->type == 0) {
            return response()->json(view('Host::Ajax.AjaxNormalPrice')->render());
        } else {
            return response()->json(view('Host::Ajax.AjaxAdvancePrice')->render());
        }
    }

    /****************
     * Index Blocked Days
     ***************/
    public function IndexBlockedDays() {
        $hostModel = Host::where('user_id', auth()->user()->id)->where('step', 100)->get();
        $blockedDayModel = BlockedDay::with('getHost')->whereHas('getHost', function ($Q) {
            $Q->where('step', 100);
            $Q->where('user_id', auth()->user()->id);
        })->orderBy('host_id')->orderBy('date')->get();
        return view('Host::blockedDay.indexBlockedDay', compact('blockedDayModel', 'hostModel'));
    }
    /****************
     * Store Blocked Days
     ***************/
    public function StoreBlockedDays(Request $request) {
        $Message=[
            'host_id.required'=>'نام اقامتگاه نمیتواند خالی باشد .',
            'date.required'=>'تاریخ نمیتواند خالی باشد .',
        ];
        $this->validate($request,[
            'host_id' => 'required|numeric',
            'date' => 'required',
        ],$Message);
        $hostModel = Host::where('id' ,$request->host_id)
            ->where('step', 100)
            ->where('user_id', auth()->user()->id)->first();
        if(empty($hostModel))
        {
            PrintMessage('اقامتگاه مورد نظر یافت نشد .', 'danger');
            return back();
        }
        $dateTime = jDateTime::ConvertToGeorgian($request->date,date('H:i:s'));
        $buffer = explode(' ', $dateTime);
        $BlockedDayTime = $buffer[0].' 00:00:00';
        $blockedDayModel = BlockedDay::where('host_id', $request->host_id)->where('date', $BlockedDayTime)->first();
        if(!empty($blockedDayModel))
        {
            PrintMessage('تاریخ مورد نظر قبلا در سیستم ثبت شده است .', 'danger');
            return back();
        }
        $blockedDayModel = new BlockedDay();
        $blockedDayModel->host_id = $request->host_id;
        $blockedDayModel->date = $BlockedDayTime;
        if($blockedDayModel->save())
        {
            PrintMessage('ثبت تاریخ موفقیت آمیز بود.','success');
            return back();
        }
        else
        {
            PrintMessage('ثبت تاریخ موفقیت آمیز نبود.','danger');
            return back();
        }
    }
    /****************
     * Delete BlockedDays
     ***************/
    public function DeleteBlockedDays($id) {
        $blockedDayModel = BlockedDay::where('id', $id)->first();
        return response()->json(view('Host::Ajax.AjaxDeleteBlockedDays',compact('blockedDayModel'))->render());
    }
    /****************
     * BlockedDays Delete
     ***************/
    public function BlockedDaysDelete(Request $request) {
        $blockedDayModel = BlockedDay::with('getHost')
            ->whereHas('getHost', function ($Query){
                $Query->where('user_id', auth()->user()->id);
            })
            ->where('id', $request->blocked_days_id)
            ->first();
        if(!empty($blockedDayModel))
        {
            $blockedDayModel->delete();
            PrintMessage('حذف تاریخ موفقیت آمیز بود.','info');
            return back();
        } else
        {
            PrintMessage('عملیات حذف موفقیت آمیز نبود.','danger');
            return back();
        }
    }
    public function BlockedDays(Request $request)
    {
        $dateTime = jDateTime::ConvertToGeorgian($request->date, date('H:i:s'));
        $buffer = explode(' ', $dateTime);
        $blockedTime = $buffer[0] . ' 00:00:00';
        $blockedDayModel = BlockedDay::where('host_id', $request->host_id)->where('date', $blockedTime)->first();
        if (!empty($blockedDayModel)) {
            $Response = ["Success" => "0", "Message" => "تاریخ مورد نظر قبلا در سیستم ثبت شده است ."];
            return response()->json($Response);
        }
        $blockedDayModel = new BlockedDay();
        $blockedDayModel->host_id = $request->host_id;
        $blockedDayModel->date = $blockedTime;
        if ($blockedDayModel->save()) {
            $blockedDay = DB::table('blocked_days')->select('date')->where('host_id', $request->host_id)->get();
            $date = array();
            foreach ($blockedDay as $key => $value) {
                $buffer = explode(' ', $value->date);
                $dateJalali = jDate::forge($buffer[0])->format('Y-m-d');
                $date[] = $dateJalali;
                $buffer = null;
            }

            $Response = ["Success" => "1", "Message" => "مسدود سازی با موفقیت انجام شد .", "Date" => $date];
            return response()->json($Response);
        } else {
            $Response = ["Success" => "0", "Message" => "عدم موفقیت در ثبت اطلاعات ، لطقا مجددا تلاش نمایید ."];
            return response()->json($Response);
        }
    }

    public function GetBlockedDays(Request $request)
    {
        $blockedDay = DB::table('blocked_days')->select('date')->where('host_id', $request->host_id)->get();
        $date = array();
        foreach ($blockedDay as $key => $value) {
            $buffer = explode(' ', $value->date);
            $date[] = $buffer[0];
            $buffer = null;
        }
        return $date;
    }

    public function GetBlockedDaysAndReserveDays(Request $request)
    {
        $blockedDay = DB::table('blocked_days')->select('date')->where('host_id', $request->host_id)->get();
        $reserveDay = DB::table('reserves')->select('reserve_date')->where('host_id', $request->host_id)
            ->where('status', 0)->get();
        $reserveDayUser = DB::table('reserves')->select('reserve_date')
            ->where('host_id', $request->host_id)
            ->where('user_id', auth()->user()->id)->get();
        $date = array();
        foreach ($blockedDay as $key => $value) {
            $buffer = explode(' ', $value->date);
            $date[] = jDate::forge($buffer[0])->format('Y-m-d');
            $buffer = null;
        }
        foreach ($reserveDay as $key => $value) {
            $buffer = explode(' ', $value->reserve_date);
            $date[] = jDate::forge($buffer[0])->format('Y-m-d');
            $buffer = null;
        }
        foreach ($reserveDayUser as $key => $value) {
            $buffer = explode(' ', $value->reserve_date);
            $date[] = jDate::forge($buffer[0])->format('Y-m-d');
            $buffer = null;
        }
        return $date;
    }

    /**
     * Active Host
     */
    public function ActiveHost($id)
    {
        $hostModel = Host::where('id', $id)->first();
        if ($hostModel->active == 1) {
            Host::where('id', $id)
                ->update(['active' => 0]);
            return 'deactive';
        } elseif ($hostModel->active == 0) {
            Host::where('id', $id)
                ->update(['active' => 1]);
            return 'active';
        }
    }

    /**
     * Active Integrated
     */
    public function ActiveIntegrated($id)
    {
        $integratedModel = Integrated::where('id', $id)->first();
        if ($integratedModel->active == 1) {
            $integratedModel->active = 0;
            $integratedModel->save();
            return 'deactive';
        } elseif ($integratedModel->active == 0) {
            $integratedModel->active = 1;
            $integratedModel->save();
            return 'active';
        }
    }

    /**
     * Delete Host
     */
    public function DeleteHost($id)
    {
        $hostModel = Host::where('id', $id)->where('user_id', auth()->user()->id)->first();
        if(empty($hostModel)) {
            abort(404);
        }
        if ($hostModel->is_deleted == 0) {
            Host::where('id', $id)
                ->update(['is_deleted' => 1]);
            PrintMessage('عملیات حذف موفقیت آمیز بود', 'success');
            return back();
        } elseif ($hostModel->is_deleted == 1) {
//            Host::where('id', $id)
//                ->update(['active' => 1]);
//            PrintMessage();
            return back();
        }
    }

    /**
     * Status Host
     * Update host status by admin in index/host/all page
     */
    public function StatusHost($id, $status)
    {
            Host::where('id', $id)
                ->update(['status' => $status]);
            return 'success';
    }

    /**
     * Status Host Send Sms
     */
    public function StatusHostSendSms($id)
    {
        $hostModel = Host::where('id', $id)->first();
        $userModel = User::where('id', $hostModel->user_id)->first();
        SmsController::SendSMSSuccessConfirmHost($userModel->mobile);
        return 'success';
    }
    /**
     *            *       *           *             *                       *                       *
     *     *                                                                                                  *
     *                 *                *         PRICE DAY      *             *             *
     *        *
     *                           *            *              *                      *                   *
     */
    /**
     * Index Price Day
     */
    public function IndexPriceDay()
    {
        $hostModel = Host::where('user_id', auth()->user()->id)->where('step', 100)->get();
        return view('Host::price.indexPriceDay', compact('hostModel'));
    }

    /**
     * Index Price Day
     */
    public function GetPriceDay(Request $request)
    {
        $priceDayModel = PriceDay::where('host_id', $request->id)->get();
        $weekModel = Week::where('active', 1)->get();
        return response()->json(view('Host::Ajax.AjaxGetPrice', compact('priceDayModel', 'weekModel'))->render());
    }

    /**
     * Update Host Price
     */
    public function UpdatePriceHost(Request $request)
    {
//        dd($request->all());
        $Message = [
            'host_id.required' => 'اقامتگاه خالی باشد .',
            'Saturday.required' => 'قیمت شنبه نمیتواند خالی باشد .',
            'Saturday.numeric' => 'قیمت باید یک عدد صحیح باشد .',
            'Saturday.min' => 'قیمت باید حداقل 100000  ریال باشد .',
            'Sunday.required' => 'قیمت یکشنبه نمیتواند خالی باشد .',
            'Sunday.numeric' => 'قیمت باید یک عدد صحیح باشد .',
            'Sunday.min' => 'قیمت باید حداقل1000006  ریال باشد .',
            'Monday.required' => 'قیمت دوشنبه نمیتواند خالی باشد .',
            'Monday.numeric' => 'قیمت باید یک عدد صحیح باشد .',
            'Monday.min' => 'قیمت باید حداقل1000006  ریال باشد .',
            'Tuesday.required' => 'قیمت سه شنبه نمیتواند خالی باشد .',
            'Tuesday.numeric' => 'قیمت باید یک عدد صحیح باشد .',
            'Tuesday.min' => 'قیمت باید حداقل 100000  ریال باشد .',
            'Wednesday.required' => 'قیمت چهارشنبه نمیتواند خالی باشد .',
            'Wednesday.numeric' => 'قیمت باید یک عدد صحیح باشد .',
            'Wednesday.min' => 'قیمت باید حداقل 100000  ریال باشد .',
            'Thursday.required' => 'قیمت پنج شنبه نمیتواند خالی باشد .',
            'Thursday.numeric' => 'قیمت باید یک عدد صحیح باشد .',
            'Thursday.min' => 'قیمت باید حداقل 100000  ریال باشد .',
            'Friday.required' => 'قیمت جمعه نمیتواند خالی باشد .',
            'Friday.numeric' => 'قیمت باید یک عدد صحیح باشد .',
            'Friday.min' => 'قیمت باید حداقل 100000  ریال باشد .',
        ];
        $this->validate($request, [
            'host_id' => 'required',
            'Saturday' => 'required|numeric|min:100000|max:100000000',
            'Sunday' => 'required|numeric|min:100000|max:100000000',
            'Monday' => 'required|numeric|min:100000|max:100000000',
            'Tuesday' => 'required|numeric|min:100000|max:100000000',
            'Wednesday' => 'required|numeric|min:100000|max:100000000',
            'Thursday' => 'required|numeric|min:100000|max:100000000',
            'Friday' => 'required|numeric|min:100000|max:100000000',
        ], $Message);
        $hostModel = Host::where('id', $request->host_id)
            ->where('user_id', auth()->user()->id)
            ->where('step', 100)
            ->first();
        if (empty($hostModel)) {
            PrintMessage('اقامتگاه مورد نظر یافت نشد', 'danger');
            return back();
        }
        PriceDay::where('host_id', $request->host_id)->delete();
        $i = 1;
        foreach ($request->all() as $key => $value) {
            if ($key == 'host_id' || $key == '_token') {
                continue;
            }
            $data_1[] = [
                'host_id' => $request->host_id,
                'week_id' => $i,
                'price' => $value,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            $i++;
        }
        DB::table('price_days')->insert($data_1);
        PrintMessage('ویرایش قیمت ها با موفقیت انجام شد', 'success');
        return back();
    }





    public function StoreDescriptionHost(Request $request) {
        $hostModel = Host::where('id', $request->host_id)->first();
        if(!empty($hostModel)) {
            $hostModel->description_admin = $request->description;
            $hostModel->save();
            PrintMessage('ثبت توضیحات موفقیت آمیز بود.', 'success');
            return back();
        } else {
            abort(404);
        }
    }




    public function IndexPersonalize($id) {
//        if(auth()->user()->id != 2) {
//            return 'در حال به روز رسانی';
//        }
        $hostModel = Host::where('id', $id)
            ->where('step', 100)
            ->where('user_id', auth()->user()->id)
            ->first();

        $discountModel = Discount::with('getHost')->whereHas('getHost', function ($Query) use ($id) {
            $Query->where('step', 100);
            $Query->where('id', $id);
            $Query->where('user_id', auth()->user()->id);
        })->get();

        $specialModel = Special::with('getHost')->whereHas('getHost', function ($Q) use ($id) {
            $Q->where('step', 100);
            $Q->where('id', $id);
            $Q->where('user_id', auth()->user()->id);
        })->get();

        $blockedDayModel = BlockedDay::with('getHost')->whereHas('getHost', function ($Q) use ($id) {
            $Q->where('step', 100);
            $Q->where('id', $id);
            $Q->where('user_id', auth()->user()->id);
        })->orderBy('host_id')->orderBy('date')->get();

        /*************  Calendar  ************/

        $nowYearJalali = jDate::forge(date("Y/m/d"))->format('Y'); // get now year
        $nowMonthJalali = jDate::forge(date("Y/m/d"))->format('m'); // get now month

        $first_date_month_jalali = ''.$nowYearJalali.'/'.$nowMonthJalali.'/01'; // get first day now month
        $month_model = Month::where('id', $nowMonthJalali)->first(); // get detail now month
        $last_date_month_jalali = ''.$nowYearJalali.'/'.$nowMonthJalali.'/'.$month_model->number_day; // get count day now month
//        $first_date_month_miladi = jDateTime::ConvertToGeorgian($first_date_month_jalali, date('H:i:s')); // change first day now month jalali to miladi(AD)
        $first_date_month_miladi = DateHelper::SolarToGregorian($first_date_month_jalali, '/', '/');

//        $last_date_month_miladi = jDateTime::ConvertToGeorgian($last_date_month_jalali, date('H:i:s')); // change last day now month jalali to miladi(AD)
        $last_date_month_miladi = DateHelper::SolarToGregorian($last_date_month_jalali, '/', '/');


        $first_date_month_miladi = explode(' ',$first_date_month_miladi); // put date to array for separate date and time
        $last_date_month_miladi = explode(' ',$last_date_month_miladi); // put date to array for separate date and time
        $first_date_month_miladi = $first_date_month_miladi[0].' 00:00:00'; // change time to 00:00:00
        $last_date_month_miladi = $last_date_month_miladi[0].' 00:00:00'; // change time to 00:00:00
        $special_date_model = SpecialDate::where('date', '>=', $first_date_month_miladi)
            ->where('date', '<=', $last_date_month_miladi)
            ->get();
        $holidays_now_month = array();
        foreach ($special_date_model as $key => $value) {
            $jalali_date = jDate::forge($value->date)->format('Y/m/d');
            $jalali_date = explode('/',$jalali_date);
            $holidays_now_month[] = $jalali_date[2];
        }
        // $holidays_now_month => this month's holidays [1, 8, 22, ...]
        list($year, $month, $day) = explode('/', ''.$nowYearJalali.'/'.$nowMonthJalali.'/01');
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
//        $first_day = jdate(date('Y/m/01', time()))->format('l');

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

        $specialDateModel = SpecialDate::all();

        
        $priceModel = PriceDay::where('host_id', $hostModel->id)->get();




        for ($i = 1; $i <= $monthModel->number_day; $i++) {
            $dayCalendarJalali = ''.$nowYearJalali.'/'.$nowMonthJalali.'/'.$i;
//            $dayCalendarMiladi = jDateTime::ConvertToGeorgian($dayCalendarJalali, date('00:00:00'));
            $dayCalendarMiladi = DateHelper::SolarToGregorian($dayCalendarJalali, '/', '/');

            $name_day = $week[$day_id];
            foreach ($priceModel as $key => $value) {
                if($value->week_id == $day_id) {
                    $priceDay = $value->price;
                }
            }
            foreach ($specialDateModel as $key => $value) {
                if($value->date == $dayCalendarMiladi) {
                    $priceDay = $hostModel->special_price;
                }
            }
            foreach ($specialModel as $key => $value) {
                if($value->date == $dayCalendarMiladi) {
                    $priceDay = $value->price;
                }
            }
            $blockDay = 0;
            foreach ($blockedDayModel as $key => $value) {
                if($value->date == $dayCalendarMiladi) {
                    $blockDay = 1;
                }
            }
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

//        dd($detailMonth);


        $calendar = view('Host::Ajax.CalendarPersonalize', compact(
            'detailMonth',
            'week',
            'holidays_now_month',
            'hostModel'
        ));

        /*********** End Calendar **********/


        return view('Host::indexPersonalize', compact(
            'discountModel',
            'hostModel',
            'specialModel',
            'blockedDayModel',
            'specialDateModel',
            'calendar'
        ));
    }


    public function CalendarChangeUserNext(Request $request)
    {
        $hostModel = Host::where('id', $request->host_id)
            ->where('step', 100)
            ->first();
        $id = $hostModel->id;
        $specialModel = Special::with('getHost')->whereHas('getHost', function ($Q) use ($id) {
            $Q->where('step', 100);
            $Q->where('id', $id);
        })->get();
        $blockedDayModel = BlockedDay::with('getHost')->whereHas('getHost', function ($Q) use ($id) {
            $Q->where('step', 100);
            $Q->where('id', $id);
        })->orderBy('host_id')->orderBy('date')->get();
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

        $holidays_now_month = array();

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

        $specialDateModel = SpecialDate::all();
        $priceModel = PriceDay::where('host_id', $hostModel->id)->get();
        for ($i = 1; $i <= $monthModel->number_day; $i++) {
            $dayCalendarJalali = ''.$year_now.'/'.$next_month.'/'.$i;
//            $dayCalendarMiladi = jDateTime::ConvertToGeorgian($dayCalendarJalali, date('00:00:00'));
            $dayCalendarMiladi = DateHelper::SolarToGregorian($dayCalendarJalali, '/', '/'). ' 00:00:00';
            $name_day = $week[$day_id];
            foreach ($priceModel as $key => $value) {
                if($value->week_id == $day_id) {
                    $priceDay = $value->price;
                }
            }
            foreach ($specialDateModel as $key => $value) {
                if($value->date == $dayCalendarMiladi) {
                    $priceDay = $hostModel->special_price;
                }
            }
            foreach ($specialModel as $key => $value) {
                if($value->date == $dayCalendarMiladi) {
                    $priceDay = $value->price;
                }
            }
            $blockDay = 0;
            foreach ($blockedDayModel as $key => $value) {
                if($value->date == $dayCalendarMiladi) {
                    $blockDay = 1;
                }
            }
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

        return response()->json(view('Host::Calendar.CalendarReserve', compact(
            'detailMonth',
            'week',
            'holidays_now_month',
            'hostModel'

        ))->render());



        /** Last Code */



//        $month_now = $request->num_month;
//        $year_now = $request->year;
//        $next_month = $month_now+1;
//        $day_id = $request->day_id+1;
//        if($day_id == 8) {
//            $day_id =1;
//        }
//        $first_day = $week[$day_id];
//        if($next_month == 13) {
//            $next_month = 1;
//            $year_now = $year_now + 1;
//        }
//
//
//        $nowYearJalali = $year_now; // get year
//        $nowMonthJalali = $next_month; // get next month
//
//        $first_date_month_jalali = ''.$nowYearJalali.'/'.$nowMonthJalali.'/01'; // get first day now month
//        $month_model = Month::where('id', $nowMonthJalali)->first(); // get detail now month
//        $last_date_month_jalali = ''.$nowYearJalali.'/'.$nowMonthJalali.'/'.$month_model->number_day; // get count day now month
//        $first_date_month_miladi = jDateTime::ConvertToGeorgian($first_date_month_jalali, date('H:i:s')); // change first day now month jalali to miladi(AD)
//        $last_date_month_miladi = jDateTime::ConvertToGeorgian($last_date_month_jalali, date('H:i:s')); // change last day now month jalali to miladi(AD)
//        $first_date_month_miladi = explode(' ',$first_date_month_miladi); // put date to array for separate date and time
//        $last_date_month_miladi = explode(' ',$last_date_month_miladi); // put date to array for separate date and time
//        $first_date_month_miladi = $first_date_month_miladi[0].' 00:00:00'; // change time to 00:00:00
//        $last_date_month_miladi = $last_date_month_miladi[0].' 00:00:00'; // change time to 00:00:00
//        $special_date_model = SpecialDate::where('date', '>=', $first_date_month_miladi)
//            ->where('date', '<=', $last_date_month_miladi)
//            ->get();
//        $holidays_now_month = array();
//        foreach ($special_date_model as $key => $value) {
//            $jalali_date = jDate::forge($value->date)->format('Y/m/d');
//            $jalali_date = explode('/',$jalali_date);
//            $holidays_now_month[] = $jalali_date[2];
//        }
//        // $holidays_now_month => this month's holidays [1, 8, 22, ...]
//
//        $monthModel = Month::where('id', $next_month)->first();
//        $detailMonth['start_day_month'] = array(
//            'name_day' => $first_day,
//            'day_id' => $day_id
//        );
//        $detailMonth['today'] = array(
//            'day_id' => $day_id,
//            'name_day' => $week[$day_id],
//            'name_month' => $monthModel->name,
//            'num_month' => $monthModel->id, // number month in year
//            'year' => $year_now,
//            'day' => 01
//        );
//
//        $specialDateModel = SpecialDate::all();
//        $priceModel = PriceDay::where('host_id', $hostModel->id)->get();
//        for ($i = 1; $i <= $monthModel->number_day; $i++) {
//            $dayCalendarJalali = ''.$year_now.'/'.$next_month.'/'.$i;
//            $dayCalendarMiladi = jDateTime::ConvertToGeorgian($dayCalendarJalali, date('00:00:00'));
//            $name_day = $week[$day_id];
//            foreach ($priceModel as $key => $value) {
//                if($value->week_id == $day_id) {
//                    $priceDay = $value->price;
//                }
//            }
//            foreach ($specialDateModel as $key => $value) {
//                if($value->date == $dayCalendarMiladi) {
//                    $priceDay = $hostModel->special_price;
//                }
//            }
//            foreach ($specialModel as $key => $value) {
//                if($value->date == $dayCalendarMiladi) {
//                    $priceDay = $value->price;
//                }
//            }
//            $blockDay = 0;
//            foreach ($blockedDayModel as $key => $value) {
//                if($value->date == $dayCalendarMiladi) {
//                    $blockDay = 1;
//                }
//            }
//            $detailMonth['detail_days'][] = array(
//                'day' => $i,
//                'day_id' => $day_id,
//                'name_day' => $name_day,
//                'price' => $priceDay,
//                'date' => $dayCalendarJalali,
//                'date_ad' => $dayCalendarMiladi,
//                'block_day' => $blockDay
//            );
//            $day_id++;
//            if ($day_id == 8) {
//                $day_id = 1;
//            }
//        }

    }


    public function CalendarChangeUserPrev(Request $request)
    {
        $hostModel = Host::where('id', $request->host_id)
            ->where('step', 100)
            ->first();
        $id = $hostModel->id;
        $specialModel = Special::with('getHost')->whereHas('getHost', function ($Q) use ($id) {
            $Q->where('step', 100);
            $Q->where('id', $id);
        })->get();
        $blockedDayModel = BlockedDay::with('getHost')->whereHas('getHost', function ($Q) use ($id) {
            $Q->where('step', 100);
            $Q->where('id', $id);
        })->orderBy('host_id')->orderBy('date')->get();
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
        $prev_month = $month_now-1;
        if($prev_month == 0) {
            $prev_month = 12;
            $year_now = $year_now - 1;
        }

        $monthModel = Month::where('id', $prev_month)->first();
        $day_id = $monthModel->first_day_id;
        $first_day = $week[$day_id];

        $holidays_now_month = array();

        $detailMonth['start_day_month'] = array(
            'name_day' => $first_day,
            'day_id' => $day_id
        );
        $now = Carbon::now();
        if(jdate($now)->format('m') == $prev_month) {
            $year = jdate($now)->format('Y');
            $day = jdate($now)->format('d');
        } else {
            $year = $year_now;
            $day = 01;
        }

        $detailMonth['today'] = array(
            'day_id' => $day_id,
            'name_day' => $week[$day_id],
            'name_month' => $monthModel->name,
            'num_month' => $monthModel->id, // number month in year
            'year' => $year,
            'day' => $day
        );


        $specialDateModel = SpecialDate::all();
        $priceModel = PriceDay::where('host_id', $hostModel->id)->get();
        for ($i = 1; $i <= $monthModel->number_day; $i++) {
            $dayCalendarJalali = ''.$year_now.'/'.$prev_month.'/'.$i;
//            $dayCalendarMiladi = jDateTime::ConvertToGeorgian($dayCalendarJalali, date('00:00:00'));
            $dayCalendarMiladi = DateHelper::SolarToGregorian($dayCalendarJalali, '/', '/'). ' 00:00:00';
            $name_day = $week[$day_id];
            foreach ($priceModel as $key => $value) {
                if($value->week_id == $day_id) {
                    $priceDay = $value->price;
                }
            }
            foreach ($specialDateModel as $key => $value) {
                if($value->date == $dayCalendarMiladi) {
                    $priceDay = $hostModel->special_price;
                }
            }
            foreach ($specialModel as $key => $value) {
                if($value->date == $dayCalendarMiladi) {
                    $priceDay = $value->price;
                }
            }
            $blockDay = 0;
            foreach ($blockedDayModel as $key => $value) {
                if($value->date == $dayCalendarMiladi) {
                    $blockDay = 1;
                }
            }
            /** check reserve in date */
            if (auth()->check()) {
                $reserveModelUser = Reserve::where('host_id', $hostModel->id)
                    ->where('reserve_date', $dayCalendarMiladi)
                    ->where('user_id', auth()->user()->id)
                    ->whereIn('status', array(1, 2))
                    ->first();
            } else {
                $reserveModelUser = Reserve::where('host_id', $hostModel->id)
                    ->where('reserve_date', $dayCalendarMiladi)
                    ->where('status', 0)
                    ->first();
            }
            if(!empty($reserveModelUser)) {
                if($reserveModelUser->reserve_date == $dayCalendarMiladi) {
                    $blockDay = 1;
                }
            }

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

        return response()->json(view('Host::Calendar.CalendarReserve', compact(
            'detailMonth',
            'week',
            'holidays_now_month',
            'hostModel'
        ))->render());

        /** Last Code */


//        $month_now = $request->num_month;
//        $year_now = $request->year;
//        $prev_month = $month_now-1;
//
//        if($prev_month == 0) {
//            $prev_month = 12;
//            $year_now = $year_now - 1;
//        }
//        $monthModel = Month::where('id', $prev_month)->first();
//        $day_id = $monthModel->first_day_id;
//        $first_day = $week[$day_id];
//
//        $nowYearJalali = $year_now; // get year
//        $nowMonthJalali = $prev_month; // get next month
//
//        $first_date_month_jalali = ''.$nowYearJalali.'/'.$nowMonthJalali.'/01'; // get first day now month
//        $month_model = Month::where('id', $nowMonthJalali)->first(); // get detail now month
//        $last_date_month_jalali = ''.$nowYearJalali.'/'.$nowMonthJalali.'/'.$month_model->number_day; // get count day now month
//        $first_date_month_miladi = jDateTime::ConvertToGeorgian($first_date_month_jalali, date('H:i:s')); // change first day now month jalali to miladi(AD)
//        $last_date_month_miladi = jDateTime::ConvertToGeorgian($last_date_month_jalali, date('H:i:s')); // change last day now month jalali to miladi(AD)
//        $first_date_month_miladi = explode(' ',$first_date_month_miladi); // put date to array for separate date and time
//        $last_date_month_miladi = explode(' ',$last_date_month_miladi); // put date to array for separate date and time
//        $first_date_month_miladi = $first_date_month_miladi[0].' 00:00:00'; // change time to 00:00:00
//        $last_date_month_miladi = $last_date_month_miladi[0].' 00:00:00'; // change time to 00:00:00
//        $special_date_model = SpecialDate::where('date', '>=', $first_date_month_miladi)
//            ->where('date', '<=', $last_date_month_miladi)
//            ->get();
//        $holidays_now_month = array();
//        foreach ($special_date_model as $key => $value) {
//            $jalali_date = jDate::forge($value->date)->format('Y/m/d');
//            $jalali_date = explode('/',$jalali_date);
//            $holidays_now_month[] = $jalali_date[2];
//        }
//        // $holidays_now_month => this month's holidays [1, 8, 22, ...]
//
//        $detailMonth['start_day_month'] = array(
//            'name_day' => $first_day,
//            'day_id' => $day_id
//        );
//        $now = Carbon::now();
//        if(jdate($now)->format('m') == $prev_month) {
//            $year = jdate($now)->format('Y');
//            $day = jdate($now)->format('d');
//        } else {
//            $year = $year_now;
//            $day = 01;
//        }
////        return $request->all();
//        $detailMonth['today'] = array(
//            'day_id' => $day_id,
//            'name_day' => $week[$day_id],
//            'name_month' => $monthModel->name,
//            'num_month' => $monthModel->id, // number month in year
//            'year' => $year,
//            'day' => $day
//        );
////        dd($detailMonth);
//
//        $specialDateModel = SpecialDate::all();
//        $priceModel = PriceDay::where('host_id', $hostModel->id)->get();
//        for ($i = 1; $i <= $monthModel->number_day; $i++) {
//            $dayCalendarJalali = ''.$year_now.'/'.$prev_month.'/'.$i;
//            $dayCalendarMiladi = jDateTime::ConvertToGeorgian($dayCalendarJalali, date('00:00:00'));
//            $name_day = $week[$day_id];
//            foreach ($priceModel as $key => $value) {
//                if($value->week_id == $day_id) {
//                    $priceDay = $value->price;
//                }
//            }
//            foreach ($specialDateModel as $key => $value) {
//                if($value->date == $dayCalendarMiladi) {
//                    $priceDay = $hostModel->special_price;
//                }
//            }
//            foreach ($specialModel as $key => $value) {
//                if($value->date == $dayCalendarMiladi) {
//                    $priceDay = $value->price;
//                }
//            }
//            $blockDay = 0;
//            foreach ($blockedDayModel as $key => $value) {
//                if($value->date == $dayCalendarMiladi) {
//                    $blockDay = 1;
//                }
//            }
//            /** check reserve in date */
//            if (auth()->check()) {
//                $reserveModelUser = Reserve::where('host_id', $hostModel->id)
//                    ->where('reserve_date', $dayCalendarMiladi)
//                    ->where('user_id', auth()->user()->id)
//                    ->whereIn('status', array(1, 2))
//                    ->first();
//            } else {
//                $reserveModelUser = Reserve::where('host_id', $hostModel->id)
//                    ->where('reserve_date', $dayCalendarMiladi)
//                    ->where('status', 0)
//                    ->first();
//            }
//            if(!empty($reserveModelUser)) {
//                if($reserveModelUser->reserve_date == $dayCalendarMiladi) {
//                    $blockDay = 1;
//                }
//            }
//
//            $detailMonth['detail_days'][] = array(
//                'day' => $i,
//                'day_id' => $day_id,
//                'name_day' => $name_day,
//                'price' => $priceDay,
//                'date' => $dayCalendarJalali,
//                'date_ad' => $dayCalendarMiladi,
//                'block_day' => $blockDay
//            );
//            $day_id++;
//            if ($day_id == 8) {
//                $day_id = 1;
//            }
//        }

//        dd($detailMonth);
//        return response()->json(view('Reserve::Calendar.Calendar', compact(
//            'detailMonth',
//            'week',
//            'holidays_now_month',
//            'hostModel'
//        ))->render());
    }



    public function HostFactor() {
        return view('Host::factor');
    }


    public function PishFactor($type) {
        return view('Host::pishfactor', compact('type'));
    }



    public function CreateIntegrated() {
        $provinceModel = Province::where('country_id', 114)->where('active', 1)->get();
        return view('Host::createIntegrated', compact('provinceModel'));
    }


    public function StoreIntegrated(Request $request) {

        $Message = [
            'title.required' => 'عنوان نمیتواند خالی باشد ',
            'count.required' => 'تعداد اقامتگاه نمیتواند خالی باشد',
            'count.numeric' => 'تعداد اقامتگاه باید به صورت عددی باشد',
            'count.min' => 'حداقل تعداد اقامتگاه 1 می باشد',
            'count.max' => 'حداکثر تعداد اقامتگاه 30 می باشد',
            'file.required' => 'تصویر مجتمع اقامتگاهی نمیتواند خالی باشد',
            'province_id.required' => 'استان نمیتواند خالی باشد',
            'township_id.required' => 'شهرستان نمیتواند خالی باشد',
            'district.required' => 'محله نمیتواند خالی باشد',
            'address.required' => 'آدرس نمیتواند خالی باشد',
            'building_type.required' => 'نوع کاربری نمیتواند خالی باشد',
            'position.required' => 'نوع منطقه نمیتواند خالی باشد',
            'latitude.required' => 'موقعیت نقشه نمیتواند خالی باشد',
            'longitude.required' => 'موقعیت نقشه نمیتواند خالی باشد',
        ];
        $this->validate($request, [
            'title' => 'required',
            'count' => 'required|numeric|min:1|max:30',
//            'file' => 'required',
            'province_id' => 'required',
            'township_id' => 'required',
            'district' => 'required',
            'address' => 'required',
            'building_type' => 'required',
            'position' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ], $Message);

        $position = serialize($request->position);


        $integratedModel = new Integrated();
        $integratedModel->user_id = auth()->user()->id;
        $integratedModel->title = $request->title;
        $integratedModel->count_host = $request->count;
        $integratedModel->description = $request->description;
        $integratedModel->latitude = $request->latitude;
        $integratedModel->longitude = $request->longitude;

        if($integratedModel->save()) {

            if($request->hasFile('file'))
            {
                $files = $request->file;
                foreach ($files as $key => $value)
                {
                    $image = Image::make($value)->resize(1200,700)->encode('jpg', 75);
                    $title = uniqid(time().rand(11111,99999)) . '.jpg';
                    if ($image->save('Uploaded/Gallery/Integrated/File' . '/' . $title)) {
                        $galleryModel = new GalleryIntegrated();
                        $galleryModel->integrated_id = $integratedModel->id;
                        $galleryModel->url = $title;
                        $galleryModel->save();
                    }
                }
            } else {
                $galleryModel = new GalleryIntegrated();
                $galleryModel->integrated_id = $integratedModel->id;
                $galleryModel->url = 'default-integrated.png';
                $galleryModel->save();
            }


            for($i = 0; $i<$request->count; $i++) {
                $hostModel = new Host();
                $hostModel->user_id = auth()->user()->id;
                $hostModel->name = $request->title.'-'.$i;
                $hostModel->province_id = $request->province_id;
                $hostModel->township_id = $request->township_id;
                $hostModel->district = $request->district;
                $hostModel->address = $request->address;
                $hostModel->building_type_id = $request->building_type;
                $hostModel->position_array = $position;
                $hostModel->latitude = $request->latitude;
                $hostModel->longitude = $request->longitude;
                $hostModel->integrated_id = $integratedModel->id;
                $hostModel->cancel_rule_id = 1;
                $hostModel->step = 100;
                if($hostModel->save()) {
                    $hostPossibilitiesModel = new HostPossibilities();
                    $hostPossibilitiesModel->host_id = $hostModel->id;
                    $hostPossibilitiesModel->option_id = 1;
                    $hostPossibilitiesModel->save();

                    $hostRuleModel = new HostRules();
                    $hostRuleModel->host_id = $hostModel->id;
                    $hostRuleModel->rule_id = 5;
                    $hostRuleModel->save();

                }
            }
            PrintMessage('ثبت مجتمع موفقیت آمیز بود، لطفا برای ویرایش اطلاعات اقامتگاه ها به "اقامتگاه های من" مراجعه کنید', 'success');
            return back();
        } else {
            PrintMessage('ثبت مجتمع موفقیت آمیز نبود، لطفا مجددا تلاش نمایید', 'danger');
            return back();
        }

        return view('Host::createIntegrated');
    }


    public function EditIntegrated($id) {
        $integratedModel = Integrated::where('id', $id)->first();
        if(auth()->user()->role_id != 1 && $integratedModel->user_id != auth()->user()->id) {
            return back();
        }
        if(!empty($integratedModel)) {
            $hostModel = Host::where('integrated_id', $integratedModel->id)->get();
            return view('Host::editIntegrated', compact('integratedModel', 'hostModel'));
        }
    }

    public function UpdateIntegrated(Request $request) {
        $integratedModel = Integrated::where('id', $request->integrated_id)->first();
        if(auth()->user()->role_id != 1 && $integratedModel->user_id != auth()->user()->id) {
            return back();
        }
        if(!empty($integratedModel)) {

            $integratedModel->title = $request->title;
            $integratedModel->description = $request->description;
            $integratedModel->latitude = $request->latitude;
            $integratedModel->longitude = $request->longitude;
            if($integratedModel->save()) {
                if($request->hasFile('file'))
                {
                    $files = $request->file;
                    foreach ($files as $key => $value)
                    {
                        $image = Image::make($value)->resize(1200,700)->encode('jpg', 75);
                        $title = uniqid(time().rand(11111,99999)) . '.jpg';
                        if ($image->save('Uploaded/Gallery/Integrated/File' . '/' . $title)) {
                            $galleryModel = new GalleryIntegrated();
                            $galleryModel->integrated_id = $integratedModel->id;
                            $galleryModel->url = $title;
                            $galleryModel->save();
                        }
                    }
                }
                PrintMessage('مجتمع با موفقیت ویرایش شد.', 'success');
            } else {
                PrintMessage('عدم موفقیت در ویرایش مجتمع، لطفا مجددا تلاش نمایید.', 'danger');
            }
        } else {
            PrintMessage('مجتمع یافت نشد.', 'danger');
            return back();
        }
        return back();
    }

    public function AddHostIntegrated($id) {
        $integratedModel = Integrated::where('id', $id)->where('user_id', auth()->user()->id)->first();
        $hostIntegratedModel = Host::where('integrated_id', $integratedModel->id)->first();
        $hostModel = new Host();
        $hostModel->user_id = $integratedModel->user_id;
        $hostModel->name = $hostIntegratedModel->name.'-'.rand(100000,999999);
        $hostModel->province_id = $hostIntegratedModel->province_id;
        $hostModel->township_id = $hostIntegratedModel->township_id;
        $hostModel->district = $hostIntegratedModel->district;
        $hostModel->address = $hostIntegratedModel->address;
        $hostModel->building_type_id = $hostIntegratedModel->building_type_id;
        $hostModel->position_array = $hostIntegratedModel->position_array;
        $hostModel->latitude = $hostIntegratedModel->latitude;
        $hostModel->longitude = $hostIntegratedModel->longitude;
        $hostModel->integrated_id = $integratedModel->id;
        $hostModel->cancel_rule_id = $hostIntegratedModel->cancel_rule_id;
        $hostModel->step = 100;
        if($hostModel->save()) {
            $hostPossibilitiesModel = new HostPossibilities();
            $hostPossibilitiesModel->host_id = $hostModel->id;
            $hostPossibilitiesModel->option_id = 1;
            $hostPossibilitiesModel->save();

            $hostRuleModel = new HostRules();
            $hostRuleModel->host_id = $hostModel->id;
            $hostRuleModel->rule_id = 5;
            $hostRuleModel->save();
        }
        return response()->json(view('Host::Ajax.AjaxNewHostIntegrated', compact('hostModel'))->render());
    }

    public function IndexHostIntegrated($id) {
        $integratedModel = Integrated::where('id', $id)->where('user_id', auth()->user()->id)->first();
        if(!empty($integratedModel)) {
            $hostModel = Host::where('integrated_id', $integratedModel->id)->orderBy('id', 'ASC')->get();
            if(count($hostModel) > 0) {
                $Response = ["Success" => "1", "Message" => response()->json(view('Host::Ajax.AjaxIndexHostIntegrated', compact('hostModel', 'integratedModel'))->render())];

                return response()->json($Response);
            } else {
                return ["Success" => "0", "Message" => "تعداد اقامتگاه های موجود صفر می باشد"];
            }
        } else {
            return ["Success" => "0", "Message" => "مجتمعی یافت نشد"];
        }
    }






    /***************************************************************************************************************
     ********************************************** * * * * * * * * ************************************************
     *********************************************  STATIC FUNCTION  ***********************************************
     ********************************************** * * * * * * * * ************************************************
     **************************************************************************************************************/

    public static function GetRangePrice() {
        $priceModel = DB::table('price_days')
            ->select('host_id', DB::raw('MAX(price) as max'))
            ->groupBy('host_id')
            ->get();
        $priceMax = array();
        $array_host_id = array();

        foreach ($priceModel as $key => $value) {
            $priceMax[] = $value->max;
        }
        sort($priceMax);

        $price['priceMax'] = $priceMax;
        $price['priceModel'] = $priceModel;

        $reserveFilter = DB::table('reserves')
            ->select('host_id', DB::raw('count(host_id) as count_reserve'))
            ->groupBy('host_id')
            ->get();



        foreach ($reserveFilter as $key => $value) {
            $array_host_id[] = $value->host_id;
        }

        $price['array_host_id'] = $array_host_id;


        if(count($priceModel) > 0) {
            return $price;
        } else {
            return 0;
        }
    }


    public function VisitedCity($id) {
        $townshipModel = Township::where('id', $id)->first();
        if(!empty($townshipModel)) {
            $hostModel = Host::where('status', 1)
                ->where('active', 1)
                ->where('step', 100)
                ->where('township_id', $townshipModel->id)
                ->with('getRate')
                ->with('getGallery')
                ->with('getPriceDay')
                ->take(10)
                ->orderBy('id', 'DESC')
                ->get();
            return view('frontend.Page.SearchHost', compact('hostModel', 'townshipModel'));
        } else {
            abort(404);
        }
    }




    function dateFiff($date1, $date2 , $num = false)
    {
        $date1 = date_create($date1);
        $date2 = date_create($date2);
        $diff = date_diff($date1, $date2);
        if ($diff->format("%a") < 0) {
            return 0;
        }
        else {
            return $diff->days;
        }
    }


    /**
     *ذخیره سازی ویرایش تقویم در پنل توسط میزبان
     */
    function StorePersonalizeHost(Request $request) {
//        return $request->all();
        if($request->type == 'special') {
            $date = array();
//            $dateTimeFrom = jDateTime::ConvertToGeorgian($request->date_from,date('H:i:s'));
            $dateTimeFrom = DateHelper::SolarToGregorian($request->date_from, '/', '/');

//            $dateTimeTo = jDateTime::ConvertToGeorgian($request->date_to,date('H:i:s'));
            $dateTimeTo = DateHelper::SolarToGregorian($request->date_to, '/', '/');

            $buffer1 = explode(' ', $dateTimeFrom);
            $buffer2 = explode(' ', $dateTimeTo);
            $SpecialDayTime1 = $buffer1[0].' 00:00:00';
            $SpecialDayTime2 = $buffer2[0].' 00:00:00';
            for($i = 0; $i <= $this->dateFiff($SpecialDayTime1, $SpecialDayTime2); $i++) {
                $specialDayModel = Special::where('host_id', $request->host_id)->where('date', date('Y-m-d H:i:s', strtotime($SpecialDayTime1 . ' +'.$i.' day')))->first();
                if(empty($specialDayModel)) {
                    $date[] = [
                        'host_id' => $request->host_id,
                        'date' => date('Y-m-d H:i:s', strtotime($SpecialDayTime1 . ' +' . $i . ' day')),
                        'price' => $request->price,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ];
                } else {
                    $specialDayModel->delete();
                    $date[] = [
                        'host_id' => $request->host_id,
                        'date' => date('Y-m-d H:i:s', strtotime($SpecialDayTime1 . ' +' . $i . ' day')),
                        'price' => $request->price,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ];
                }
            }
            if(DB::table('special_days')->insert($date)) {
                PrintMessage('ثبت قیمت موفقیت آمیز بود.','success');
            } else {
                PrintMessage('خطا در ثبت قیمت، لطفا مجددا تلاش نمایید.','success');
            }
        } else if($request->type == 'block') {
            $date = array();
//            $dateTimeFrom = jDateTime::ConvertToGeorgian($request->date_from,date('H:i:s'));
            $dateTimeFrom = DateHelper::SolarToGregorian($request->date_from, '/', '/');

//            $dateTimeTo = jDateTime::ConvertToGeorgian($request->date_to,date('H:i:s'));
            $dateTimeTo = DateHelper::SolarToGregorian($request->date_to, '/', '/');

            $buffer1 = explode(' ', $dateTimeFrom);
            $buffer2 = explode(' ', $dateTimeTo);
            $SpecialDayTime1 = $buffer1[0].' 00:00:00';
            $SpecialDayTime2 = $buffer2[0].' 00:00:00';
            for($i = 0; $i <= $this->dateFiff($SpecialDayTime1, $SpecialDayTime2); $i++) {
                $blockedDayModel = BlockedDay::where('host_id', $request->host_id)->where('date', date('Y-m-d H:i:s', strtotime($SpecialDayTime1 . ' +'.$i.' day')))->first();
                if(empty($blockedDayModel)) {
                    $date[] = [
                        'host_id' => $request->host_id,
                        'date' => date('Y-m-d H:i:s', strtotime($SpecialDayTime1 . ' +' . $i . ' day')),
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ];
                } else {
                    $blockedDayModel->delete();
                    $date[] = [
                        'host_id' => $request->host_id,
                        'date' => date('Y-m-d H:i:s', strtotime($SpecialDayTime1 . ' +' . $i . ' day')),
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ];
                }
            }
            if(DB::table('blocked_days')->insert($date)) {
                PrintMessage('ثبت تاریخ موفقیت آمیز بود.','success');
            } else {
                PrintMessage('خطا در ثبت تاریخ، لطفا مجددا تلاش نمایید.','success');
            }
        } else if($request->type == 'unblock') {
//            $dateTimeFrom = jDateTime::ConvertToGeorgian($request->date_from,date('H:i:s'));
            $dateTimeFrom = DateHelper::SolarToGregorian($request->date_from, '/', '/');

//            $dateTimeTo = jDateTime::ConvertToGeorgian($request->date_to,date('H:i:s'));
            $dateTimeTo = DateHelper::SolarToGregorian($request->date_to, '/', '/');

            $buffer1 = explode(' ', $dateTimeFrom);
            $buffer2 = explode(' ', $dateTimeTo);
            $blockedDayTime1 = $buffer1[0].' 00:00:00';
            $blockedDayTime2 = $buffer2[0].' 00:00:00';
            BlockedDay::where('date', '>=', $blockedDayTime1)->where('date', '<=', $blockedDayTime2)
                ->where('host_id', $request->host_id)->delete();
            PrintMessage('ثبت تغییرات در آزاد سازی موفقیت آمیز بود.','success');
        }
        return back();
    }


    /**
     * رزرو آنی در پنل میزبان
     */
    public function StoreClosestTimeReserve(Request $request) {

        $from_date = DateHelper::SolarToGregorian($request->from_date, '/');
        $from_date = $from_date .' 00:00:00';

        $to_date = DateHelper::SolarToGregorian($request->to_date, '/');
        $to_date = $to_date .' 00:00:00';
        $hostModel = Host::where('id', $request->host_id)->where('user_id', auth()->user()->id)->first();

        if(!empty($hostModel)) {
            InstantBooking::where('host_id', $hostModel->id)->delete();
            $instantBookingModel                  = new InstantBooking();
            $instantBookingModel->host_id         = $hostModel->id;
            $instantBookingModel->from_date       = $from_date;
            $instantBookingModel->to_date         = $to_date;
            $instantBookingModel->min_day_reserve = $request->min_day_reserve;

            if($instantBookingModel->save()) {
                PrintMessage('اطلاعات با موفقیت به روز رسانی شد.', 'success');
                return back();
            } else {
                PrintMessage('خطا در ثبت اطلاعات، لطفا مجددا تلاش نمایید.', 'warning');
                return back();
            }
        }
    }

    public function DeleteClosestTimeReserve($id) {

        $hostModel = Host::where('id', $id)->where('user_id', auth()->user()->id)->first();
        if(!empty($hostModel)) {
            InstantBooking::where('host_id', $hostModel->id)->delete();
            PrintMessage('رزرو آنی با موفقیت از سیستم حذف شد.', 'success');
            return back();
        }
    }


    public function StoreLastMinuteReserve(Request $request) {

//        return $request->all();
        $price = str_replace(',', '', $request->price);
        $price_person = str_replace(',', '', $request->price_person);
        $hostModel = Host::where('id', $request->host_id)->where('user_id', auth()->user()->id)->first();
        if(!empty($hostModel)) {
            LastMinuteReserve::where('host_id', $hostModel->id)->delete();
            $lastMinuteReserveModel = new LastMinuteReserve();
            $lastMinuteReserveModel->host_id = $hostModel->id;
            $lastMinuteReserveModel->price = $price;
            $lastMinuteReserveModel->price_person = $price_person;
            $lastMinuteReserveModel->date = date('Y-m-d 00:00:00');
            if($lastMinuteReserveModel->save()) {
                PrintMessage('اطلاعات با موفقیت به روز رسانی شد.', 'success');
                return back();
            } else {
                PrintMessage('خطا در ثبت اطلاعات، لطفا مجددا تلاش نمایید.', 'warning');
                return back();
            }
        }
    }

    public function DeleteLastMinuteReserve($id) {
        $hostModel = Host::where('id', $id)->where('user_id', auth()->user()->id)->first();
        if(!empty($hostModel)) {
            LastMinuteReserve::where('host_id', $hostModel->id)->delete();
            PrintMessage('رزرو لحظه آخری امروز با موفقیت از سیستم حذف شد.', 'success');
            return back();
        }
    }


    public function DetailIntegrated($id) {
        $integratedModel = Integrated::where('id', $id)->first();
        return view('frontend.Page.DetailIntegrated', compact('integratedModel'));
    }


    /**
     * gets city(format = تهران - تهران or تهران), date_from, date_to, number from main page
     */

    public function SearchHost(Request $request)
    {
        $dif = 0;
        $dateList = [];

        //حتما باید نام شهر انتخاب شود و برای نمایش خطا با برنامه نویس فرانت هماهنگ شود.
        $this->validate($request, [
            'city' => 'required'
        ], [
            'city.required' => 'لطفا شهر را انتخاب کنید.'
        ]);

        $hostModelList = Host::query()->with(['getProvince','getTownship','getGalleryFirst','getReserves'])
            ->where('hosts.active', 1)
            ->where('hosts.status', Host::ACTIVE_STATUS);

        if (isset($request->date_from) && isset($request->date_to)) {
            $from = $this->Convertnumber2english($request->date_from);
            $to   = $this->Convertnumber2english($request->date_to);

            $from = DateHelper::SolarToGregorian($from, '/');
            $to   = DateHelper::SolarToGregorian($to, '/');

            $date_from = date_create($from);

            $date_to = date_create($to);
            $dif = date_diff($date_from,$date_to)->format('%d');

            for ($i = 0; $i <= $dif; $i++) {
                $from3 = \Morilog\Jalali\jDate::forge($from)->reforge('+'. $i .'days')->format('date');
                $from2 = \Morilog\Jalali\jDatetime::createDatetimeFromFormat('Y-m-d', $from3)->format('Y-m-d'); //2016-05-8
                $date_from = date_create($from2)->format("Y-m-d H:i:s");
                 array_push($dateList, $date_from);
            }
        }



        if (isset($request->date_from) && isset($request->date_to)) {
            $hostModelList
                ->where("min_reserve_day",'<=', $dif +1 )
                ->where("max_day_show_calendar",'>=',$dif +1 );
        }

        $hostModelList
            ->where("hosts.count_guest",'>=', $request->number);

        if (!is_null($request->city)) {

            $city = explode('-',$request->city);

            if (count($city) == 1) {
                $city[1] = $city[0]; // در صورتی که یک شهر وارد شده باشد شهر و استان را یکی در نظر میگیرد
            }

            $hostModelList
                ->select('hosts.*')
                ->leftJoin('provinces','provinces.id','=','hosts.province_id')
                ->leftJoin('townships','townships.id','=','hosts.township_id')
                ->where('provinces.name', 'LIKE', '%'.trim($city[0]).'%')
                ->where('townships.name', 'LIKE', '%'.trim($city[1]).'%');
        }

        //چک کردن رزورها در صورت انتخاب بازه زمانی خاص
        if(empty(!$dateList)) {
            $hostModel = $hostModelList->get()->filter(function ($host) use($from, $dateList) {
                $reserved_in_date = false;
                $reserved_dates = $host->getReserve->where('reserve_date', '>=', new Carbon($from))->pluck('reserve_date');
                $reserved_dates->each(function($date) use($dateList, &$reserved_in_date){
                    if(in_array(date_create($date)->format("Y-m-d 00:00:00"), $dateList)){
                        $reserved_in_date = true;
                    }
                });
                if($reserved_in_date){
                    return false;
                } else {
                    return true;
                }
            });

        } else {
            $hostModel = $hostModelList->get();
        }

        return view('frontend.Page.Search.SearchHost', compact('hostModel'));
    }


    public function SearchHostAjax(Request $request) {
        return response()->json($request->all());
//        $hostModel = Host::where('active', 1)->where('status', 1)->get();
        return view('frontend.Page.Search.SearchHost', compact('hostModel'));
    }


    public function GetTodayPrice(Request $request) {
        $hostModel = Host::where('id', $request->id)->where('user_id', auth()->user()->id)->first();
        $weekModel = Week::where('sign', date('N'))->first();
        $priceDay = PriceDay::where('week_id', $weekModel->id)->where('host_id', $hostModel->id)->first();
        return $priceDay->price;
    }

    function Convertnumber2english($srting) {

        $srting = str_replace('۰', '0', $srting);
        $srting = str_replace('۱', '1', $srting);
        $srting = str_replace('۲', '2', $srting);
        $srting = str_replace('۳', '3', $srting);
        $srting = str_replace('۴', '4', $srting);
        $srting = str_replace('۵', '5', $srting);
        $srting = str_replace('۶', '6', $srting);
        $srting = str_replace('۷', '7', $srting);
        $srting = str_replace('۸', '8', $srting);
        $srting = str_replace('۹', '9', $srting);

        return $srting;
    }
}
