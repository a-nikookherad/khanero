<?php

namespace App\Modules\Rate\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Reserve\Model\Reserve;
use App\Modules\Rate\Model\Rate;
use App\Modules\Host\Model\Host;
use App\User;
use DB;

class RateController extends Controller
{
    public function IndexRate() {
        $rateModel = Rate::with('getHost')->whereHas('getHost', function ($Query) {
            $Query->where('user_id', auth()->user()->id);
        })->select('host_id', DB::raw('SUM(rate) as sum'), DB::raw('count(rate) as count'))
            ->groupBy('host_id')
            ->get();
        return view('Rate::indexRate', compact('rateModel'));
    }

    public function AjaxSetRate($code_reserve) {
        $reserveModel = Reserve::where('group_code', $code_reserve)->where('submit_rate', 0)->where('user_id', auth()->user()->id)->where('status', 2)->first();
        
        if(!empty($reserveModel)) {
            return response()->json(view('Rate::Ajax.AjaxSetReserve', compact('reserveModel'))->render());
        }
    }

    public function StoreRate(Request $request) {
        $reserveModel = Reserve::where('id', $request->reserve_id)->where('user_id', auth()->user()->id)->first();
        $code = $reserveModel->group_code;
        if(!empty($reserveModel)) {
            $rateModel = new Rate();
            $rateModel->user_id = $reserveModel->user_id;
            $rateModel->host_id = $reserveModel->host_id;
            $rateModel->rate1 = $request->rate1;
            $rateModel->rate2 = $request->rate2;
            $rateModel->rate3 = $request->rate3;
            $rateModel->rate4 = $request->rate4;
            $rateModel->rate5 = $request->rate5;
            $rateModel->comment = $request->comment;
            if($rateModel->save()) {
                DB::table('reserves')->where('user_id', auth()->user()->id)
                    ->where('host_id', $reserveModel->host_id)
                    ->where('submit_rate', 0)
                    ->where('group_code', $code)->update(['submit_rate' => 1]);
                PrintMessage('ثبت نظر با موفقیت انجام شد', 'success');
                return redirect(route('IndexReserve'));
            }
        }
    }


    public function IndexRateAndComment() {
        $rateModel = Rate::orderBy('status', 'DESC')->get();
        return view('Rate::indexRateAndComment', compact('rateModel'));
    }


    public function ActiveCommentAndRate($id) {
        $rateMode = Rate::where('id', $id)->first();
        if(!empty($rateMode)) {
            if($rateMode->status == 0) {
                $rateMode->status = 1;
                $rateMode->save();
                return 'active';
            } else {
                $rateMode->status = 0;
                $rateMode->save();
                return 'deActive';
            }
        }
    }

    public function GetDetailHost($id) {
        $rateModel = Rate::where('id', $id)->first();
        if(!empty($rateModel)) {
            $hostModel = Host::where('id', $rateModel->host_id)->first();
            return view('Rate::Ajax.AjaxGetDetailHost', compact('hostModel'));
        }
    }

    public function GetDetailGuest($id) {
        $rateModel = Rate::where('id', $id)->first();
        if(!empty($rateModel)) {
            $userModel = User::where('id', $rateModel->user_id)->first();
            return view('Rate::Ajax.AjaxGetDetailUser', compact('userModel'));
        }
    }

    public function GetCommentAndRate($id) {
        $rateModel = Rate::where('id', $id)->first();
        if(!empty($rateModel)) {
            return view('Rate::Ajax.AjaxGetCommentAndRate', compact('rateModel'));
        }
    }
}
