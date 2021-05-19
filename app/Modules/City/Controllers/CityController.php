<?php

namespace App\Modules\City\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\City\Model\City;
use App\Modules\City\Model\Country;
use App\Modules\City\Model\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    public function IndexCity() {
        $provinceModel = Province::all();
        $cityModel = City::all();
        return view('City::Admin.City.indexCity', compact('cityModel', 'provinceModel'));
    }

    public function StoreCity(Request $request) {
        $Message = [
            'name.required' => 'نام شهر نمیتواند خالی باشد',
            'name.unique' => 'نام شهر قبلا در سیستم ثبت شده است',
            'province_id.required' => 'نام استان نمیتواند خالی باشد',
            'township_id.required' => 'نام شهرستان نمیتواند خالی باشد',
        ];
        $this->validate($request, [
            'name' => 'required|unique:cities,name',
            'province_id' => 'required',
            'township_id' => 'required',
        ],$Message);
        $cityModel = new City();
        $cityModel->name = $request->name;
        $cityModel->province_id = $request->province_id;
        $cityModel->township_id = $request->township_id;
        if($cityModel->save())
        {
            PrintMessage('ثبت شهر با موفقیت انجام شد', 'success');
            return back();
        }
        else {
            PrintMessage('ثبت شهر انجام نشد', 'danger');
            return back();
        }
    }

    public function EditCity($id) {
        $cityModel = City::where('id', $id)->first();
        return response()->json(view('City::Admin.City.Ajax.AjaxEditModal',compact('cityModel'))->render());
    }


    public function UpdateCity(Request $request) {
        $cityModel = City::where('id', $request->city_id)->first();
        $cityModel->name = $request->name;
        if($cityModel->save())
        {
            PrintMessage('ویرایش با موفقیت انجام شد', 'info');
            return back();
        }
        else {
            PrintMessage('ویرایش انجام نشد', 'danger');
            return back();
        }
    }


    public function ActiveCity($id) {
        $cityModel = City::where('id', $id)->first();
        if($cityModel->active == 1)
        {
            $cityModel->active = 0;
            $cityModel->save();
            return 'deactive';
        }
        else
        {
            $cityModel->active = 1;
            $cityModel->save();
            return 'active';
        }
    }



    /*
     *
     * ajax list township
     *
     * */
    public function AjaxCityList(Request $request)
    {
        $List=City::where('active','1')
            ->where('township_id',$request->id)
            ->get();
        return response()->json(view('City::Admin.City.Ajax.AjaxCityList',compact('List'))->render());
    }
}
