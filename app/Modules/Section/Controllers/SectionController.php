<?php

namespace App\Modules\Section\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Section\Model\Sections;
use Morilog\Jalali\Facades\jDate;
use Morilog\Jalali\Facades\jDateTime;
use App\User;
use Carbon\Carbon;
use DB;

class SectionController extends Controller
{
    public function IndexSection() {
        $sectionModel = Sections::first();
        return view('Section::IndexSection', compact('sectionModel'));
    }
    public function UpdateSection(Request $request) {
        $sectionModel = Sections::first();
        if ($request->hasFile('img1')) {
            $file1 = $request->img1;
            $filename1 = str_random(6) . time() . '.' . $file1->getClientOriginalExtension();
            if ($file1->move('Uploaded/', $filename1)) {
                $sectionModel->img1 = $filename1;
                $sectionModel->save();
            }
        }
        if ($request->hasFile('img2')) {
            $file2 = $request->img2;
            $filename2 = str_random(6) . time() . '.' . $file2->getClientOriginalExtension();
            if ($file2->move('Uploaded/', $filename2)) {
                $sectionModel->img2 = $filename2;
                $sectionModel->save();
            }
        }
        if ($request->hasFile('img3')) {
            $file3 = $request->img3;
            $filename3 = str_random(6) . time() . '.' . $file3->getClientOriginalExtension();
            if ($file3->move('Uploaded/', $filename3)) {
                $sectionModel->img3 = $filename3;
                $sectionModel->save();
            }
        }
        $sectionModel->content1 = $request->content1;
        $sectionModel->content2 = $request->content2;
        $sectionModel->content3 = $request->content3;
        if($sectionModel->save()) {
            PrintMessage('ویرایش با موفقیت انجام شد', 'success');
            return redirect(route('IndexSection'));
        } else {
            PrintMessage('عدم موفقیت در ثیت ویرایش', 'danger');
            return redirect(route('IndexSection'));
        }
    }
}