<?php

namespace App\Modules\ContactUs\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Modules\ContactUs\Model\ContactInfo;
use App\Modules\ContactUs\Model\Contact;

class ContactUsController extends Controller
{

    public function ContactInfo()
    {
        $contactModel = ContactInfo::first();
        return view('frontend.Page.ContactInfo', compact('contactModel'));
    }

    public function ContactUsFormAdmin() {
        $contactModel = ContactInfo::first();
        return view('ContactUs::Admin.formContactUs', compact('contactModel'));
    }

    public function UpdateFormContactUs(Request $request) {
        $Message=[
            'phone.required'=>'تلفن نمیتواند خالی باشد .',
            'email.required'=>'ایمیل نمیتواند خالی باشد .',
            'address.required'=>'آدرس نمیتواند خالی باشد .',
        ];
        $this->validate($request,[
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
        ],$Message);
        $contactInfoModel = ContactInfo::first();
        $contactInfoModel->phone = $request->phone;
        $contactInfoModel->email = $request->email;
        $contactInfoModel->address = $request->address;
        $contactInfoModel->telegram = $request->telegram;
        $contactInfoModel->aparat = $request->aparat;
        $contactInfoModel->whatsapp = $request->whatsapp;
        $contactInfoModel->instagram = $request->instagram;
        $contactInfoModel->latitude = $request->latitude;
        $contactInfoModel->longitude = $request->longitude;
        if($contactInfoModel->save())
        {
            PrintMessage('ویرایش اطلاعات با موفقیت انجام شد','success');
            return back();
        }
        else
        {
            PrintMessage('خطا در ویرایش اطلاعات','danger');
            return back();
        }
    }


    public function StoreContactUser(Request $request) {
        $Message=[
            'name.required'=>'نام و نام خانوادگی نمیتواند خالی باشد .',
            'email.required'=>'ایمیل نمیتواند خالی باشد .',
            'phone.required'=>'تلفن نمیتواند خالی باشد .',
            'subject.required'=>'موضوع نمیتواند خالی باشد .',
//            'category_id.required'=>'موضوع نمیتواند خالی باشد .',
            'content.required'=>'متن پیام نمیتواند خالی باشد .',
        ];
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'subject' => 'required',
//            'category_id' => 'required',
            'content' => 'required',
        ],$Message);
        $contactModel = new Contact();
        $contactModel->name = $request->name;
        $contactModel->email = $request->email;
        $contactModel->phone = $request->phone;
        $contactModel->subject = $request->subject;
        $contactModel->category_id = 1;
        $contactModel->content = $request->content;
        if($contactModel->save())
        {
            PrintMessage('اطلاعات مورد نظر با موفقیت ثبت شد','success');
            return back();
        }
        else
        {
            PrintMessage('خطا در ثبت اطلاعات','danger');
            return back();
        }
    }


    public function IndexContactMessage() {
        $contactModel = Contact::orderBy('view', 'ASC')->get();
        return view('ContactUs::Admin.indexContactMessage', compact('contactModel'));
    }


    public function ReadContactMessage($id) {
        $contactModel = Contact::where('id', $id)->first();
        $contactModel->view = 1;
        $contactModel->save();
        return view('ContactUs::Admin.readContactMessage', compact('contactModel'));
    }


    static function BottomInfo() {
        $contactInfo = ContactInfo::first();
        return $contactInfo;
    }

}