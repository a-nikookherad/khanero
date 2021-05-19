<?php

namespace App\Modules\City\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\City\Model\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CountryController extends Controller
{
    //country list
    public function CountryList()
    {
        $Country=Country::orderBy('priority')->get();
        return view('City::Admin.Country.List',compact('Country'));
    }


    //change status
    public function ChangeStatus(Request $request)
    {
        $Country=Country::find($request->id);
        $Country->active=!($Country->active);
        if($Country->save())
        {
            $Response=["Message"=>'عملیات مورد نظر با موفقیت صورت گرفت'];
        }
        else
        {
            $Response=["Message"=>'خطا در انجام عملیات ، لطفا مجددا امتحان کنید'];
        }

        return response()->json($Response);
    }


    //delete country
    public function DeleteCountry(Request $request)
    {
        $Country=Country::find($request->id);
        if(count($Country)<1){abort(503);}

        if(count($Country->province)>0){
            PrintMessage('برای این کشور استان ثبت شده و قابل حذف نمی باشد.لطفا ابتدا استان ها را حذف نمایید','danger');
            return back();
        }

        if($Country->delete())
        {
            PrintMessage('عملیات مورد نظر با موفقیت صورت گرفت','success');
        }
        else
        {
            PrintMessage('خطا در انجام عملیات ، لطفا مجددا امتحان کنید','danger');
        }

        return back();
    }


    //edit country
    public function EditCountry(Request $request)
    {
        $Country=Country::find($request->id);

        $Message=[
            'name.required'=>'وارد کردن نام کشور الزامی است',
            'name.unique'=>'این کشور قبلا ثبت شده است'
        ];
        $validator=Validator::make($request->all(),[
            'name'=>'required|unique:countries,country_name,'.$Country->id
        ],$Message);

        if($validator->fails())
        {
            $errors=$validator->errors();
            $Response=["Success"=>"0","Message"=>$errors->first()];
            return response()->json($Response);
        }

        $Country->country_name=$request->name;
        if($Country->save())
        {
            $Response=["Success"=>"1","Message"=>'عملیات مورد نظر با موفقیت صورت گرفت'];
        }
        else
        {
            $Response=["Success"=>"0","Message"=>'خطا در انجام عملیات ، لطفا مجددا امتحان کنید'];
        }
        return response()->json($Response);
    }


    //add country
    public function AddCountry(Request $request)
    {
        $Message=[
            'name.required'=>'وارد کردن نام کشور الزامی است',
            'name.unique'=>'این کشور قبلا ثبت شده است'
        ];
        $validator=Validator::make($request->all(),[
            'name'=>'required|unique:countries,country_name,'
        ],$Message);

        if($validator->fails())
        {
            $errors=$validator->errors();
            $Response=["Success"=>"0","Message"=>$errors->first()];
            return response()->json($Response);
        }

        $Country=new Country(['country_name'=>$request->name]);

        if($Country->save())
        {
            $Response=["Success"=>"1","Message"=>'عملیات مورد نظر با موفقیت صورت گرفت'];
        }
        else
        {
            $Response=["Success"=>"0","Message"=>'خطا در انجام عملیات ، لطفا مجددا امتحان کنید'];
        }
        return response()->json($Response);


    }
}
