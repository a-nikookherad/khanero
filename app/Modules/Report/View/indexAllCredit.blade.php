@extends('backend.MasterPage.Layout')
@section('title',TitlePage('حساب های کل سایت'))
@section('style')
    <style>
        .box-detail {
            border: 1px solid #e2e2e2;
            border-radius: 5px;
            background: #fbfbfb;
            padding: 10px;
            box-shadow: 0px 0px 5px #f1f1f1;
        }
    </style>
@endsection

@section('content')
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
                    <h3 class="panel-title">حساب های کل سایت</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="box-detail">
                                    تعداد کل رزروها : {{$countReserve}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="box-detail">
                                مبلغ کل رزرو ها از درگاه بانک : {{number_format($paymentBankTotal)}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="box-detail">
                                مبلغ کل برای شارژ کیف پول کاربران : {{number_format($paymentWalletTotal)}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="box-detail">
                                    مبلغ کل واریزی های کاربران از درگاه : {{number_format($paymentWalletTotal + $paymentBankTotal)}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="box-detail">
                                    جریمه (کل پرداختی ها به میزبان بابت انصراف از رزرو توسط میهمان) : {{number_format($totalPenaltyGuest)}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="box-detail">
                                    عودت (کل پرداختی ها به میهمان بابت انصراف از رزرو با احتساب جریمه) : {{number_format($totalPenaltyHost)}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="box-detail">
                                    مبلغ درصد : {{1000}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="box-detail">
                                    مبلغ دعوت از دوستان : واریزی های کل منهای جریمه به علاوه عودت به علاوه مبلغ سایت به علاوه مبلغ دعوت
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="box-detail">
                                    مبلغ امانت (بعدا واریز می شود) : {{1000}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="box-detail">
                                    پول داخل حساب : {{1000}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>

    </script>
@endsection