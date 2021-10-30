<?php

namespace App\Modules\MultiAuth\Controllers;

use App\Http\Controllers\Controller;
use App\mail\ResetPasswordLink;
use App\Modules\ContactUS\Model\Contact;
use App\Modules\MultiAuth\Model\PasswordReset;
use App\Modules\Sms\Controllers\SmsController;
use App\Modules\MultiAuth\Model\UserActivation;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class AuthController extends Controller
{

    /*
     *
     * admin login
     *
     * */
    public function LoginPage()
    {
        if (session('activity') == 1) {
            session()->forget('activity');
            session()->put('activity', 2);
        } else {
            session()->forget('activity');
        }
        if (session()->has('activity')) {
            return view('MultiAuth::ActivePage');
        }
        return view('MultiAuth::Login');
    }


    public function ActivityUser(Request $request)
    {
        $activeUser = UserActivation::where('token', $request->code)->first();
        if (!empty($activeUser)) {
            $userModel = User::find($activeUser->user_id);
            if (!empty($userModel)) {
                $userModel->active = 1;
                if ($userModel->save()) {
                    if ($activeUser->delete()) {
                        session()->forget('activity');
                        auth::loginUsingId($userModel->id);
                        return redirect(route('HomePage'));
                    }
                }
            }
        } else {
            PrintMessage('کد فعال سازی اشتباه می باشد.', 'danger');
            session()->put(['activity' => '1']);
            return redirect(route('LoginPage'));
        }
    }


    public function RecoveryPassword()
    {
        return view('MultiAuth::RecoveryPassword');
    }


    public function PasswordRecovery(Request $request)
    {
        // find user
        $userModel = User::where('mobile', $request->mobile)->first();
        if (!empty($userModel)) {
            $newPassword = rand(100000, 999999);
            $userModel->password = bcrypt($newPassword);
            /*
             * send sms
             * */
            SmsController::SendSMSRecovery($userModel->mobile, $newPassword);
            $userModel->save();
            PrintMessage('ارسال رمز جدید با موفقیت انجام شد', 'success');
            return redirect(route('Login'));
        } else {
            PrintMessage('کاربری با این شماره موبایل در سیستم وجود ندارد', 'danger');
            return back();
        }
    }


    public function Login(Request $request)
    {

        $arabic_eastern = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
        $arabic_western = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');

        $mob = str_replace($arabic_eastern, $arabic_western, $request->mobile);

        $pass = str_replace($arabic_eastern, $arabic_western, $request->password);


        if ($request->has('login_ajax')) {
            session()->put('date_from', $request->date_from);
            session()->put('date_to', $request->date_to);
            $this->validate($request, [
                'captcha' => 'captcha'
            ], [
                'captcha.captcha' => 'کد امنیتی نادرست است'
            ]);
            $user = Auth::attempt(["mobile" => $request->mobile, "password" => $request->password]);
            if ($user) {
                $userModel = User::where('mobile', $request->mobile)->first();
                if ($userModel->active == 1) {
                    if (auth()->user()->first_login == '1') {
                        if (auth()->user()->role_id == 1) {
                            return redirect(route('AdminDashboard'));
                        } elseif (auth()->user()->role_id != 1) {
                            return back();
                        }
                    } else {
                        auth()->user()->first_login = '1';
                        return back();
                    }
                } elseif ($userModel->active == 0) {
                    session()->flash('login_status', 1);
                    return back();
                }
            } else {
                session()->flash('login_error', 1);
                return back();
            }
        }


//        $this->validate($request,[
//            'captcha'=>'captcha'
//        ],[
//            'captcha.captcha'=>'کد امنیتی نادرست است'
//        ]);

//        return $request->all();
        $user = Auth::attempt(["mobile" => $mob, "password" => $pass]);

        if ($user) {
            $userModel = User::where('mobile', $request->mobile)->first();
//
            if ($userModel->active == 1) {
                if (auth()->user()->first_login == '1') {
                    if (auth()->user()->role_id == 1) {
                        return redirect(route('AdminDashboard'));
                    } elseif (auth()->user()->role_id != 1) {
                        return redirect(route('HomePage'));
                    }
                } else {
                    auth()->user()->first_login = '1';
                    if (auth()->user()->save()) {
                        return redirect(route('EditUser'));
                    }
                }
            } elseif ($userModel->active == 0) {
                PrintMessage('کاربر غیر فعال میباشد', 'danger');
                return redirect(route('LoginPage'));
            }
        } else {
            PrintMessage('نام کاربری یا رمز ورود اشتباه است', 'warning');
            return redirect(route('LoginPage'));
        }

    }

    /**
     * change password
     */
    public function ResetPassword(Request $request)
    {
        $Message = [
            'current_password.required' => 'وارد کردن رمز فعلی الزامی است.',
            'new_password.required' => 'وارد کردن رمز جدید الزامی است',
            'new_password.min' => 'رمز ورود باید بیش از 6 رقم باشد',
        ];
        $this->validate($request, [
            'new_password' => 'required|min:6',
            'current_password' => 'required'
        ], $Message);

        $userModel = User::where('id', auth()->user()->id)->first();

        if(!\Hash::check($request->current_password, $userModel->password)) {
            PrintMessage('رمز فعلی شما صحیح نمیباشد.', 'danger');
            return back();
        }

        if ($request->new_password == $request->confirm_password) {
            $userModel->password = bcrypt($request->new_password);
            if ($userModel->save()) {
                PrintMessage('اطلاعات شما با موفقیت ویرایش گردید', 'success');
                return back();
            }
        } else {
            PrintMessage('عدم موفقیت در ویرایش اطلاعات', 'danger');
            return back();
        }
    }


    /*
     * ارسال اس ام اس ثبت نام
     * */
    public function CheckUserAjax(Request $request)
    {
        // return 23;
        $userModel = User::where('mobile', $request->mobile)->first();
        if (!empty($userModel)) {
            if ($userModel->password == 'none') {
                $Token = (rand(10000, 99999));
                /*
                 * send sms
                 * */
                SmsController::SendSMSRegister($userModel->first_name.' '.$userModel->last_name, $userModel->mobile, $Token);
                $smsController = new \App\Http\Controllers\SMSController();
                $smsController->register($userModel->mobile, $Token);
                UserActivation::where('user_id', $userModel->id)->delete();
                $Activation = new UserActivation([
                    'user_id' => $userModel->id,
                    'token'   => $Token
                ]);
                if ($Activation->save()) {
                    $Response = ["Message" => "sms", "Content" => view('frontend.Ajax.Auth.Sms')->render()];
                    return response()->json($Response);
                }
            } else {
                $Response = ["Message" => "found", "Content" => view('frontend.Ajax.Auth.Login')->render()];
                return response()->json($Response);
            }
        } else {
            $userModel = new User();
            $userModel->first_name = $request->first_name;
            $userModel->user_name = $request->mobile;
            $userModel->password = 'none';
            $userModel->role_id = 2;
            $userModel->mobile = $request->mobile;
            $userModel->active = 0;
            $userModel->sex = $request->sex;
            if ($userModel->save()) {
                $Token = (rand(10000, 99999));
                /*
                 * send sms
                 * */
                SmsController::SendSMSRegister($userModel->first_name . ' ' . $userModel->last_name, $userModel->mobile, $Token);
                $smsController = new \App\Http\Controllers\SMSController();
                $smsController->register($userModel->mobile, $Token);
                $Activation = new UserActivation([
                    'user_id' => $userModel->id,
                    'token'   => $Token
                ]);
                if ($Activation->save()) {
                    $Response = ["Message" => "sms", "Content" => view('frontend.Ajax.Auth.Sms')->render()];
                    return response()->json($Response);
                }
            }
        }
    }


    /*
     * Check Code Login
     * */
    public function CheckCodeLogin(Request $request)
    {
        $userModel = User::where('mobile', $request->mobile)->first();
        if (!empty($userModel)) {

            if($userModel->userActivation->token == $request->code)
            {
                $Response = ["Message" => "success", "Content" => view('frontend.Ajax.Auth.NewPassword')->render()];
                return response()->json($Response);
            } else {
                //پیغام خطا مجددا از سمت فرانت بررسی شود.
                $Response = ["Success" => "0", "Message" => "کد وارد شده با کد مورد نظر مطابقت ندارد."];
                return response()->json($Response);
            }
        }
    }


    /*
     * ذخیره رمز عبور جدید بعد از ارزیابی کد ۵ رقمی ارسال شده
     * */
    public function RegisterAjaxUser(Request $request)
    {
        if ($request->password == '' || strlen($request->password) < 6) {
            $Response = ["Message" => "lenght", "Content" => "رمز ورود حداقل باید شامل 6 کاراکتر باشد"];
            return response()->json($Response);
        }
        $userModel = User::where('mobile', $request->mobile)->first();
        if (!empty($userModel)) {
            $userModel->password = bcrypt($request->password);
            $userModel->sex = $request->gender;
            $userModel->active = true;
            $userModel->first_name = $request->firstName;
            $userModel->last_name = $request->lastName;
            if ($userModel->save()) {
                auth()->loginUsingId($userModel->id);
                $Response = ["Message" => "success", "Content" => view('frontend.Ajax.Auth.Header')->render()];
                return response()->json($Response);
            } else {
                $Response = ["Message" => "dont-save", "Content" => ""];
                return response()->json($Response);
            }
        }
    }


    /*
     * Ajax Login
     * */
    public function LoginAjax(Request $request)
    {
        if ($request->mobile == '' || $request->password == '') {
            $Response = ["Message" => "empty", "Content" => ""];
            return response()->json($Response);
        } else {
            $user = Auth::attempt(["mobile" => $request->mobile, "password" => $request->password]);
            if ($user) {
                $userModel = User::where('mobile', $request->mobile)->first();
                if ($userModel->active == 1) {
                    $Response = ["Message" => "success", "Content" => view('frontend.Ajax.Auth.Header')->render(), "Content2" => view('frontend.Ajax.Auth.Menu')->render()];
                    return response()->json($Response);
                } else {
                    Auth::logout();
                    $Response = ["Message" => "de-active", "Content" => ""];
                    return response()->json($Response);
                }
            } else {
                $Response = ["Message" => "not-found", "Content" => ""];
                return response()->json($Response);
            }
        }
    }

    /**
     * درخواست لاگین با کد یکبار مصرف
     */
    public function AuthWithSms(Request $request, $type)
    {
        $userModel = User::where('mobile', $request->mobile)->first();
        if (!empty($userModel)) {
            $Token = (rand(10000, 99999));
            /*
             * send sms
             * */
            SmsController::SendSMSForLogin($userModel->mobile, $Token);
            $smsController = new \App\Http\Controllers\SMSController();
            $smsController->register($userModel->mobile, $Token);
            UserActivation::where('user_id', $userModel->id)->delete();
            $Activation = new UserActivation([
                'user_id' => $userModel->id,
                'token'   => $Token
            ]);

            if ($Activation->save()) {
                if($type == 'forget_password') {
                    $Response = ["Message" => "sms", "Content" => view('frontend.Ajax.Auth.ForgetPass')->render()];
                    return response()->json($Response);
                }
                $Response = ["Message" => "sms", "Content" => view('frontend.Ajax.Auth.OnceSms')->render()];
                return response()->json($Response);
            }

        } else {
                $Response = ["Message" => "user not found"];
                return response()->json($Response, 404);
        }
    }

    /**
     * ورود با کد یکبار مصرف
     */
    public function loginWithSmsCode(Request $request)
    { // mobile , code
        $userModel = User::where('mobile', $request->mobile)->first();
        if (!empty($userModel)) {
            if ($userModel->userActivation->token == $request->code) {
                auth::loginUsingId($userModel->id);
                $Response = ["Message" => "success", "Content" => view('frontend.Ajax.Auth.Header')->render(), "Content2" => view('frontend.Ajax.Auth.Menu')->render()];
                return response()->json($Response);
            } else {
                $Response = ["Message" => "wrong code"];
                return response()->json($Response, 403);
            }
        } else {
            $Response = ["Message" => "user not found"];
            return response()->json($Response, 404);
        }
    }

    public function DefaultLoginAjax(Request $request)
    {
        $Response = ["Message" => "", "Content" => view('frontend.Ajax.Auth.Default', compact('request'))->render()];
        return response()->json($Response);
    }

    /*logout*/
    public function Logout()
    {
        Auth::logout();
        return redirect(route('HomePage'));
    }


    /**
     * make new password after clicking on forget password
     */
    public function newPassword(Request $request)
    {
        $Message = [
            'code.required' => 'وارد کردن کد الزامی است.',
            'password.required' => 'وارد کردن رمز جدید الزامی است',
            'password.min' => 'رمز ورود باید بیش از 6 رقم باشد',
            'confirm_password.required' => 'تکرار رمز عبور جدید الزامی است.',
            'confirm_password.min' => 'تکرار رمز عبور باید بیش از 6 رقم باشد.',
            'mobile.required' => 'شماره موبایل ارسال نشده است.',
        ];
        $this->validate($request, [
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6',
            'mobile' => 'required',
            'code' => 'required'
        ], $Message);


        if($request->password != $request->confirm_password) {
            PrintMessage('رمز عبور جدید با تکرار رمز عبور مطابقت ندارد.', 'danger');
            return back();
        }

        $userModel = User::where('mobile', $request->mobile)->first();

        if (!empty($userModel)) {
            if ($userModel->userActivation->token == $request->code) {
                $userModel->password = bcrypt($request->new_password);
                if ($userModel->save()) {
                    PrintMessage('رمز کاربری با موفقیت تغییر یافت.', 'success');
                    return back();
                }
            } else {
                PrintMessage('کد ارسال شده صحیح نمیباشد.', 'danger');
                return back();
            }
        }
    }

}
