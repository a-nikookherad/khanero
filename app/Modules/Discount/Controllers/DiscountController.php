<?php

namespace App\Modules\Discount\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Discount\Model\Discount;
use App\Modules\Host\Model\Host;

class DiscountController extends Controller
{

    /*
     * Discount
     * */


    public function IndexDiscount() {
        $hostModel = Host::where('step', 100)->where('user_id', auth()->user()->id)->get();
        $discountModel = Discount::with('getHost')->whereHas('getHost', function ($Query) {
            $Query->where('step', 100);
            $Query->where('user_id', auth()->user()->id);
        })->get();
        return view('Discount::indexDiscount', compact(
        'discountModel',
                'hostModel'
        ));
    }

    public function StoreDiscount(Request $request) {
        $Message=[
            'host_id.required'=>'نام اقامتگاه نمیتواند خالی باشد .',
            'number_days.required'=>'تعداد روزها نمیتواند خالی باشد .',
            'percent.required'=>'مقدار تخفیف نمیتواند خالی باشد .',
        ];
        $this->validate($request,[
            'host_id' => 'required',
            'number_days' => 'required',
            'percent' => 'required',
        ],$Message);
        $hostModel = Host::where('id' ,$request->host_id)
            ->where('step', 100)
            ->where('user_id', auth()->user()->id)->first();
        if(empty($hostModel))
        {
            PrintMessage('اقامتگاه مورد نظر یافت نشد .', 'danger');
            return back();
        }
        $discountModel = new Discount();
        $discountModel->host_id = $request->host_id;
        $discountModel->number_days = $request->number_days;
        $discountModel->percent = $request->percent;
        if($discountModel->save())
        {
            PrintMessage('اعمال تخفیفات با موفقیت انجام شد.','success');
            return back();
        }
        else
        {
            PrintMessage('اعمال تخفیفات موفقیت آمیز نبود.','danger');
            return back();
        }
    }

    public function StoreDiscountAjax(Request $request) {
        if($request->number_days == null || $request->percent == null) {
            $Response = ["Success" => "0", "Message" => "پر کردن فیلدها اجباری است."];
            return response()->json($Response);
        }
        $hostModel = Host::where('id' ,$request->host_id)
            ->where('user_id', auth()->user()->id)->first();
        if(empty($hostModel))
        {
            $Response = ["Success" => "0", "Message" => "خطا در ثبت تخفیف"];
            return response()->json($Response);
        }
        $discountModel = new Discount();
        $discountModel->host_id = $request->host_id;
        $discountModel->number_days = $request->number_days;
        $discountModel->percent = $request->percent;
        if($discountModel->save())
        {
            $discountModel = Discount::where('host_id', $hostModel->id)->get();
            $Response = ["Success" => "1",
                "Message" => "ثبت تخفیف موفقیت آمیز بود.",
                "Content" => response()->json(view('Discount::Ajax.AjaxDiscountCreateHost',
                    compact('discountModel'))->render())
            ];
            return response()->json($Response);
        }
        else
        {
            $Response = ["Success" => "0", "Message" => "خطا در ثبت تخفیف"];
            return response()->json($Response);
        }
    }

    /****************
     * Delete Discount Ajax
     ***************/
    public function DeleteDiscountAjax(Request $request) {
        $discountModel = Discount::where('id', $request->id)->whereHas('getHost', function ($Query) {
            $Query->where('user_id', auth()->user()->id);
        })->first();

        if(!empty($discountModel)) {
            Discount::where('id', $request->id)->delete();
            $discountModel = Discount::where('host_id', $request->host_id)->get();
            $Response = ["Success" => "1",
                "Message" => "حذف تخفیف موفقیت آمیز بود.",
                "Content" => response()->json(view('Discount::Ajax.AjaxDiscountCreateHost',
                    compact('discountModel'))->render())
            ];
            return response()->json($Response);
        } else {
            return 'failed';
        }
    }

    /****************
     * Edit Discount
     ***************/
    public function EditDiscount($id) {
        $discountModel = Discount::where('id', $id)->first();
        return response()->json(view('Discount::Ajax.AjaxEditDiscount',compact('discountModel'))->render());
    }
    /****************
     * Update Discount
     ***************/
    public function UpdateDiscount(Request $request) {
        $discountModel = Discount::findOrfail($request->discount_id);
        $Message=[
            'discount_id.required'=>'تخفیف مورد نظر یافت نشد .',
            'number_days.required'=>'تعداد روزها نمیتواند خالی باشد .',
            'percent.required'=>'درصد تخفیف نمیتواند خالی باشد .',
        ];
        $this->validate($request,[
            'discount_id' => 'required',
            'number_days' => 'required',
            'percent' => 'required',
        ],$Message);
        $discountModel->number_days = $request->number_days;
        $discountModel->percent = $request->percent;
        if($discountModel->save())
        {
            PrintMessage('ویرایش تخفیف موفقیت آمیز بود.','info');
            return back();
        }
        else
        {
            PrintMessage('ویرایش موفقیت آمیز نبود.','danger');
            return back();
        }
    }
    /****************
     * Delete Discount
     ***************/
    public function DeleteDiscount($id) {
        $discountModel = Discount::where('id', $id)->first();
        return response()->json(view('Discount::Ajax.AjaxDeleteDiscount',compact('discountModel'))->render());
    }
    /****************
     * Discount Delete
     ***************/
    public function DiscountDelete(Request $request) {
        $discountModel = Discount::findOrfail($request->discount_id);
        if(!empty($discountModel))
        {
            $discountModel->delete();
            PrintMessage('حذف تاریخ موفقیت آمیز بود.','info');
            return back();
        } else
        {
            PrintMessage('عملیات حذف موفقیت آمیز نبود.','danger');
            return back();
        }
    }


    public static function GetDiscount() {
        $discountModel = Discount::where('active', 1)->get();
        return $discountModel;
    }

}
