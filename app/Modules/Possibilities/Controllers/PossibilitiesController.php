<?php

namespace App\Modules\Possibilities\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Possibilities\Model\BuildingType;
use App\Modules\Possibilities\Model\Option;
use App\Modules\Possibilities\Model\HomeType;
use App\Modules\Possibilities\Model\PositionType;
use App\Modules\Rules\Model\Rules;

class PossibilitiesController extends Controller
{
    public function IndexPossibilities() {
        $optionModel = Option::orderBy('active', 'DESC')->orderBy('priority', 'ASC')->get();
        return view('Possibilities::indexPossibilities', compact(
            'optionModel'
        ));
    }

    public function StoreOption(Request $request) {
        $Message=[
            'option.required'=>'عنوان نمیتواند خالی باشد .',
            'file.required'=>'تصویر نمیتواند خالی باشد .',
        ];
        $this->validate($request,[
            'option' => 'required',
            'file' => 'required',
        ],$Message);
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $filename = auth()->user()->mobile.'-'.time(). '.' .$image->getClientOriginalExtension();
            $image->move('Uploaded/Possibilities/Option', $filename);
        } else {
            $filename = 'option.png';
        }
        $optionModel = new Option();
        $optionModel->name = $request->option;
        $optionModel->type = $request->type;
        $optionModel->img = $filename;
        $optionModel->description = $request->description;
        if($optionModel->save())
        {
            PrintMessage('ثبت امکانات ساختمان موفقیت آمیز بود.','success');
            return redirect(route('IndexPossibilities'));
        }
        else
        {
            PrintMessage('ثبت امکانات ساختمان موفقیت آمیز نبود.','danger');
            return redirect(route('IndexPossibilities'));
        }
    }

    public function EditOption($id) {
        $optionModel = Option::where('id', $id)->first();
        return response()->json(view('Possibilities::Ajax.AjaxEditOption',compact('optionModel'))->render());
    }

    public function UpdateOption(Request $request) {
        $optionModel = Option::findOrfail($request->option_id);
        $Message=[
            'name.required'=>'عنوان نمیتواند خالی باشد .',
            'priority.required'=>'اولویت نمیتواند خالی باشد .',
        ];
        $this->validate($request,[
            'name' => 'required',
            'priority' => 'required',
        ],$Message);
        $oldImg = $optionModel->img;
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $filename = auth()->user()->mobile.'-'.time(). '.' .$image->getClientOriginalExtension();
            $image->move('Uploaded/Possibilities/Option', $filename);
            if(!empty($oldImg))
            {
                if(file_exists('Uploaded/Possibilities/Option/'.$oldImg))
                {
                    unlink('Uploaded/Possibilities/Option/'.$oldImg);
                }
            }
        }
        else
        {
            $filename = $oldImg;
        }
        $optionModel->name = $request->name;
        $optionModel->img = $filename;
        $optionModel->description = $request->description;
        $optionModel->priority = $request->priority;
        if($optionModel->save())
        {
            PrintMessage('ویرایش نوع ساختمان موفقیت آمیز بود.','info');
            return redirect(route('IndexPossibilities'));
        }
        else
        {
            PrintMessage('ویرایش نوع ساختمان موفقیت آمیز نبود.','danger');
            return redirect(route('IndexPossibilities'));
        }
    }

    public function ActiveOption($id) {
        $optionModel = Option::where('id', $id)->first();
        if ($optionModel->active == 1)
        {
            Option::where('id', $id)
                ->update(['active' => 0]);
            return 'deactive';
        }
        elseif ($optionModel->active == 0)
        {
            Option::where('id', $id)
                ->update(['active' => 1]);
            return 'active';
        }
    }


    /*
     * Home Type
     * */


    public function IndexHomeType() {
        $homeTypeModel = HomeType::all();
        return view('Possibilities::indexHomeType', compact(
            'homeTypeModel'
        ));
    }

    public function StoreHomeType(Request $request) {
        $Message=[
            'name.required'=>'عنوان نمیتواند خالی باشد .',
        ];
        $this->validate($request,[
            'name' => 'required',
        ],$Message);
        $homeTypeModel = new HomeType();
        $homeTypeModel->name = $request->name;
        if($homeTypeModel->save())
        {
            PrintMessage('ثبت نوع خانه موفقیت آمیز بود.','success');
            return redirect(route('IndexHomeType'));
        }
        else
        {
            PrintMessage('ثبت نوع خانه موفقیت آمیز نبود.','danger');
            return redirect(route('IndexHomeType'));
        }
    }

    public function EditHomeType($id) {
        $homeTypeModel = HomeType::where('id', $id)->first();
        return response()->json(view('Possibilities::Ajax.AjaxEditHomeType',compact('homeTypeModel'))->render());
    }

    public function UpdateHomeType(Request $request) {
        $homeTypeModel = HomeType::findOrfail($request->homeType_id);
        $Message=[
            'name.required'=>'عنوان نمیتواند خالی باشد .',
        ];
        $this->validate($request,[
            'name' => 'required',
        ],$Message);
        $homeTypeModel->name = $request->name;
        if($homeTypeModel->save())
        {
            PrintMessage('ویرایش نوع خانه موفقیت آمیز بود.','info');
            return redirect(route('IndexHomeType'));
        }
        else
        {
            PrintMessage('ویرایش نوع خانه موفقیت آمیز نبود.','danger');
            return redirect(route('IndexHomeType'));
        }
    }

    public function ActiveHomeType($id) {
        $homeTypeModel = HomeType::where('id', $id)->first();
        if ($homeTypeModel->active == 1)
        {
            HomeType::where('id', $id)
                ->update(['active' => 0]);
            return 'deactive';
        }
        elseif ($homeTypeModel->active == 0)
        {
            HomeType::where('id', $id)
                ->update(['active' => 1]);
            return 'active';
        }
    }


    /*
     * Building Type
     * */


    public function IndexBuildingType() {
        $buildingTypeModel = BuildingType::all();
        return view('Possibilities::indexBuildingType', compact(
            'buildingTypeModel'
        ));
    }

    public function StoreBuildingType(Request $request) {
        $Message=[
            'name.required'=>'عنوان نمیتواند خالی باشد .',
        ];
        $this->validate($request,[
            'name' => 'required',
        ],$Message);
        $buildingTypeModel = new BuildingType();
        $buildingTypeModel->name = $request->name;
        if($buildingTypeModel->save())
        {
            PrintMessage('ثبت نوع خانه موفقیت آمیز بود.','success');
            return redirect(route('IndexBuildingType'));
        }
        else
        {
            PrintMessage('ثبت نوع خانه موفقیت آمیز نبود.','danger');
            return redirect(route('IndexBuildingType'));
        }
    }

    public function EditBuildingType($id) {
        $buildingTypeModel = BuildingType::where('id', $id)->first();
        return response()->json(view('Possibilities::Ajax.AjaxEditBuildingType',compact('buildingTypeModel'))->render());
    }

    public function UpdateBuildingType(Request $request) {
        $buildingTypeModel = BuildingType::findOrfail($request->buildingType_id);
        $Message=[
            'name.required'=>'عنوان نمیتواند خالی باشد .',
        ];
        $this->validate($request,[
            'name' => 'required',
        ],$Message);
        $buildingTypeModel->name = $request->name;
        if($buildingTypeModel->save())
        {
            PrintMessage('ویرایش نوع خانه موفقیت آمیز بود.','info');
            return redirect(route('IndexBuildingType'));
        }
        else
        {
            PrintMessage('ویرایش نوع خانه موفقیت آمیز نبود.','danger');
            return redirect(route('IndexBuildingType'));
        }
    }

    public function ActiveBuildingType($id) {
        $buildingTypeModel = BuildingType::where('id', $id)->first();
        if ($buildingTypeModel->active == 1)
        {
            BuildingType::where('id', $id)
                ->update(['active' => 0]);
            return 'deactive';
        }
        elseif ($buildingTypeModel->active == 0)
        {
            BuildingType::where('id', $id)
                ->update(['active' => 1]);
            return 'active';
        }
    }

    public static function GetBuildingType() {
        $buildingTypeModel = BuildingType::where('active', 1)->get();
        return $buildingTypeModel;
    }

    public static function GetHomeType() {
        $homeTypeModel = HomeType::where('active', 1)->get();
        return $homeTypeModel;
    }

    public static function GetPositionType1() {
        $homePositionModel = PositionType::where('active', 1)->where('type', 1)->get();
        return $homePositionModel;
    }

    public static function GetPositionType2() {
        $homePositionModel = PositionType::where('active', 1)->where('type', 2)->get();
        return $homePositionModel;
    }

    public static function GetOption() {
        $optionModel = Option::where('active', 1)->where('type', 1)->orderBy('priority', 'ASC')->get();
        return $optionModel;
    }

    public static function GetService() {
        $optionModel = Option::where('active', 1)->where('type', 2)->orderBy('priority', 'ASC')->get();
        return $optionModel;
    }

    /*
     * Position Type
     * */


    public function IndexPositionType() {
        $positionTypeModel = PositionType::all();
        return view('Possibilities::indexPositionType', compact(
            'positionTypeModel'
        ));
    }

    public function StorePositionType(Request $request) {
        $Message=[
            'name.required'=>'عنوان نمیتواند خالی باشد .',
        ];
        $this->validate($request,[
            'name' => 'required',
        ],$Message);
        $positionTypeModel = new PositionType();
        $positionTypeModel->name = $request->name;
        if($positionTypeModel->save())
        {
            PrintMessage('ثبت نوع خانه موفقیت آمیز بود.','success');
            return redirect(route('IndexPositionType'));
        }
        else
        {
            PrintMessage('ثبت نوع خانه موفقیت آمیز نبود.','danger');
            return redirect(route('IndexPositionType'));
        }
    }

    public function EditPositionType($id) {
        $positionTypeModel = PositionType::where('id', $id)->first();
        return response()->json(view('Possibilities::Ajax.AjaxEditPositionType',compact('positionTypeModel'))->render());
    }

    public function UpdatePositionType(Request $request) {
        $positionTypeModel = PositionType::findOrfail($request->positionType_id);
        $Message=[
            'name.required'=>'عنوان نمیتواند خالی باشد .',
        ];
        $this->validate($request,[
            'name' => 'required',
        ],$Message);
        $positionTypeModel->name = $request->name;
        if($positionTypeModel->save())
        {
            PrintMessage('ویرایش نوع خانه موفقیت آمیز بود.','info');
            return redirect(route('IndexPositionType'));
        }
        else
        {
            PrintMessage('ویرایش نوع خانه موفقیت آمیز نبود.','danger');
            return redirect(route('IndexPositionType'));
        }
    }

    public function ActivePositionType($id) {
        $positionTypeModel = PositionType::where('id', $id)->first();
        if ($positionTypeModel->active == 1)
        {
            PositionType::where('id', $id)
                ->update(['active' => 0]);
            return 'deactive';
        }
        elseif ($positionTypeModel->active == 0)
        {
            PositionType::where('id', $id)
                ->update(['active' => 1]);
            return 'active';
        }
    }

}
