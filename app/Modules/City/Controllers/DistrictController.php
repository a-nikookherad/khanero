<?php

namespace App\Modules\City\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\City\Model\District;
use App\Modules\City\Model\Province;
use App\Modules\City\Model\City;
use App\Modules\City\Model\Area;

class DistrictController extends Controller
{

    public function IndexDistrict() {
        $provinceModel = Province::where('country_id', 114)->get();
        $cityModel = City::where('active', 1)->get();
        $districtModel = District::orderBy('id', 'DESC')->get();
        return view('City::Admin.District.indexDistrict', compact('districtModel', 'provinceModel', 'cityModel'));
    }

    public function SearchDistrict(Request $request) {
        $provinceModel = Province::where('country_id', 114)->get();
        $cityModel = City::where('province_id',1)->get();
        $districtModel = District::where(function ($query) use ($request) {
            if (!empty($request->province_id)) {
                $query->where('province_id', $request->province_id);
            }
            if (!empty($request->city_id)) {
                $query->where('city_id', $request->city_id);
            }
            if (!empty($request->district)) {
                $query->where('name', 'LIKE', '%'.$request->district.'%');
            }
        })->orderBy('id', 'DESC')->paginate(500);
        return view('City::Admin.District.indexDistrict', compact('districtModel', 'provinceModel', 'cityModel'));
    }

    public function NewDistrict() {
        $provinceModel = Province::where('country_id', 114)->get();
        $cityModel = City::where('province_id',1)->get();
        return view('City::Admin.District.newDistrict', compact('provinceModel', 'cityModel'));
    }

    public function StoreDistrict(Request $request) {
        $Message=[
            'province_id.required'=>'استان نمیتواند خالی باشد',
            'township_id.required'=>'شهرستان نمیتواند خالی باشد',
            'city_id.required'=>'شهر نمیتواند خالی باشد',
            'area_id.required'=>'منطقه نمیتواند خالی باشد',
            'name.required'=>'نام محله نمیتواند خالی باشد',
        ];
        $this->validate($request,[
            'province_id' => 'required',
            'township_id' => 'required',
            'city_id' => 'required',
            'area_id' => 'required',
            'name' => 'required',
        ],$Message);

        $districtModel = new District([
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'area_id' => $request->area_id,
            'township_id' => $request->township_id,
            'name' => $request->name,
            'active' => 1
        ]);
        if($districtModel->save())
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

    public function ActiveDistrict($id) {
        $districtModel = District::where('id', $id)->first();
        if ($districtModel->active == 1) {
            $districtModel->update(['active' => 0]);
            return 'deactive';
        } else {
            $districtModel->update(['active' => 1]);
            return 'active';
        }
    }

    public function EditDistrict($id) {
        $districtModel = District::where('id', $id)->first();
        $provinceModel = Province::where('country_id', 114)->get();
        $cityModel = City::where('province_id', $districtModel->province_id)->get();
        $areaModel = Area::where('city_id', $districtModel->city_id)
            ->where('province_id', $districtModel->province_id)
            ->first();
        return response()->json(view('City::Admin.District.Ajax.AjaxEditModal',compact('districtModel', 'provinceModel', 'cityModel', 'areaModel'))->render());
    }


    public function UpdateDistrict(Request $request) {
        $Message=[
//            'province_id.required'=>'استان نمیتواند خالی باشد',
//            'city_id.required'=>'شهر نمیتواند خالی باشد',
//            'area_id.required'=>'شهر نمیتواند خالی باشد',
            'name.required'=>'محله نمیتواند خالی باشد',
        ];
        $this->validate($request,[
//            'province_id' => 'required',
//            'city_id' => 'required',
//            'area_id' => 'required',
            'name' => 'required',
        ],$Message);
        $districtModel = District::where('id', $request->district_id)->first();
//        $districtModel->province_id = $request->province_id;
//        $districtModel->city_id = $request->city_id;
//        $districtModel->area_id = $request->area_id;
        $districtModel->name = $request->name;
        if($districtModel->save())
        {
            PrintMessage('اطلاعات شما با موفقیت ویرایش شد', 'info');
            return back();
        }
        else
        {
            PrintMessage('عدم موفقیت در ویرایش اطلاعات', 'danger');
            return back();
        }

    }


    public function AjaxDistrict(Request $request) {
        $List=District::where('active','1')
            ->where('city_id', $request->id)
            ->get();
        return response()->json(view('City::Admin.District.Ajax.AjaxDistrictList',compact('List'))->render());
    }

    public function AjaxProvinceDistrict(Request $request) {
        $List=District::where('active','1')
            ->where('province_id',$request->id)
            ->get();
        return response()->json(view('City::Admin.Province.Ajax.AjaxProvinceList',compact('List'))->render());
    }

}
