<?php

namespace App\Modules\City\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\City\Model\District;
use App\Modules\Menu\Model\Menu;
use App\Modules\City\Model\Province;
use App\Modules\City\Model\City;
use App\Modules\City\Model\Area;
use App\Modules\City\Model\Township;

class TownshipController extends Controller
{

    public function IndexTownship() {
        $provinceModel = Province::all();
        $townshipModel = Township::orderBy('priority', 'DESC')->get();
        return view('City::Admin.Township.indexTownship', compact('townshipModel', 'provinceModel'));
    }

    public function StoreTownship(Request $request) {
        $Message = [
            'name.required' => 'نام شهرستان نمیتواند خالی باشد',
            'name.unique' => 'نام شهرستان قبلا در سیستم ثبت شده است',
            'province_id.required' => 'نام استان نمیتواند خالی باشد',
        ];
        $this->validate($request, [
            'name' => 'required|unique:townships,name',
            'province_id' => 'required',
        ],$Message);
        $townshipModel = new Township();
        $townshipModel->name = $request->name;
        $townshipModel->province_id = $request->province_id;
        if($townshipModel->save())
        {
            PrintMessage('ثبت شهرستان با موفقیت انجام شد', 'info');
            return back();
        }
        else {
            PrintMessage('ثبت شهرستان انجام نشد', 'danger');
            return back();
        }
    }

    public function EditTownship($id) {
        $townshipModel = Township::where('id', $id)->first();
        return response()->json(view('City::Admin.Township.Ajax.AjaxEditModal',compact('townshipModel'))->render());
    }


    public function UpdateTownship(Request $request) {
//        $township = Township::where('priority', $request->priority)->first();
//        if(isset($township))
//        {
//            PrintMessage('اولویت وارد شده در سیستم ثبت شده است', 'danger');
//            return back();
//        }
        $townshipModel = Township::where('id', $request->township_id)->first();
        $townshipModel->name = $request->name;
        $townshipModel->priority = $request->priority;
        if($townshipModel->save())
        {
            PrintMessage('ویرایش با موفقیت انجام شد', 'info');
            return back();
        }
        else {
            PrintMessage('ویرایش انجام نشد', 'danger');
            return back();
        }
    }

    public function ActiveTownship($id) {
        $townshipModel = Township::where('id', $id)->first();
        if($townshipModel->active == 1)
        {
            $townshipModel->active = 0;
            $townshipModel->save();
            return 'deactive';
        }
        else
        {
            $townshipModel->active = 1;
            $townshipModel->save();
            return 'active';
        }
    }



    /*
     *
     * ajax list township
     *
     * */
    public function AjaxTownshipList(Request $request)
    {
        $List=Township::where('active','1')
            ->where('province_id',$request->id)
            ->get();
        return response()->json(view('City::Admin.Township.Ajax.AjaxTownshipList',compact('List'))->render());
    }



    public static function TownshipLink() {
        $menuModel = Menu::where('id', 4)->first();
        $townshipModel = Township::where('active', 1)->orderBy('priority', 'DESC')->get();
        $cityModel = City::where('active', 1)->get();
        $res = array();
        $res[] = $townshipModel;
        $res[] = $cityModel;
        $res[] = $menuModel;
        return $res;
    }
}
