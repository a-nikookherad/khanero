<?php

namespace App\Modules\Favorite\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Favorite\Model\Favorite;
use App\Modules\Host\Model\Host;
use Morilog\Jalali\Facades\jDate;
use Morilog\Jalali\Facades\jDateTime;

class FavoriteController extends Controller
{

    public function IndexFavorite() {
        $favoriteModel = Favorite::with('getHost.getGallery')->where('user_id', auth()->user()->id)->get();
        return view('Favorite::indexFavorite', compact(
        'favoriteModel'
        ));
    }

    /*****************
     * Store Favorite
     ****************/
    public function SetFavorite(Request $request) {
//        return $request->all();
        if(!auth()->check()) {
            $Response = ["Success" => "0", "Message" => "ابتدا وارد سایت شوید یااگر عضو نیستید ثبت نام کنید."];
            return response()->json($Response);
        }
        $favoriteModel = Favorite::where('user_id', auth()->user()->id)
            ->where('host_id', $request->id)
            ->first();
        if(!empty($favoriteModel)) {
            $favoriteModel->delete();
            $Response = ["Success" => "-1", "Message" => "آیتم با موفقیت از لیست علاقه مندی ها حذف شد."];
            return response()->json($Response);
        } else {
            $favoriteModel = new Favorite();
            $favoriteModel->user_id = auth()->user()->id;
            $favoriteModel->host_id = $request->id;
            if($favoriteModel->save()) {
                $Response = ["Success" => "1", "Message" => "آیتم با موفقیت به لیست علافه مندی ها اضافه شد."];
                return response()->json($Response);
            }
        }
        return redirect(route('IndexFavorite'));
    }
    /****************
     * Delete Favorite
     ***************/
    public function DeleteFavorite($id) {
        $favoriteModel = Favorite::where('id', $id)->first();
        return response()->json(view('Favorite::Ajax.AjaxDeleteFavorite',compact('favoriteModel'))->render());
    }
    /****************
     * Favorite Delete
     ***************/
    public function FavoriteDelete(Request $request) {
        $favoriteModel = Favorite::where('id', $request->favorite_id)
            ->where('user_id', auth()->user()->id)
            ->first();
        if(!empty($favoriteModel))
        {
            $favoriteModel->delete();
            PrintMessage('حذف علاقه مندی موفقیت آمیز بود.','info');
            return redirect(route('IndexFavorite'));
        } else
        {
            PrintMessage('عملیات حذف موفقیت آمیز نبود.','danger');
            return redirect(route('IndexFavorite'));
        }
    }
    /****************
     * Get Favorite
     ***************/
    public static function GetFavorite() {
        $FavoriteModel = Favorite::where('active', 1)->get();
        return $FavoriteModel;
    }
    /****************
     * Favorite Days
     ***************/
    public function FavoriteDays(Request $request) {
        if($request->price == "" || $request->price == 0)
        {
            $Response=["Success"=>"0","Message"=>"قیمت نمی تواند خالی باشد ."];
            return response()->json($Response);
        }
        $dateTime = jDateTime::ConvertToGeorgian($request->date,date('H:i:s'));
        $buffer = explode(' ', $dateTime);
        $FavoriteTime = $buffer[0].' 00:00:00';
        $FavoriteDayModel = Favorite::where('host_id', $request->host_id)->where('date', $FavoriteTime)->first();
        if(!empty($FavoriteDayModel))
        {
            $Response=["Success"=>"0","Message"=>"تاریخ مورد نظر قبلا در سیستم ثبت شده است ، لطفا برای ویرایش به قسمت تخفیفات و روزهای خاص در منو مراجعه کنید ."];
            return response()->json($Response);
        }
        $FavoriteDayModel = new Favorite();
        $FavoriteDayModel->host_id = $request->host_id;
        $FavoriteDayModel->date = $FavoriteTime;
        $FavoriteDayModel->price = $request->price;
        if($FavoriteDayModel->save()) {
            $Response=["Success"=>"1","Message"=>"ثبت قیمت با موفقیت انجام شد ."];
            return response()->json($Response);
        } else {
            $Response=["Success"=>"0","Message"=>"عدم موفقیت در ثبت اطلاعات ، لطقا مجددا تلاش نمایید ."];
            return response()->json($Response);
        }
    }

}
