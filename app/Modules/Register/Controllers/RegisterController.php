<?php

namespace App\Modules\Register\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\City\Model\Province;
use App\Modules\City\Model\Township;
use App\Modules\City\Model\Area;
use App\Modules\City\Model\District;
use App\Modules\Host\Model\Host;
use App\Modules\User\Model\Document;
use App\Modules\MultiAuth\Model\Role;
use App\Modules\Message\Model\Message;
use App\Modules\MultiAuth\Model\UserActivation;
use Illuminate\Support\Facades\Mail;
use App\Modules\Sms\Controllers\SmsController;
use App\mail\ResetPasswordLink;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Morilog\Jalali\Facades\jDate;
use Morilog\Jalali\Facades\jDateTime;
use Melipayamak;
use App\ImageManager;
use Image;


class RegisterController extends Controller
{

    //register form
    public function RegisterForm()
    {
        $Province=Province::where('active','1')->where('country_id', 114)->get(); // 114 => Iran
        $Role=Role::where('role', '!=', 'admin')->get();
        return view('Register::User.RegisterForm',compact('Province', 'Role'));
    }

    //store new user
    public function StoreNewUser(Request $request)
    {
        if($request->has('login_ajax')) {
            session()->put('date_from', $request->date_from);
            session()->put('date_to', $request->date_to);
            $Message=[
                'first_name.required'=>'نام نمیتواند خالی باشد .',
                'mobile.required'=>'شماره موبایل نمیتواند خالی باشد .',
                'mobile.unique'=>'شماره موبایل قبلا در سیستم ثبت شده است .',
                'mobile.min'=>' شماره موبایل باید ۱۱ رقم باشد',
                'mobile.max'=>' شماره موبایل نمیتواند بیش از ۱۱ رقم باشد',
                'password.required'=>'رمز ورود نمیتواند خالی باشد .',
                'password.min'=>' رمز ورود باید بیش از ۸ رقم باشد',
//                'captcha.captcha'=>'کد امنیتی نادرست است',
            ];
            $this->validate($request,[
                'first_name' => 'required',
                'mobile'=>'required|min:11|max:11|unique:users,mobile,',
                'password' => 'required|min:8',
//                'captcha'=>'captcha'
            ],$Message);


            if($request->confirm_password == "" || $request->password != $request->confirm_password)
            {
                session()->flash(['confirm_password'=>'1']);
                return back();
            }


            $userModel = new User();
            $userModel->first_name = $request->first_name;
            $userModel->user_name = $request->mobile;
            $userModel->password = bcrypt($request->password);
            $userModel->role_id = 2;
            $userModel->mobile = $request->mobile;
            if($userModel->save()) {

                $messageModel = new Message();
                $messageModel->sender_id = 1;
                $messageModel->receiver_id = $userModel->id;
                $messageModel->title = 'خوش آمدید';
                $messageModel->message = 'به سایت خانه رو خوش آمدید، لحظات خوشی را برای شما آرزومندیم.';
                $messageModel->view = 0;
                $messageModel->parent_id = 0;
                $messageModel->save();

                $Token=(rand(10000,99999));
                /*
                 * send sms
                 * */
                SmsController::SendSMSRegister($userModel->first_name.' '.$userModel->last_name,$userModel->mobile,$Token);

                $Activation=new UserActivation([
                    'user_id'=>$userModel->id,
                    'token'=>$Token
                ]);
                $Activation->save();
                session()->flash(['active_code'=>'1']);
                return back();
            }
            else
            {
                session()->flash(['error_register'=>'1']);
                return back();
            }
        }

        $Message=[
            'first_name.required'=>'نام نمیتواند خالی باشد .',
            'mobile.required'=>'شماره موبایل نمیتواند خالی باشد .',
//            'mobile.unique'=>'شماره موبایل قبلا در سیستم ثبت شده است .',
            'mobile.min'=>' شماره موبایل باید ۱۱ رقم باشد',
            'mobile.max'=>' شماره موبایل نمیتواند بیش از ۱۱ رقم باشد',
            'password.required'=>'رمز ورود نمیتواند خالی باشد .',
            'password.min'=>' رمز ورود باید بیش از ۸ رقم باشد',
            'captcha.captcha'=>'کد امنیتی نادرست است',
        ];
        $this->validate($request,[
            'first_name' => 'required',
            'mobile'=>'required|min:11|max:11', //|unique:users,mobile,',
            'password' => 'required|min:8',
            'captcha'=>'captcha'
        ],$Message);
//        if($request->confirm_password == "" || $request->password != $request->confirm_password)
//        {
//            PrintMessage('خطا در تاییدیه رمز عبور، لطفا مجددا تلاش کنید .', 'danger');
//            return back();
//        }

        if(session()->has('reagent_code')) {
            $userId = GenerateIdIntroduction(session('reagent_code'));
            $userModelReagent = User::find($userId);
            if (!empty($userModelReagent)) {
                $userIdReagent = $userModelReagent->id; //
            } else {
                $userIdReagent = 0;
            }
        } else {
            $userIdReagent = 0;
        }

        $userFindByMobile = User::where('mobile', $request->mobile)->first();
        if(!empty($userFindByMobile) && $userFindByMobile->active == 0) {
            $userFindByMobile->first_name = $request->first_name;
            $userFindByMobile->password = bcrypt($request->password);
            $userFindByMobile->parent_id = $userIdReagent;
            if($userFindByMobile->save()) {
                session()->forget('reagent_code');
                $Token=(rand(10000,99999));
                $userActivationModel = UserActivation::where('token', $Token)->first();
                if(!empty($userActivationModel)) {
                    $Token=(rand(10000,99999));
                }
                /*
                 * send sms
                 * */
                SmsController::SendSMSRegister($userFindByMobile->first_name.' '.$userFindByMobile->last_name, $userFindByMobile->mobile,$Token);
                UserActivation::where('user_id', $userFindByMobile->id)->delete();
                $Activation=new UserActivation([
                    'user_id'=>$userFindByMobile->id,
                    'token'=>$Token
                ]);
                $Activation->save();
                session()->put(['activity'=>'1']);
                session()->put(['mobile'=> $userFindByMobile->mobile]);
                return redirect(route('LoginPage'));
            }
            else
            {
                PrintMessage('خطایی در ثبت اطلاعات شما به وجود آمده است', 'danger');
                return back();
            }
        }
        $userModel = new User();
        $userModel->first_name = $request->first_name;
        $userModel->user_name = $request->mobile;
        $userModel->password = bcrypt($request->password);
        $userModel->role_id = 2;
        $userModel->mobile = $request->mobile;
        $userModel->parent_id = $userIdReagent;
        if($userModel->save()) {

            $messageModel = new Message();
            $messageModel->sender_id = 1;
            $messageModel->receiver_id = $userModel->id;
            $messageModel->title = 'خوش آمدید';
            $messageModel->message = 'به سایت رنت خوش آمدید، لحظات خوشی را برای شما آرزومندیم.';
            $messageModel->view = 0;
            $messageModel->parent_id = 0;
            $messageModel->save();

            session()->forget('reagent_code');
            $Token=(rand(10000,99999));
            $userActivationModel = UserActivation::where('token', $Token)->first();
            if(!empty($userActivationModel)) {
                $Token=(rand(10000,99999));
            }
            /*
             * send sms
             * */
            SmsController::SendSMSRegister($userModel->first_name.' '.$userModel->last_name, $userModel->mobile,$Token);

            $Activation=new UserActivation([
                'user_id'=>$userModel->id,
                'token'=>$Token
            ]);
            $Activation->save();
            session()->put(['activity'=>'1']);
            session()->put(['mobile'=> $userModel->mobile]);
            return redirect(route('LoginPage'));
        }
        else
        {
            PrintMessage('خطایی در ثبت اطلاعات شما به وجود آمده است', 'danger');
            return back();
        }
    }

