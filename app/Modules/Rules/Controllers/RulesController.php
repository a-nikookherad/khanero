<?php

namespace App\Modules\Rules\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Rules\Model\Rule;
use App\Modules\Rules\Model\CancelRule;

class RulesController extends Controller
{

    /*
     * Rule
     * */


    public function IndexRule() {
        $ruleModel = Rule::all();
        return view('Rules::indexRule', compact(
            'ruleModel'
        ));
    }

    public function StoreRule(Request $request) {
        $Message=[
            'name.required'=>'عنوان نمیتواند خالی باشد .',
        ];
        $this->validate($request,[
            'name' => 'required',
        ],$Message);
        $ruleModel = new Rule();
        $ruleModel->name = $request->name;
        if($ruleModel->save())
        {
            PrintMessage('ثبت نوع خانه موفقیت آمیز بود.','success');
            return redirect(route('IndexRule'));
        }
        else
        {
            PrintMessage('ثبت نوع خانه موفقیت آمیز نبود.','danger');
            return redirect(route('IndexRule'));
        }
    }

    public function EditRule($id) {
        $ruleModel = Rule::where('id', $id)->first();
        return response()->json(view('Rules::Ajax.AjaxEditRule',compact('ruleModel'))->render());
    }

    public function UpdateRule(Request $request) {
        $ruleModel = Rule::findOrfail($request->rule_id);
        $Message=[
            'name.required'=>'عنوان نمیتواند خالی باشد .',
        ];
        $this->validate($request,[
            'name' => 'required',
        ],$Message);
        $ruleModel->name = $request->name;
        $ruleModel->description = $request->description;
        if($ruleModel->save())
        {
            PrintMessage('ویرایش نوع خانه موفقیت آمیز بود.','info');
            return redirect(route('IndexRule'));
        }
        else
        {
            PrintMessage('ویرایش نوع خانه موفقیت آمیز نبود.','danger');
            return redirect(route('IndexRule'));
        }
    }

    public function ActiveRule($id) {
        $ruleModel = Rule::where('id', $id)->first();
        if ($ruleModel->active == 1)
        {
            Rule::where('id', $id)
                ->update(['active' => 0]);
            return 'deactive';
        }
        elseif ($ruleModel->active == 0)
        {
            Rule::where('id', $id)
                ->update(['active' => 1]);
            return 'active';
        }
    }


    public static function GetRules() {
        $rulesModel = Rule::where('active', 1)->get();
        return $rulesModel;
    }


    public static function GetCancelRules() {
        $cancelRuleModel = CancelRule::all();
        return $cancelRuleModel;
    }

}
