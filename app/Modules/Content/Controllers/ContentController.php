<?php

namespace App\Modules\Content\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Content\Model\Content;

class ContentController extends Controller
{
    public function IndexContent() {
        $contentModel = Content::all();
        return view('Content::indexContent', compact('contentModel'));
    }


    public function CreateContent() {  
        return view('Content::createContent');
    }


    public function StoreContent(Request $request) {
        $Message=[
            'title.required'=>'عنوان نميتواند خالی باشد .',
            'content.required'=>'متن محتوا نمیتواند خالی باشد .',
            'content.unique'=>'متن محتوا قبلا در سیستم ثبت شده است .',
        ];
        $this->validate($request,[
            'title' => 'required|unique:contents',
            'content' => 'required',
        ],$Message);
        $alias = str_replace(' ', '-', $request->title);
        if($request->active == 'on')
        {
            $active = 1;
        }
        else
        {
            $active = 0;
        }
        $contentModel = new Content();
        $contentModel->alias = $alias;
        $contentModel->title = $request->title;
        $contentModel->content = $request->content;
        $contentModel->type = $request->type;
        $contentModel->active = $active;
        if($contentModel->save())
        {
            PrintMessage('ثبت محتوا با موفقیت انجام شد','success');
            return redirect(route('IndexContent'));
        }
        else
        {
            PrintMessage('خطا در ثبت اطلاعات لطفا مجددا سعی کنید','danger');
            return back();
        }
    }


    public function EditContent($id) {
        $contentModel = Content::where('id', $id)->first();
        return view('Content::updateContent', compact('contentModel'));
    }


    public function UpdateContent(Request $request) {
        $Message=[
            'title.required'=>'عنوان نميتواند خالی باشد .',
            'content.required'=>'متن محتوا نمیتواند خالی باشد .',
        ];
        $this->validate($request,[
            'title' => 'required|unique:contents,title,'.$request->content_id,
            'content' => 'required',
        ],$Message);
        $alias = str_replace(' ', '-', $request->title);
        if($request->active == 'on')
        {
            $active = 1;
        }
        else
        {
            $active = 0;
        }
        $contentModel = Content::where('id', $request->content_id)->first();
        $contentModel->alias = $alias;
        $contentModel->title = $request->title;
        $contentModel->content = $request->content;
        $contentModel->type = $request->type;
        $contentModel->active = $active;

        if($contentModel->save())
        {
            PrintMessage('ویرایش محتوا با موفقیت انجام شد','info');
            return redirect(route('IndexContent'));
        }
        else
        {
            PrintMessage('خطا در ثبت اطلاعات لطفا مجددا سعی کنید','danger');
            return back();
        }
    }

    public function ActiveContent($id) {
        $contentModel = Content::where('id', $id)->first();
        if ($contentModel->active == 1)
        {
            Content::where('id', $id)
                ->update(['active' => 0]);
            return 'deactive';
        }
        elseif ($contentModel->active == 0)
        {
            Content::where('id', $id)
                ->update(['active' => 1]);
            return 'active';
        }
    }

    public function PageContent($alias) {
        $contentModel = Content::where('alias', $alias)->first();
        return view('frontend.Page.ContentPage', compact('contentModel'));
    }

    public static function TopLink() {
        $contentModel = Content::where('active', 1)->where('type', 1)->get();
        return $contentModel;
    }

    public static function BottomLink() {
        $contentModel = Content::where('active', 1)->where('type', 1)->get();
        return $contentModel;
    }

    public static function BottomLink_2() {
        $contentModel = Content::where('active', 1)->where('type', 2)->get();
        return $contentModel;
    }

    public static function Magazine() {
        $contentModel = Content::where('active', 1)->where('type', 2)->get();
        return $contentModel;
    }

    public static function AboutLink() {
        $contentModel = Content::where('alias', 'درباره-ما')->first();
        return $contentModel;
    }
}
