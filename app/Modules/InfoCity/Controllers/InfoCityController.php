<?php

namespace App\Modules\InfoCity\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\InfoCity\Model\InfoProvince;
use App\Modules\InfoCity\Model\InfoTownship;
use App\Modules\City\Model\Province;
use App\Modules\City\Model\Township;
use Carbon\Carbon;
use Illuminate\Http\Request;


class InfoCityController  extends Controller
{
    /***************
     * Index Info
     ***************/
    public function IndexInfoCity()
    {
        $provinceModel = Province::where('active', 1)->get();
        $infoProvince = InfoProvince::all();
        $infoTownship = InfoTownship::all();
        return view('InfoCity::indexInfo', compact('infoProvince', 'infoTownship', 'provinceModel'));
    }
    /***************
     * Store Info Province
     ***************/
    public function StoreInfoProvince(Request $request)
    {
        $Message=[
            'province_id.required'=>'استان نميتواند خالی باشد .',
//            'province_id.unique'=>'این استان قبلا در سیستم ثبت شده است .',
            'img.required'=>'عکس نمیتواند خالی باشد .',
            'content.required'=>'محتوا نمیتواند خالی باشد .',
        ];
        $this->validate($request,[
            'province_id' => 'required',//|unique:info_provinces',
            'img' => 'required',
            'content' => 'required',
        ],$Message);

        //check image
        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $filename = 'province-'.time(). '.' .$image->getClientOriginalExtension();
            $image->move('Uploaded/InfoCity/Province', $filename);
        }
        else
        {
            $filename = 'infoCity.png';
        }
        $infoProvinceModel = new InfoProvince();
        $infoProvinceModel->province_id = $request->province_id;
        $infoProvinceModel->center_province = $request->center_province;
        $infoProvinceModel->area = $request->area;
        $infoProvinceModel->speech_language = $request->speech_language;
        $infoProvinceModel->important_city = $request->important_city;
        $infoProvinceModel->important_attractions = $request->important_attractions;
        $infoProvinceModel->population = $request->population;
        $infoProvinceModel->img = $filename;
        $infoProvinceModel->content = $request->content;
        if($infoProvinceModel->save()) {
            PrintMessage('اطلاعات با موفقیت در سیستم ذخیره شد', 'success');
        } else {
            PrintMessage('عدم موفقیت در ثبت اطلاعات، لطفا مجددا تلاش نمایید', 'danger');
        }
        return back();
    }
    /***************
     * Edit Info Province
     ***************/
    public function EditInfoProvince($id)
    {
        $provinceModel = Province::where('active', 1)->get();
        $infoProvince = InfoProvince::find($id);
        return view('InfoCity::editInfoProvince', compact('infoProvince', 'provinceModel'));
    }
    /***************
     * Update Info Province
     ***************/
    public function UpdateInfoProvince(Request $request)
    {
        $infoProvinceModel = InfoProvince::find($request->province_model_id);
        $Message=[
            'province_id.required'=>'استان نميتواند خالی باشد .',
            'content.required'=>'محتوا نمیتواند خالی باشد .',
//            'province_id.unique'=>'استان قبلا در سیستم ثبت شده است .',
        ];
        $this->validate($request,[
            'province_id' => 'required',//|unique:info_provinces,province_id,'.$request->province_model_id,
            'content' => 'required',
        ],$Message);

        //check image
        $old_img = $infoProvinceModel->img;
        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $filename = 'province-'.time(). '.' .$image->getClientOriginalExtension();
            $image->move('Uploaded/InfoCity/Province', $filename);
        }
        else
        {
            $filename = $old_img;
        }
        $infoProvinceModel->province_id = $request->province_id;
        $infoProvinceModel->center_province = $request->center_province;
        $infoProvinceModel->area = $request->area;
        $infoProvinceModel->speech_language = $request->speech_language;
        $infoProvinceModel->important_city = $request->important_city;
        $infoProvinceModel->important_attractions = $request->important_attractions;
        $infoProvinceModel->population = $request->population;
        $infoProvinceModel->img = $filename;
        $infoProvinceModel->content = $request->content;
        if($infoProvinceModel->save()) {
            PrintMessage('اطلاعات با موفقیت در سیستم به روز رسانی شد', 'success');
        } else {
            PrintMessage('عدم موفقیت در ویرایش اطلاعات، لطفا مجددا تلاش نمایید', 'danger');
        }
        return back();
    }


    public function DetailProvince($id) {
        $infoProvinceModel = InfoProvince::where('id', $id)->where('active', 1)->first();
        $infoTownshipModel = InfoTownship::where('province_id', $infoProvinceModel->province_id)->where('active', 1)->get();
        return view('frontend.Page.DetailProvince', compact('infoProvinceModel', 'infoTownshipModel'));
    }


    public function DetailTownship($id) {
        $infoTownshipModel = InfoTownship::where('id', $id)->where('active', 1)->first();
        return view('frontend.Page.DetailTownship', compact('infoTownshipModel'));
    }
    /***************
     * Store Info Township
     ***************/
    public function StoreInfoTownship(Request $request)
    {
        $Message=[
            'province_id.required'=>'استان نميتواند خالی باشد .',
            'township_id.required'=>'شهرستان نميتواند خالی باشد .',
            'township_id.unique'=>'این شهرستان قبلا در سیستم ثبت شده است .',
            'img.required'=>'عکس نمیتواند خالی باشد .',
            'content.required'=>'محتوا نمیتواند خالی باشد .',
        ];
        $this->validate($request,[
            'province_id' => 'required',
            'township_id' => 'required|unique:info_townships',
            'img' => 'required',
            'content' => 'required',
        ],$Message);

        //check image
        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $filename = 'township-'.time(). '.' .$image->getClientOriginalExtension();
            $image->move('Uploaded/InfoCity/Township', $filename);
        }
        else
        {
            $filename = 'infoCity.png';
        }
        $infoTownshipModel = new InfoTownship();
        $infoTownshipModel->province_id = $request->province_id;
        $infoTownshipModel->township_id = $request->township_id;
        $infoTownshipModel->important_attractions = $request->important_attractions;
        $infoTownshipModel->population = $request->population;
        $infoTownshipModel->area = $request->area;
        $infoTownshipModel->area_code = $request->area_code;
        $infoTownshipModel->plate_car = $request->plate_car;
        $infoTownshipModel->img = $filename;
        $infoTownshipModel->content = $request->content;
        if($infoTownshipModel->save()) {
            PrintMessage('اطلاعات با موفقیت در سیستم ذخیره شد', 'success');
        } else {
            PrintMessage('عدم موفقیت در ثبت اطلاعات، لطفا مجددا تلاش نمایید', 'danger');
        }
        return back();
    }
    /***************
     * Edit Info Township
     ***************/
    public function EditInfoTownship($id)
    {
        $provinceModel = Province::where('active', 1)->get();
        $townshipModel = Township::where('active', 1)->get();
        $infoTownship = InfoTownship::find($id);
        return view('InfoCity::editInfoTownship', compact('provinceModel',
            'townshipModel',
            'infoTownship'
        ));
    }
    /***************
     * Update Info Township
     ***************/
    public function UpdateInfoTownship(Request $request)
    {
        $infoTownship = InfoTownship::find($request->township_model_id);
        $Message=[
            'province_id.required'=>'استان نميتواند خالی باشد .',
            'township_id.required'=>'شهرستان نميتواند خالی باشد .',
            'township_id.unique'=>'این شهرستان قبلا در سیستم ثبت شده است .',
            'content.required'=>'محتوا نمیتواند خالی باشد .',
        ];
        $this->validate($request,[
            'province_id' => 'required',
            'township_id' => 'required|unique:info_townships,township_id,'.$request->township_model_id,
            'content' => 'required',
        ],$Message);

        //check image
        $old_img = $infoTownship->img;
        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $filename = 'township-'.time(). '.' .$image->getClientOriginalExtension();
            $image->move('Uploaded/InfoCity/Township', $filename);
        }
        else
        {
            $filename = $old_img;
        }
        $infoTownship->province_id = $request->province_id;
        $infoTownship->township_id = $request->township_id;
        $infoTownship->important_attractions = $request->important_attractions;
        $infoTownship->population = $request->population;
        $infoTownship->area = $request->area;
        $infoTownship->area_code = $request->area_code;
        $infoTownship->plate_car = $request->plate_car;
        $infoTownship->img = $filename;
        $infoTownship->content = $request->content;
        if($infoTownship->save()) {
            PrintMessage('اطلاعات با موفقیت در سیستم ویرایش شد', 'success');
        } else {
            PrintMessage('عدم موفقیت در ویرایش اطلاعات، لطفا مجددا تلاش نمایید', 'danger');
        }
        return back();
    }
    /***************
     * Active Info Province
     ***************/
    public function ActiveInfoProvince($id)
    {
        $infoProvinceModel = InfoProvince::where('id', $id)->first();
        if ($infoProvinceModel->active == 1) {
            InfoProvince::where('id', $id)
                ->update(['active' => 0]);
            return 'deactive';
        } elseif ($infoProvinceModel->active == 0) {
            InfoProvince::where('id', $id)
                ->update(['active' => 1]);
            return 'active';
        }
    }
    /***************
     * Active Info Township
     ***************/
    public function ActiveInfoTownship($id)
    {
        $infoTownshipModel = InfoTownship::where('id', $id)->first();
        if ($infoTownshipModel->active == 1) {
            InfoTownship::where('id', $id)
                ->update(['active' => 0]);
            return 'deactive';
        } elseif ($infoTownshipModel->active == 0) {
            InfoTownship::where('id', $id)
                ->update(['active' => 1]);
            return 'active';
        }
    }




    public static function GetInfoProvince() {
        $infoProvinceModel = InfoProvince::where('active', 1)->get();
        return $infoProvinceModel;
    }
}