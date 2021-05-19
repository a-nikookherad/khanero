@extends('backend.MasterPage.Layout')
@section('title', TitlePage('نمایش جزئیات پیام'))
@section('style')
    <link rel="stylesheet" href="{{asset('backend/css/datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/bootstrap-datepicker.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('backend/css/voteStar.css') }}">
    <style>
        #editor #editor_ifr {
            height: 200px;
        }
        .color-text-section {
            color: #ff6600;
        }
        .title-row {
            color: #aaa;
            border-bottom: 1px dashed #ccc;
            padding-bottom: 8px;
        }
        .panel-body .row {
            margin: 8px 0;
        }
    </style>
@endsection

@section('content')
    <div class="row back-url">
        <div class="col-md-12">
            <a class="" href="{{ route('AdminDashboard') }}">صفحه اصلی</a> /
            <a class="" href="{{ route('ContactUsFormAdmin') }}">تماس با ما</a>/
            <a class="" href="{{ route('IndexContactMessage') }}">نمایش پیام های دریافتی</a>
            <span class="now-url"> / نمایش پیام </span>
        </div>
    </div>
    <div class="row" id="DivIdToPrint">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading text-right">
                    <h3 class="panel-title">نمایش جزئیات</h3>
                </div>
                <div class="panel-body">
                    <h6 class="title-row">اطلاعات کاربری</h6>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <h5>
                                    <span class="color-text-section"> نام کاربر : </span> {{ $contactModel->name }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <h5>
                                    <span class="color-text-section"> شماره تماس : </span> {{ $contactModel->phone }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <h5>
                                    <span class="color-text-section"> پست الکترونیکی : </span> {{ $contactModel->email }}
                                </h5>
                            </div>
                        </div>
                    </div>

                    <h6 class="title-row">پیام</h6>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5>
                                    <span class="color-text-section"> موضوع : </span> {{ $contactModel->subject }}
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <h5 style="line-height: 25px;">
                                    <span class="color-text-section"> متن پیام : </span> {{ $contactModel->content }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script type="text/javascript">
        function printDiv()
        {
            var divToPrint=document.getElementById('DivIdToPrint');

            var newWin=window.open('','Print-Window');

            newWin.document.open();

            newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

            newWin.document.close();

            setTimeout(function(){newWin.close();},10);
        }
    </script>
@endsection