    public function SendCodeSms() {
        sleep(1);
        $Token=(rand(10000,99999));
        $userActivationModel = UserActivation::where('token', $Token)->first();
        if(!empty($userActivationModel)) {
            $Token=(rand(10000,99999));
        }
        /*
         * send sms
         * */
        SmsController::SendSMSRegister2(session('mobile'),$Token);
        $userModel = User::where('mobile', session('mobile'))->first();
        UserActivation::where('user_id', $userModel->id)->delete();
        $Activation=new UserActivation([
            'user_id'=>$userModel->id,
            'token'=>$Token
        ]);
        $Activation->save();
        session()->forget('activity');
        session()->put('activity', 1);
        return 'confirm';
    }


    public function ActiveAccount(Request $request)
    {
        $Active=UserActivation::where('token',$request->token)->first();
        if(count($Active)<1){
            return 'نتیجه ای یافت نشد';
            abort(404);
        }



        $User=User::find($Active->user_id);

        $User->active='1';
        if($User->save())
        {
            $Active->delete();
            return redirect(route('HomePage'));
        }
        else
        {
            return redirect(route('HomePage'));
        }
    }


    //recaptcha
    public function Captcha(Request $request)
    {
        return view('MultiAuth::Captcha.Recaptcha');
    }


    /*
     *
     * Edit User
     *
     ***/
    public function EditUser()
    {
        $provinceModel=Province::where('active','1')->where('country_id', 114)->get(); // 114 => Iran
        $userModel = User::where('id', auth()->user()->id)->first();
        $cityId = $userModel->city_id;
        if($cityId == 0)
        {
            $cityId = 1;
        }
        $city = Township::where('id', $cityId)->first();
        $cityModel = Township::where('province_id', $city->province_id)->get();
        return view('Register::User.EditUser', compact(
    'userModel',
         'city',
            'provinceModel',
            'cityModel'
        ));
    }


