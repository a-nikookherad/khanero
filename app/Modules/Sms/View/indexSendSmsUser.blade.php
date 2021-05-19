@extends('backend.MasterPage.Layout')
@section('title')
    ویلا :: اقامتگاه های رزرو شده
@endsection

@section('style')

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
                    <h3 class="panel-title">ارسال پیامک</h3>
                </div>
                <div class="panel-body">
                    <form action="{{route('SendSmsUser')}}" method="post">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select name="user_type" id="" class="form-control">
                                        <option value="1">همه کاربران</option>
                                        <option value="2">کاربران میزبان</option>
                                        <option value="3">کاربران میهمان</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea name="message" placeholder="متن پیامک را وارد کنید" class="form-control" rows="4">{{old('message')}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-block">
                                        ارسال پیامک
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @endsection

@section('script')

@endsection