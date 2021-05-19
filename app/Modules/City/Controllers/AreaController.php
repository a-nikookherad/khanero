<?php

namespace App\Modules\City\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\City\Model\Area;
use App\Modules\City\Model\City;
use App\Modules\City\Model\Province;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function IndexArea() {
        $areaModel = Area::all();
        $provinceModel = Province::where('active', 1)
            ->where('country_id', 114)->get();
        return view('City::Admin.Area.indexArea', compact('provinceModel', 'areaModel'));
    }

    public function StoreArea(Request $request) { 
        $Message=[
            'name.required'=>'نام منطقه نمیتواند خالی باشد',
            'city_id.required'=>'شهر نمیتواند خالی باشد',
            'province_id.required'=>'استان نمیتواند خالی باشد',
            'township_id.required'=>'شهرستان نمیتواند خالی باشد',
        ];
        $this->validate($request,[
            'city_id' => 'required',
            'province_id' => 'required',
            'township_id' => 'required',
            'name' => 'required',
        ],$Message);

        $areaValidate = Area::where('name', $request->name)->where('city_id', $request->city_id)->first();
        if(isset($areaValidate))
        {
            PrintMessage('این منطقه قبلا در سیستم ثبت شده است', 'danger');
            return back();
        }

        $areaModel = new Area();
        $areaModel->name = $request->name;
        $areaModel->province_id = $request->province_id;
        $areaModel->township_id = $request->township_id;
        $areaModel->city_id = $request->city_id;
        if($areaModel->save())
        {
            PrintMessage('اطلاعات شما با موفقیت ثبت شد', 'success');
            return back();
        }
        else
        {
            PrintMessage('عدم موفقیت در ثبت اطلاعات', 'danger');
            return back();
        }
    }


    public function ActiveArea($id) {
        $areaModel = Area::where('id', $id)->first();
        if ($areaModel->active == 1)
        {
            Area::where('id', $id)
                ->update(['active' => 0]);
            return 'deactive';
        }
        elseif ($areaModel->active == 0)
        {
            Area::where('id', $id)
                ->update(['active' => 1]);
            return 'active';
        }
    }


    public function EditArea($id) {
        $areaModel = Area::where('id', $id)->first();
        return response()->json(view('City::Admin.Area.Ajax.AjaxEditModal',compact('areaModel'))->render());
    }


    public function UpdateArea(Request $request) {
        $areaModel = Area::where('id', $request->area_id)->first();
        $Message=[
            'name.required'=>'منطقه نمیتواند خالی باشد',
        ];
        $this->validate($request,[
            'name' => 'required',
        ],$Message);

        $areaModel->name = $request->name;
        if($areaModel->save())
        {
            PrintMessage('ویرایش با موفقیت ثبت شد', 'info');
            return back();
        }
        else
        {
            PrintMessage('ویرایش ثبت نشد', 'danger');
            return back();
        }
    }


    public function AjaxArea(Request $request) {
        $List=Area::where('active','1')
            ->where('city_id',$request->id)
            ->get();
        return response()->json(view('City::Admin.Area.Ajax.AjaxAreaList',compact('List'))->render());
    }
}