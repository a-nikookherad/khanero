<?php

namespace App\Modules\SlideShow\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Modules\SlideShow\Model\SlideShow;
use App\Modules\City\Model\Township;
use App\Modules\City\Model\Province;
use Morilog\Jalali\Facades\jDate;
use Morilog\Jalali\Facades\jDateTime;


class SlideShowController extends Controller
{
    public function IndexSlideShow()
    {
        $provinceModel = Province::where('active', 1)->get();
        $slideShowModel = SlideShow::all();
        return view('SlideShow::indexSlideShow', compact('slideShowModel', 'provinceModel'));
    }



    public function StoreSlideShow(Request $request)
    {
        $Message = [
            'title.required' => 'عنوان نمیتواند خالی باشد ',
//            'link.required' => 'آدرس نمیتواند خالی باشد ',
            'img.required' => 'تصویر نمیتواند خالی باشد ',
        ];
        $this->validate($request, [
            'title' => 'required',
//            'link' => 'required',
            'img' => 'required', //mimes:jpg,png
        ], $Message);




        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $filename = auth()->user()->mobile.'-'.str_random(4).'-'.time(). '.' .$file->getClientOriginalExtension();
            $file->move('Uploaded/SlideShow/Img', $filename);
        }
        else
        {
            $filename = '';
        }



        $slideShowModel = new SlideShow();
        $slideShowModel->township_id = $request->township_id;
        $slideShowModel->title = $request->title;
        $slideShowModel->link = $request->link;
        $slideShowModel->img = $filename;
        if($slideShowModel->save()) {
            PrintMessage('ثبت اسلاید با موفقیت انجام شد', 'success');
            return back();
        } else {
            PrintMessage('خطا در ثبت اسلاید. لطفا مجددا تلاش نمایید', 'danger');
            return back();
        }
    }

    public function EditSlideShow($id) {
        $slideShowModel = SlideShow::with('GetTownship')->where('id', $id)->first();
        $provinceModel = Province::where('active', 1)->get();
        if($slideShowModel->township_id == 0 || $slideShowModel->township_id == '') {
            $townshipModel = array();
        } else {
            $townshipModel = Township::where('province_id', $slideShowModel->GetTownship->province_id)->where('active', 1)->get();
        }

        return response()->json(view('SlideShow::Ajax.EditAjaxSlideShow', compact(
            'slideShowModel',
                'provinceModel',
                'townshipModel'))
            ->render());
    }

    public function UpdateSlideShow(Request $request) {
        $slideShowModel = SlideShow::find($request->slideshow_id);
        if ($request->township_id == '') {
            if ($request->link == '') {
                PrintMessage('شهرستان یا لینک اجباری می باشند', 'danger');
                return back();
            }
        }
        $oldImg = $slideShowModel->img;
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $filename = auth()->user()->mobile.'-'.str_random(4).'-'.time(). '.' .$file->getClientOriginalExtension();
            $file->move('Uploaded/SlideShow/Img', $filename);
        }
        else
        {
            $filename = $oldImg;
        }
        $slideShowModel->township_id = $request->township_id;
        $slideShowModel->title = $request->title;
        $slideShowModel->link = $request->link;
        $slideShowModel->img = $filename;
        if($slideShowModel->save()) {
            PrintMessage('ثبت ویرایش با موفقیت انجام شد', 'info');
            return back();
        }
    }
}