    public function UpdateUser(Request $request) {

        $userModel = User::where('id', auth()->user()->id)->first();
        if($request->has('image_form')) {
            $oldImg = $userModel->avatar;
            if ($request->hasFile('img')) {
                $image = $request->file('img');
                $filename = rand(100000,999999).time(). '.' .$image->getClientOriginalExtension();
                $image->move('Uploaded/User/Profile', $filename);
                if(!empty($oldImg))
                {
                    if(file_exists('Uploaded/User/Profile/'.$oldImg))
                    {
                        unlink('Uploaded/User/Profile/'.$oldImg);
                    }
                }
            }
            else
            {
                $filename = $oldImg;
            }
            $userModel->avatar = $filename;
            $userModel->about = $request->about;
            if($userModel->save()) {
                PrintMessage('نمایه شما با موفقیت ویرایش گردید', 'success');
                return back();
            } else {
                return back();
            }
        }

        $Message=[
            'first_name.required'=>'نام نمیتواند خالی باشد .',
//            'last_name.required'=>'نام خانوادگی نمیتواند خالی باشد .',
//            'mobile.required'=>'شماره موبایل نمیتواند خالی باشد .',
//            'mobile.unique'=>'شماره موبایل قبلا در سیستم ثبت شده است .',
//            'mobile.min'=>' شماره موبایل باید ۱۱ رقم باشد',
//            'mobile.max'=>' شماره موبایل نمیتواند بیش از ۱۱ رقم باشد',
//            'telephone.required'=>' شماره تلفن نمیتواند خالی باشد',
            'birth_date.required'=>'تاریخ تولد نمیتواند خالی باشد .',
//            'email.required'=>'پست الکترونیکی نمیتواند خالی باشد .',
//            'email.unique'=>'پست الکترونیکی قبلا در سیستم ثبت شده است .',
//            'email.email'=>'پست الکترونیکی صحیح نمیباشد .',
            'city_id.required'=>'وارد کردن شهر الزامی می باشد .',
        ];
        $this->validate($request,[
            'first_name' => 'required',
//            'last_name' => 'required',
//            'mobile' => 'required|min:11|max:11|unique:users,mobile,'.$userModel->id,
//            'telephone' => 'required',
            'birth_date' => 'required',
//            'email' => 'required|email|unique:users,email,'.$userModel->id,
            'city_id' => 'required',
        ],$Message);

        if($request->birth_date == 'انتخاب کنید') {
            $birthDate = null;
        } else {
            $birthDate = jDateTime::ConvertToGeorgian($request->birth_date,date('H:i:s'));
        }
        if($request->city_id == 0) {
            PrintMessage('وارد کردن استان و شهر الزامی می باشد', 'danger');
            return back();
        }

        if($request->sex != 1 && $request->sex != 2)
        {
            PrintMessage('خطا در ارسال داده ها', 'danger');
            return back();
        }
        $userModel->first_name = $request->first_name;
        $userModel->last_name = $request->last_name;
        $userModel->city_id = $request->city_id;
        $userModel->telephone = $request->telephone;
        $userModel->email = $request->email;
        $userModel->sex = $request->sex;
        $userModel->nt_code = $request->nt_code;
        $userModel->n_number = $request->n_number;
        $userModel->job = $request->job;
        $userModel->instagram = $request->instagram;
        $userModel->email = $request->email;
        $userModel->marital_status = $request->marital_status;

        $userModel->birth_date = $birthDate;
        $userModel->address = $request->address;
        $userModel->card_bank_number = $request->card_bank_number;
        if($userModel->save())
        {
            if($userModel->first_name != '' && $userModel->last_name != '' && $userModel->mobile != '' && $userModel->birth_date != '' && $userModel->city_id != 0) {
                $userModel->confirm_user = 1;
                $userModel->save();
            }
            PrintMessage('اطلاعات شما با موفقیت ویرایش گردید', 'success');
            return back();
        }
        else
        {
            PrintMessage('عدم موفقیت در ویرایش اطلاعات', 'danger');
            return back();
        }
    }



