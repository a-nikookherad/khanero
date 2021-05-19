<?php

namespace App\Modules\User\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\City\Model\Province;
use App\Modules\City\Model\Township;
use App\Modules\City\Model\City;
use App\Modules\City\Model\District;
use App\Modules\City\Model\Area;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function IndexUser() {
        $userModel = User::where('role_id', '!=', 1)->get();
        return view('User::index', compact('userModel'));
    }


    public function InviteUser() {
        return view('User::inviteUser');
    }

    public function InviteFriend($code) {
        if (auth()->user()->parent_id != 0) {
            $id = GenerateIdIntroduction($code);
            $userModel = User::where('id', $id)->first();
            if(!empty($userModel)) {
                if(auth()->user()->id == $userModel->id) {
                    PrintMessage('این کد معرف برای شما در سیستم ثبت شده است.', 'warning');
                    return back();
                } else {
                    auth()->user()->parent_id = $userModel->id;
                    auth()->user()->save();
                    PrintMessage('اطلاعات معرف شما با موفقیت به روزرسانی شد.', 'success');
                    return back();
                }
            }
        } else {
            PrintMessage('معرف شما قبلا در سیستم به ثبت رسیده است.', 'success');
            return back();
        }
    }

    public function IndexUserConfirm() {
        $userModel = User::whereIn('confirm_user', array(2,3))->get();
        return view('User::indexConfirm', compact('userModel'));
    }

    public function DetailConfirmUser($id) {
        $userModel = User::where('confirm_user', '!=', 0)->where('id', $id)->first();
        return view('User::detailConfirmUser', compact('userModel'));
    }

    public function ConfirmUserToSpecial($id,$type) {
        $userModel = User::where('confirm_user', '!=', 0)->where('id', $id)->first();
        if($type == 'confirm') {
            $message = 'تایید کاربر با موفقیت در سیستم ثبت شد.';
            $userModel->confirm_user = 3; // success
        } elseif($type == 'reject') {
            $message = 'تغییرات برای بررسی مجدد اطلاعات کاربر، با موفقیت در سیستم ثبت شد.';
            $userModel->confirm_user = -1;
        }
        if($userModel->save()) {
            PrintMessage($message, 'success');
            $userModel = User::where('confirm_user', '!=', 0)->get();
            return redirect(route('IndexUserConfirm'));
//            return view('User::indexConfirm', compact('userModel'));
        }
    }

    public function IndexReagentUser() {
        $userModel = User::where('parent_id', auth()->user()->id)->get();
        return view('User::indexReagentUser', compact('userModel'));
    }

    public function DetailUser($id) {
        $userModel = User::where('id', $id)->first();
        $cityModel = Township::where('id', $userModel->city_id)->first();
        return view('User::detailUser', compact('userModel',
            'provinceModel',
            'cityModel'
        ));
    }

    public function AjaxDetailUser($id) {
        $userModel = User::where('id', $id)->first();
        $cityModel = City::where('id', $userModel->city_id)->first();
        return response()->json(view('User::Ajax.AjaxDetailUser', compact('userModel',
            'provinceModel',
            'cityModel'
        ))->render());
    }

    public function StatusUser($id) {
        $userModel = User::where('id', $id)->first();
        if ($userModel->active == 1)
        {
            User::where('id', $id)
                ->update(['active' => 0]);
            return 'deactive';
        }
        elseif ($userModel->active == 0)
        {
            User::where('id', $id)
                ->update(['active' => 1]);
            return 'active';
        }
    }

    public function SearchUser(Request $request) {
        $userModel = User::where('role_id', '!=', 1)->where(function ($query)use($request){
            if(!empty($request->name))
            {
                $query->where('name', $request->name);
            }
            if(!empty($request->sex))
            {
                $query->where('sex', $request->sex);
            }
            if(!empty($request->role))
            {
                $query->where('role_id', $request->role);
            }
        })->paginate(8);

        return view('User::index', compact('userModel'));
    }

    public function DetailUserProfile($id) {
        $userModel = User::where('id', $id)->first();
        return view('frontend.Page.DetailUserProfile', compact('userModel'));
    }

    public function LoginUser($id) {
        auth::loginUsingId($id,true);
        return redirect(route('UserDashboard'));
    }

}
