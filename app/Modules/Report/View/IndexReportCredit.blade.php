@extends('backend.MasterPage.Layout')
@section('title',TitlePage('گزارش کیف پول کاربران'))
@section('style')
    <link rel="stylesheet" href="{{asset('backend/css/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/TableTools.css')}}">
    <style>
        #ToolTables_DataTables_Table_0_0 {
            display: none;
        }
        .align {
            direction: initial;
            text-align: center;
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
                    <h3 class="panel-title">گزارش کیف پول کاربران</h3>
                </div>
                <div class="panel-body">
                    <table cellpadding="0" cellspacing="0" border="0"
                           class="table table-striped table-bordered editable-datatable">
                        <thead>
                            <tr>
                                <th scope="col">ردیف</th>
                                <th scope="col">نام کاربر</th>
                                <th scope="col">شماره حساب</th>
                                <th scope="col">نام شماره حساب</th>
                                <th scope="col">موجودی کیف پول(تومان)</th>
                                <th scope="col">در انتظار پرداخت</th>
                                <th scope="col">پرداخت</th>
                                <th scope="col">تایید پرداخت</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($creditModel as $key => $value)
                                <tr>
                                    <td>
                                        {{ $key+1 }}
                                    </td>
                                    <td>
                                        {{ $value->first_name.' '.$value->last_name }}
                                    </td>
                                    <td class="align">
                                        @if($value->card_bank_number != '')
                                            {{ $value->card_bank_number }}
                                        @else
                                            ثبت نشده
                                        @endif
                                    </td>
                                    <td>
                                        @if($value->account_name != '')
                                            {{ $value->account_name }}
                                        @else
                                            ثبت نشده
                                        @endif
                                    </td>
                                    <td class="text-success">
                                        {{ number_format($value->credit) }}
                                    </td>
                                    <td class="text-success">
                                        @if($value->payment_wait > 0)
                                            {{ number_format($value->payment_wait) }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="text-success">
                                        @if($value->payment_wait == 0 && $value->credit > 0)
                                            <a class="btn btn-default" href="{{route('ClearingCreditUser', ['id' => $value->id, 'status' => 'update'])}}">
                                                پرداخت
                                            </a>
                                        @elseif($value->payment_wait > 0 && $value->credit > 0)
                                            <a class="btn btn-default" href="{{route('ClearingCreditUser', ['id' => $value->id, 'status' => 'update'])}}">
                                                به روز رسانی مبلغ پرداخت
                                            </a>
                                        @else

                                            در انتظار پرداخت

                                        @endif
                                    </td>
                                    <td class="text-success">
                                        @if($value->payment_wait > 0)
                                            <a class="btn btn-default" href="{{route('ClearingCreditUser', ['id' => $value->id, 'status' => 'confirm'])}}">
                                                تایید
                                            </a>
                                            <a class="btn btn-default" href="{{route('ClearingCreditUser', ['id' => $value->id, 'status' => 'cancel'])}}">
                                                عدم تایید
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>

    </script>
@endsection