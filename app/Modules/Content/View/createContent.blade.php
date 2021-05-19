@extends('backend.MasterPage.Layout')
@section('title', TitlePage('ایجاد محتوا'))
@section('style')
    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap3-wysiwyg5.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/select2-bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/switchery.min.css') }}">


    <script type="text/javascript" src="{{ asset('backend/js/jquery-1.11.0.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/jquery-ui-1.10.4.custom.min.js') }}"></script>


    <style>
        #ToolTables_DataTables_Table_0_0{
            display: none;
        }
    </style>
@endsection

@section('content')
    <script src="{{asset('backend/js/ckeditor-new/ckeditor.js')}}"></script>
    <script src="{{asset('backend/js/ckeditor-new/samples/js/sample.js')}}"></script>
    <link href="{{asset('backend/js/ckeditor-new/samples/css/samples.css')}}" />
    <div class="row back-url">
        <div class="col-md-12">
            <a class="" href="{{ route('AdminDashboard') }}">صفحه اصلی</a>/
            <a class="" href="{{ route('IndexContent') }}">مدیریت محتوا</a>
            <span class="now-url"> / ایجاد محتوا</span>
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
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">ایجاد محتوا</h3>
                </div>
                <div class="panel-body">
                    <form role="form" action="{{ route('StoreContent') }}" method="post" enctype="multipart/form-data" id="FormCreateContent">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="InputTitleContent">عنوان محتوا</label><span style="font-size: 18px;" class="text-danger">*</span>
                                    <input type="text" name="title" value="{{ old('title') }}" class="form-control primary" dir="rtl" id="InputTitleContent" placeholder="عنوان خبر را وارد کنید" autofocus>
                                    @if($errors->has('title'))
                                        <span style="color:red;">{{ $errors->first('title') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="InputTypeContent">نوع محتوا</label><span style="font-size: 18px;" class="text-danger">*</span>
                                    <select class="form-control" name="type" id="InputTypeContent">
                                        <option value="1">ارتباط با ما</option>
                                        <option value="2">دسترسی سریع</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="InputContent">توضیحات</label>
                                    <textarea id="editor" name="content" id="InputContent">{{old('content')}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" role="form">

                                    <div class="form-group">
                                        <label for="InputCheckBoxActive">نمایش محتوا</label>
                                        <input type="checkbox" name="active" id="InputCheckBoxActive" class="js-switch-blue" checked />
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" id="BtnCreateContent" class="btn btn-success btn-block ">ثبت محتوا</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        initSample();
    </script>
@endsection

@section('script')
    {{--<script type="text/javascript" src="{{ asset('backend/js/tinymce/editor.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('backend/js/tinymce/tinymce.min.js') }}"></script>--}}
    <script type="text/javascript" src="{{ asset('backend/js/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/switchery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/form-advancecomponents.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#BtnCreateContent').click(function () {
                // var titleNewsletter = $('#InputTitleNewsletter').val();
                // var contentNewsletter = $('#editor').val();
                // if(titleNewsletter == "" || contentNewsletter == "")
                // {
                //     alert('پر کردن فیلدهای ستاره دار الزامی میباشد');
                // }
                // else
                // {
                    $('#FormCreateContent').submit();
                // }
            });
        });
    </script>

@endsection