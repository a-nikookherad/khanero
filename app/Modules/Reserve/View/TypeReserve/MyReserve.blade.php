@php
    $reserveModel = GetReserveByCode($value['group_code']);
    $hostModel = GetHostByCode($value['group_code']);
    $JdateInstance = new App\Logic\moriJalali\moriJalaiAdaptor(new App\Logic\moriJalali\moriJalaiLogic());

@endphp
<div class="bx-Residence my-trip row">
    <div class="col-sm-4">
        <div class="slid-1">
            <a class="d-block box-sl slide" href="#">
                <img class="mw-100" src="{{asset('Uploaded/Gallery/Img/'.$hostModel->getGalleryFirst->img)}}" alt="image" />
                <div class="info-code-1"><span>کد اقامتگاه   :</span><label>{{$hostModel->id + 5000}}</label></div>
            </a>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="row">
            <div class="col-sm-7 px-0">
                <div class="bx-subject row">
                    <h2 class="col-sm-12 px-0 title-Rsdnc">{{$hostModel->name}}</h2>
                    <p class="col-sm-12 loc-Rsdnc"><i class="fas fa-map-marker-alt"></i>
                        {{$hostModel->getTownship->provinceGet->name}} - {{$hostModel->getTownship->name}}
                    </p>
                </div>
                <ul class="col-sm-7 px-0 som-inf">
                    <li class="info-Rsdnc"><span>شماره رزرو  :</span><label>{{$reserveModel[0]->id + 100000}}</label></li>
                    <li class="info-Rsdnc"><span>وضعیت رزرو  :</span><label>در انتظار تایید </label></li>
                </ul>
                <div class="col-sm-5 paymnt-not">
                    <a class="btn-pay" href="#">پرداخت</a>
                                        <div class="timer-py d-flex align-items-center">
                                            <label>
                                                12
                                                <span>ثانیه</span>
                                            </label>
                                            <label>
                                                12
                                                <span>دقیقه</span>
                                            </label>
                                        </div>
                </div>
                <div class="col-sm-12 px-0 d-flex align-items-center host-info">
                    @if($reserveModel[0]->getUser->avatar == 'default-user.png')
                        <img class="pc-host" src="{{ asset('backend/img/avatar.png')}}" alt="avatar">
                    @else
                        <img class="pc-host" src="{{asset('Uploaded/User/Profile/'.$reserveModel[0]->getUser->avatar)}}" alt="avatar">
                    @endif
                    <h5 class="name-host">{{$reserveModel[0]->getUser->first_name}} {{$reserveModel[0]->getUser->last_name}}</h5>
                </div>
            </div>
            <div class="col-sm-5">
                <ul class="each-011">
                    <li class="info-trip">
                        <p class="from">

                            از {{GetNameDayOfWeek($reserveModel[0]->week_id)}}  {{$JdateInstance->forge($reserveModel[0]->reserve_date)->format('Y/m/d')}}

                            تا {{GetNameDayOfWeek($reserveModel[count($reserveModel) - 1]->week_id)}}  {{$JdateInstance->forge(date('Y-m-d H:i:s', strtotime($reserveModel[0]->reserve_date . ' +'. (count($reserveModel) - 1) .' day')))->format('Y/m/d')}}
                            به مدت {{count($reserveModel)}} روز
                        </p>
                        <p>
                            ساعت تحویل : {{$hostModel->time_enter_from}}
                        </p>
                    </li>
                    <li class="info-trip">تعداد {{$reserveModel[0]->num_of_standard_people + $reserveModel[0]->num_of_guests}} نفر</li>
                </ul>
                <ul class="each-01">
                    <li class="info-trip">
                        مبلغ کل تسویه :
                        <label>
                            <span class="price">
                                @php
                                    $total_price = 0;
                                    foreach ($reserveModel as $key => $value) {
                                        $total_price += $value->final_price;
                                    }
                                @endphp
                                {{number_format($total_price)}}
                            </span>
                            <span class="unit">تومان</span>
                        </label>
                    </li>
                                        <li class="info-trip">پیش پرداخت :<label><span class="price">120,000</span><span class="unit">تومان</span></label></li>
                                        <li class="info-trip">پرداخت در محل :<label><span class="price">120,000</span><span class="unit">تومان</span></label></li>
                </ul>
                <ul class="can-click row">
                    <li class="col-sm-6 clck-btn clck-01"><a class="each-clck" data-toggle="modal" data-target="#myModal{{$reserveModel[0]->id}}"> پیام به میزبان</a></li>
                    <li class="col-sm-6 clck-btn clck-01"><a class="each-clck" href="#"> جزئیات رزرو</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="myModal{{$reserveModel[0]->id}}">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">ارسال پیام به مهمان</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{route('StoreMessageForHostUser')}}" method="post">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="TextAreaMessage">متن پیام</label>
                                <textarea id="TextAreaMessage" placeholder="متن پیام به مهمان را وارد کنید" class="form-control" name="message"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">
                                    ثبت و ارسال
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>