    public function UpdateConfirmUser(Request $request)
    {
          $Message = [
              'type.required' => 'نوع مدرک نمیتواند خالی باشد .',
              'type.not_in' => 'نوع مدرک نمیتواند خالی باشد .',
              'file.required' => 'فایل مدرک نمیتواند خالی باشد .',
          ];
          $this->validate($request, [
              'type' => 'required|not_in:0',
              'file' => 'required',
          ], $Message);
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = rand(100000,999999).time(). '.' .$file->getClientOriginalExtension();
            $file->move('Uploaded/Document/File/', $filename);
        }
          $documentModel = new Document();
          $documentModel->user_id = auth()->user()->id;
          $documentModel->file = $filename;
          $documentModel->type = $request->type;
        if($documentModel->save()) {
            PrintMessage('مدارک شما با موفقیت در سیستم ثبت شد', 'success');
            return back();
        } else {
            PrintMessage('عدم موفقیت در ثبت مدارک، لطفا مجددا تلاش نمایید', 'danger');
            return back();
        }
    }



    /** ReagentCode */
    public function ReagentCode(Request $request) {
        if(is_numeric($request->code)) {
            $userId = GenerateIdIntroduction($request->code);
            $userModel = User::find($userId);
            if (!empty($userModel)) {
                return $userModel->first_name.' '.$userModel->last_name;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    /** ReagentCode */
    public function RegisterReagentCode(Request $request) {
        if(is_numeric($request->code)) {
            // 1824 for id 2
            $userId = GenerateIdIntroduction($request->code);
            $userModel = User::find($userId);
            if (!empty($userModel)) {
                session()->put('reagent_code', $request->code);
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }


    public function UpdateAccountBank(Request $request) {
        auth()->user()->card_bank_number = $request->card_bank_number;
        auth()->user()->account_name = $request->account_name;
        auth()->user()->shaba_number = $request->shaba_number;
        auth()->user()->save();
        PrintMessage('شماره حساب با موفقیت در سیستم ثبت شد .', 'success');
        return back();
    }

    public function CreateBoxUploadImageProfile() {
        return response()->json(view('Register::Ajax.AjaxUploadImageProfile')->render());
    }


//AjaxUploadImageProfile

    public function UpdateImageProfile(Request $request) {
        return 43;
    }

}
