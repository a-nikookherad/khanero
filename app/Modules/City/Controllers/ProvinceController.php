<?php

namespace App\Modules\City\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\City\Model\Country;
use App\Modules\City\Model\Province;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ProvinceController extends Controller
{
    //

    /*
     * ProvinceList
     * */

    public function ProvinceList(Request $request)
    {
        $List=Province::where('country_id',$request->id)->get();
        $Country=Country::where('active','1')->orderBy('priority')->get();
        $ID=$request->id;
        return view('City::Admin.Province.List',compact('List','Country','ID'));
    }

    //add
    public function AddProvince(Request $request)
    {
        $Message=[
            'name.required'=>'وارد کردن نام استان الزامی است',
            'name.unique'=>'این استان قبلا ثبت شده است',
            'country.required'=>'انتخاب کشور الزامی است'
        ];
        $validator=Validator::make($request->all(),[
            'name'=>'required|unique:provinces,name,',
            'country'=>'required'
        ],$Message);
        if($validator->fails())
        {
            $errors=$validator->errors();
            $Response=["Success"=>"0","Message"=>$errors->first()];
            return response()->json($Response);
        }

        $Province=new Province([
            'name'=>$request->name,
            'country_id'=>$request->country
        ]);

        if($Province->save())
        {
            $Response=["Success"=>"1","Message"=>'عملیات مورد نظر با موفقیت صورت گرفت'];
        }
        else
        {
            $Response=["Success"=>"0","Message"=>'خطا در انجام عملیات ، لطفا مجددا امتحان کنید'];
        }
        return response()->json($Response);
    }


    //edit
    public function EditProvince(Request $request)
    {
        $Province=Province::find($request->id);

        $Message=[
            'name.required'=>'وارد کردن نام استان الزامی است',
            'name.unique'=>'این استان قبلا ثبت شده است',
            'country.required'=>'انتخاب کشور الزامی است'
        ];
        $validator=Validator::make($request->all(),[
            'name'=>'required|unique:provinces,name,'.$Province->id,
            'country'=>'required'
        ],$Message);
        if($validator->fails())
        {
            $errors=$validator->errors();
            $Response=["Success"=>"0","Message"=>$errors->first()];
            return response()->json($Response);
        }
        $Province->name=$request->name;
        $Province->country_id=$request->country;

        if($Province->save())
        {
            $Response=["Success"=>"1","Message"=>'عملیات مورد نظر با موفقیت صورت گرفت'];
        }
        else
        {
            $Response=["Success"=>"0","Message"=>'خطا در انجام عملیات ، لطفا مجددا امتحان کنید'];
        }
        return response()->json($Response);
    }


    //change status
    public function ChangeStatus(Request $request)
    {
        $Province=Province::find($request->id);
        $Province->active=!($Province->active);
        if($Province->save())
        {
            $Response=['Message'=>'عملیات مورد نظر با موفقیت انجام گرفت'];
        }
        else
        {
            $Response=['Message'=>'خطا در انجام عملیات ، لطفا مجددا امتحان کنید'];
        }

        return response()->json($Response);
    }


    //delete
    public function DeleteProvince(Request $request)
    {
        $Province=Province::find($request->id);
        if(count($Province)<1){abort(503);}

        if(count($Province->city)>0){
            PrintMessage('برای این استان  ، شهر ثبت شده و قابل حذف نمی باشد.لطفا ابتدا شهر ها را حذف نمایید','danger');
            return back();
        }

        if($Province->delete())
        {
            PrintMessage('عملیات مورد نظر با موفقیت صورت گرفت','success');
        }
        else
        {
            PrintMessage('خطا در انجام  عملیات ، لطفا مجددا امتحان کنید','danger');
        }

        return back();
    }



    /*
     *
     * ajax get province
     *
     * */
    public function GetProvinceList(Request $request)
    {
        $Province=Province::where('active','1')->where('country_id',$request->id)->get();
        if($request->has('name')){$Name=$request->input('name');}
        else {$Name='Province';}

        if($request->has('old')){$Old=$request->input('old');}
        else {$Old=0;}

        return response()->json(view('City::Admin.Province.Ajax.GetList',compact('Province','Name','Old'))->render());
    }




    /*
     *
     * ajax register province
     *
     * */
    public function AjaxProvinceList(Request $request)
    {
        $List=Province::where('active','1')->where('country_id',$request->id)->get();
        $Response=["Province"=>$List[0]->id,"View"=>view('City::Admin.Province.Ajax.AjaxProvinceList',compact('List'))->render()];
        return response()->json($Response);
    }
}
