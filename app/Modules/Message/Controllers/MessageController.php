<?php

namespace App\Modules\Message\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Message\Model\Message;
use Melipayamak;
use App\User;

class MessageController extends Controller
{

    public function IndexMessage() {
        $messageModel = Message::where('sms', 0)
            ->where(function ($Q){
                $Q->orWhere('sender_id', auth()->user()->id);
                $Q->orWhere('receiver_id', auth()->user()->id);
            })
            ->orderBy('view', 'ASC')
            ->get();

        $array_id = array();
        foreach ($messageModel as $key => $value) {
            $array_id[] = $value->sender_id;
            $array_id[] = $value->receiver_id;
        }
        $new_array_id_user = array_unique($array_id);

        foreach ($new_array_id_user as $key => $value) {
            if($value == auth()->user()->id) {
                unset($new_array_id_user[$key]);
            }
        }

        $array_user = array();
        foreach ($new_array_id_user as $key => $value) {
            $userModel = User::where('id', $value)->first();
            if(!empty($userModel)) {
                $array_user[] = array(
                    'id' => $value,
                    'name' => $userModel->first_name.' '.$userModel->last_name
                );
            }
        }


        return view('Message::indexMessage', compact('array_user'));

    }

    public function IndexSendMessage() {

    }

    public function StoreMessageForHostUser(Request $request) {
        PrintMessage('ارسال پیام موفقیت آمیز بود.', 'success');
        return back();
    }

    public function StoreMessage(Request $request) {
        if($request->ajax()){
            if($request->message == null || strlen($request->message) < 2)
            {
                $Response = ["Success" => "0", "Message" => 'حداقل تعداد کاراکتر ها باید بیش از 2 حرف باشد'];
                return response()->json($Response);
            }
        } else {
            $Message = [
                'title.required' => 'فیلد عنوان پیام نمیتواند خالی باشد .',
                'message.required' => 'فیلد متن پیام نمیتواند خالی باشد .',
                'receiver_id.required' => ' خطا در ارسال اطلاعات لطفا مجددا تلاش نمایید .',
            ];
            $this->validate($request, [
                'title' => 'required',
                'message' => 'required',
                'receiver_id' => 'required',
            ], $Message);
        }
        if($request->receiver_id == auth()->user()->id) {
            PrintMessage('خطا در ورودی اطلاعات .', 'danger');
            return back();
        }



        $array_key = array(
            '09',
            '91',
            '9 1',
            '0 9',
            'صفر',
            'نهصد',
            '02',
            '0',
            '9',
            '33',
            '36',
            '39',
            '38',
            '37',
            '12',
            '19',
        );
        foreach ($array_key as $key => $value) {
            if (strpos($request->message, $value) !== false) {
                $Response = ["Success" => "-1", "Message" => 'شما هنگام گفت و گو با میزبان/مهمان اقدام به ارسال اطلاعات تماس خود کرده اید، این برخلاف قوانین سایت می باشد'];
                return response()->json($Response);
            }
        }


        $userModel = User::where('id', $request->receiver_id)->first();
        $messageModel = new Message();
        $messageModel->sender_id = auth()->user()->id;
        $messageModel->receiver_id = $request->receiver_id;
        $messageModel->title = $request->title;
        $messageModel->message = $request->message;
        $messageModel->view = 0;
        $messageModel->parent_id = 0;
        if($messageModel->save())
        {

            try {
                $sms = melipayamak::sms();
                $to = $userModel->mobile;
                $from = '5000106001176';
$text = 'پیام جدید از مهمان/میزبان
برای مشاهده پیام به پنل کاربری خود مراجعه کنید
www.rentt.ir/index/message
';
                $sms->send($to, $from, $text);
            } catch (Exception $e) {
                echo $e->getMessage();
            }



            if($request->ajax()) {
                $Response = ["Success" => "1", "Message" => 'ثبت پیام موفقیت آمیز بود'];
                return response()->json($Response);
            } else {
                PrintMessage('ثبت پیام موفقیت آمیز بود .', 'success');
                return back();
            }
        } else {
            PrintMessage('خطا در ورودی اطلاعات .', 'danger');
            return back();
        }
    }

    public function ReadMessage($id) {
        $userModel = User::where('id', $id)->first();
        $messageModel = Message::where('sms', 0)
            ->where(function ($Q){
                $Q->orWhere('sender_id', auth()->user()->id);
                $Q->orWhere('receiver_id', auth()->user()->id);
            })
            ->where(function ($Q) use ($id){
                $Q->orWhere('sender_id', $id);
                $Q->orWhere('receiver_id', $id);
            })
            ->orderBy('id', 'ASC')
            ->get();
        foreach ($messageModel as $key => $value) {
            if($value->view == 0 && $value->receiver_id == auth()->user()->id) {
                Message::where('id', $value->id)->update(['view' => 1]);
            }
        }
        return response()->json(view('Message::Ajax.AjaxReadMessage', compact('messageModel', 'userModel'))->render());
    }

    public function StoreReplyMessage(Request $request) {
        $Message = [
            'title.required' => 'فیلد عنوان پیام نمیتواند خالی باشد .',
            'message.required' => 'فیلد متن پیام نمیتواند خالی باشد .',
        ];
        $this->validate($request, [
            'title' => 'required',
            'message' => 'required',
        ], $Message);
//        if ($request->hasFile('file')) {
//            $file = $request->file('file');
//            $filename = str_random(4).'-'.time(). '.' .$file->getClientOriginalExtension();
//            $file->move('Uploaded/message', $filename);
//        }
//        else
//        {
//            $filename = '';
//        }
        $messageModel = new Message($request->all());
        $messageModel->sender_id = auth()->user()->id;
        $messageModel->receiver_id = $request->receiver_id;
        $messageModel->title = $request->title;
        $messageModel->message = $request->message;
//        $messageModel->file = $filename;
        $messageModel->view = 0;
        $messageModel->parent_id = $request->parent_id;
        if($messageModel->save())
        {
            $messageModel = Message::where('id', $request->parent_id)->first();
            $messageModel->reply = 1;
            if($messageModel->save())
            {
                PrintMessage('ارسال پیام موفقیت آمیز بود','success');
                return redirect(route('IndexMessage'));
            }
            else
            {
                PrintMessage('ارسال پیام انجام نشد','danger');
                return redirect(route('IndexMessage'));
            }
        }
    }

    public function MessageGetNumber($id) {
        $messageModel = Message::where('receiver_id', auth()->user()->id)->where('view', 0)->count();
        return $messageModel;
    }

}
