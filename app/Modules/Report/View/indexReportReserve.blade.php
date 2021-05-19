@extends('backend.MasterPage.Layout')
@section('title',TitlePage('گزارش رزرو کاربران'))
@section('style')
    <link rel="stylesheet" href="{{asset('backend/css/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/TableTools.css')}}">
    <style>
        #ToolTables_DataTables_Table_0_0 {
            display: none;
        }
        .btn-group.pull-right.tabletools-btn {
            display: none;
        }
        .table-responsive {
            overflow: auto;
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
                    <h3 class="panel-title">گزارش رزرو کاربران</h3>
                </div>
                <div class="panel-body">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#menu1">رزرو ها</a></li>
                        <li><a data-toggle="tab" href="#menu2">کنسلی ها</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="menu1" class="tab-pane fade active in">
                            <h3>رزرو ها</h3>
                            <div class="table-responsive">
                                <table cellpadding="0" cellspacing="0" border="0"
                                   class="table table-striped table-bordered editable-datatable">
                                <thead>
                                <tr>
                                    <th scope="col">ردیف</th>
                                    <th scope="col">شناسه رزرو</th>
                                    <th scope="col">اقامتگاه</th>
                                    <th scope="col">نام میزبان</th>
                                    <th scope="col">نام میهمان</th>
                                    <th scope="col">تعداد شب های رزرو</th>
                                    <th scope="col">مبلغ رزرو</th>
                                    <th scope="col">تخفیفات و ایام خاص</th>
                                    <th scope="col">مبلغ نهایی رزرو</th>
                                    <th scope="col">نوع پرداخت</th>
                                    <th scope="col">مبلغ واریز(درگاه)</th>
                                    <th scope="col">مبلغ پرداخت(حضوری)</th>
                                    <th scope="col" style="background: #c7caf1;">مبلغ پرداختی سایت</th>
                                    <th scope="col">مبلغ درصد سایت</th>
                                    <th scope="col">مبلغ دعوت از دوستان</th>
                                    <th scope="col">پرداخت انجام شد</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $i = 1; @endphp
                                @foreach($array_reserve as $key => $value)
                                    <tr>
                                        <td>
                                            {{ $i }}
                                        </td>
                                        <td>
                                            {{ $value['id'] }}
                                        </td>
                                        <td>
                                            {{ $value['host_detail']->name }}
                                        </td>
                                        <td>
                                            {{$value['host_detail']->getUser->first_name. ' ' .$value['host_detail']->getUser->last_name}}
                                        </td>
                                        <td>
                                            {{ $value['reserve_user']->first_name.' '.$value['reserve_user']->last_name }}
                                        </td>
                                        <td>
                                            {{count($value['date_reserve'])}}
                                        </td>
                                        <td>
                                            @php $dayPrice = 0; @endphp
                                            @foreach($value['day_price'] as $index => $item)
                                                @php $dayPrice = $dayPrice+$item; @endphp
                                            @endforeach
                                            {{number_format($dayPrice)}}
                                        </td>
                                        <td>
                                    <span class="text-info btn" data-toggle="modal" data-target="#myModalDetailPrice"
                                          onclick="AjaxDetailPrice('{{$key}}')">
                                        مشاهده
                                    </span>
                                        </td>
                                        <td class="text-danger">
                                            @php $totalPrice = 0; @endphp
                                            @foreach($value['final_price'] as $index => $item)
                                                @php $totalPrice = $totalPrice+$item; @endphp
                                            @endforeach
                                            {{number_format($totalPrice)}}
                                        </td>
                                        <td>
                                            @if($value['type_payment'] == 1)
                                                درگاه بانک
                                            @else
                                                کیف پول
                                            @endif
                                        </td>
                                        <td>
                                            {{number_format($value['payment']->price)}}
                                        </td>
                                        <td>
                                            {{number_format($value['payment']->remaining_price)}}
                                        </td>
                                        <td style="background: #eeeff7;">
                                            {{number_format($value['payment']->price - (($totalPrice * config('setting.SitePercent')) / 100) - (($totalPrice * config('setting.InvitePercent')) / 100))}}
                                        </td>
                                        <td>
                                            {{number_format(($totalPrice * config('setting.SitePercent')) / 100)}}
                                        </td>
                                        <td>
                                            {{number_format(($totalPrice * config('setting.InvitePercent')) / 100)}}
                                        </td>
                                        <td>
                                            @if($value['step'] == 3)
                                                پرداخت شده
                                            @endif
                                        </td>
                                    </tr>
                                    @php $i += 1; @endphp
                                @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>
                        <div id="menu2" class="tab-pane fade">
                            <h3>کنسلی ها</h3>
                            <div class="table-responsive">
                                <table cellpadding="0" cellspacing="0" border="0"
                                   class="table table-striped table-bordered editable-datatable">
                                <thead>
                                <tr>
                                    <th scope="col">ردیف</th>
                                    <th scope="col">شناسه رزرو</th>
                                    <th scope="col">اقامتگاه</th>
                                    <th scope="col">نام میزبان</th>
                                    <th scope="col">نام میهمان</th>
                                    <th scope="col">تعداد شب های رزرو</th>
                                    <th scope="col">مبلغ رزرو</th>
                                    <th scope="col">تخفیفات و ایام خاص</th>
                                    <th scope="col">مبلغ نهایی رزرو</th>
                                    <th scope="col">نوع پرداخت</th>
                                    <th scope="col">مبلغ واریز(درگاه)</th>
                                    <th scope="col">جریمه(پرداخت به میزبان)</th>
                                    <th scope="col">مبلغ عودت(پرداخت به میهمان)</th>
                                    <th scope="col">مبلغ پرداخت(حضوری)</th>
                                    <th scope="col">مبلغ درصد سایت</th>
                                    <th scope="col">مبلغ دعوت از دوستان</th>
                                    <th scope="col">پرداخت انجام شد</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $i = 1; @endphp
                                @foreach($array_reserve_100 as $key => $value)
                                    <tr>
                                        <td>
                                            {{ $i }}
                                        </td>
                                        <td>
                                            {{ $value['id'] }}
                                        </td>
                                        <td>
                                            {{ $value['host_detail']->name }}
                                        </td>
                                        <td>
                                            {{$value['host_detail']->getUser->first_name. ' ' .$value['host_detail']->getUser->last_name}}
                                        </td>
                                        <td>
                                            {{ $value['reserve_user']->first_name.' '.$value['reserve_user']->last_name }}
                                        </td>
                                        <td>
                                            {{count($value['date_reserve'])}}
                                        </td>
                                        <td>
                                            @php $dayPrice = 0; @endphp
                                            @foreach($value['day_price'] as $index => $item)
                                                @php $dayPrice = $dayPrice+$item; @endphp
                                            @endforeach
                                            {{number_format($dayPrice)}}
                                        </td>
                                        <td>
                                            <span class="text-info btn" data-toggle="modal"
                                                  data-target="#myModalDetailPrice"
                                                  onclick="AjaxDetailPrice('{{$key}}')">
                                                مشاهده
                                            </span>
                                        </td>
                                        <td class="text-danger">
                                            @php $totalPrice = 0; @endphp
                                            @foreach($value['final_price'] as $index => $item)
                                                @php $totalPrice = $totalPrice+$item; @endphp
                                            @endforeach
                                            {{number_format($totalPrice)}}
                                        </td>
                                        <td>
                                            @if($value['type_payment'] == 1)
                                                درگاه بانک
                                            @else
                                                کیف پول
                                            @endif
                                        </td>
                                        <td>
                                            @if(!empty($value['payment']))
                                                {{number_format($value['payment']->price)}}
                                            @endif
                                        </td>
                                        <td title="{{$value['wallet'][0]->description}}">
                                            {{number_format($value['wallet'][0]->price)}}
                                        </td>
                                        <td title="{{$value['wallet'][1]->description}}">
                                            {{number_format($value['wallet'][1]->price)}}
                                        </td>
                                        <td>
                                            @if(!empty($value['payment']))
                                                {{number_format($value['payment']->remaining_price)}}
                                            @endif
                                        </td>
                                        <td>
                                            {{number_format(($totalPrice * config('setting.SitePercent')) / 100)}}
                                        </td>
                                        <td>
                                            {{number_format(($totalPrice * config('setting.InvitePercent')) / 100)}}
                                        </td>
                                        <td>
                                            @if($value['status'] == -1)
                                                رد شده توسط میزبان
                                            @elseif($value['status'] == -2)
                                                انصراف میهمان
                                            @elseif($value['status'] == -100)
                                                منقضی شده
                                            @endif
                                        </td>
                                    </tr>
                                    @php $i += 1; @endphp
                                @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    {{-- modal detail price --}}
    <div class="modal fade" id="myModalDetailPrice" role="dialog">
        <div class="modal-dialog modal-md">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">جزئیات قیمت</h5>
                </div>
                <div class="modal-body">
                    <div id="ExtraModalDetailPrice">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('frontend/js/script.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('backend/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/TableTools.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/dataTables.bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/editable-datatables.js')}}"></script>

    <script>
        function AjaxDetailPrice(id) {
            var img = '<div class="text-center"><img style="height:50px;width:auto;" src="{{ asset('backend/img/img_loading/orange_circles.gif') }}" /></div>';
            $('#ExtraModalDetailPrice').html(img);
            $.ajax({
                url: "{{ url('detail/price-reserve').'/'}}" + id,
                method: "get",
            }).done(function (returnData) {
                $('#ExtraModalDetailPrice').html(returnData);
            })
        }
    </script>
@endsection