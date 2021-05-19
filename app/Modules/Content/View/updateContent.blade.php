@extends('backend.MasterPage.Layout')
@section('title', TitlePage('ویرایش محتوا'))
@section('style')
    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap3-wysiwyg5.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/select2-bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/switchery.min.css') }}">
    <style>
        body .mce-ico {
            font-family: 'tinymce', Arial !important;
        }
    </style>
@endsection

@section('content')
    <script src="{{asset('backend/assets/tinymcenew/tinymce.min.js')}}"></script>
    <script src="{{asset('backend/assets/tinymcenew/editor.js')}}"></script>
    <div class="row back-url">
        <div class="col-md-12">
            <a class="" href="{{ route('AdminDashboard') }}">صفحه اصلی</a>/
            <a class="" href="{{ route('IndexContent') }}">مدیریت محتوا</a>
            <span class="now-url"> / ویرایش محتوا</span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @include('message.Message')
            @include('message.ErrorReporting')
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">ویرایش محتوا</h3>
                </div>
                <div class="panel-body">
                    <form role="form" action="{{ route('UpdateContent') }}" method="post" enctype="multipart/form-data" id="FormUpdateContent">
                        {{ csrf_field() }}
                        <input type="hidden" name="content_id" value="{{ $contentModel->id }}" />
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="InputTitleContent">عنوان محتوا</label><span style="font-size: 18px;" class="text-danger">*</span>
                                    <input type="text" name="title" value="{{ $contentModel->title }}" class="form-control primary" dir="rtl" id="InputTitleContent" placeholder="عنوان خبر را وارد کنید" autofocus>
                                    @if($errors->has('title'))
                                        <span style="color:red;">{{ $errors->first('title') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="InputTypeContent">نوع محتوا</label><span style="font-size: 18px;" class="text-danger">*</span>
                                    <select class="form-control" name="type" id="InputTypeContent">
                                        <option value="1" @if($contentModel->type == 1) selected @endif>ارتباط با ما</option>
                                        <option value="2" @if($contentModel->type == 2) selected @endif>دسترسی سریع</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="editor">محتوا</label><span style="font-size: 18px;" class="text-danger">*</span>
                                    <textarea class="editor" style="height: 300px;" name="content">
                                        {{ $contentModel->content }}
                                    </textarea>
                                    @if($errors->has('content'))
                                        <span style="color:red;">{{ $errors->first('content') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" role="form">

                                    <div class="form-group">
                                        <label for="InputCheckBoxActive">نمایش محتوا</label>
                                        <input type="checkbox" name="active" @if($contentModel->active == 1) checked @endif id="InputCheckBoxActive" class="js-switch-blue"  />
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" id="BtnUpdateContent" class="btn btn-success btn-block ">ثبت محتوا</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('backend/js/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/switchery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/form-advancecomponents.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#BtnUpdateContent').click(function () {
                var titleUpdateContent = $('#titleUpdateContent').val();
                var contentUpdateContent = $('#editor').val();
                if(titleUpdateContent == "" || contentUpdateContent == "")
                {
                    alert('پر کردن فیلدهای ستاره دار الزامی میباشد');
                }
                else
                {
                    $('#FormUpdateContent').submit();
                }
            });
        });
    </script>

@endsection