@extends('backend.MasterPage.Layout')

@section('title')
    داشبورد
@endsection

@section('style')
    <link href="{{ url('backend/css/style-custom-panel.css') }}" type="text/css" rel="stylesheet" />
@endsection

@section('headerSection')

@endsection

@section('content')
    <div class="row text-center">
        <div class="col-md-2">
            <a href="{{ route('EditUser') }}">
                <div class="box-panel">
                    <i class="fa fa-user"></i>
                    <h5>
                        ویرایش اطلاعات
                    </h5>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a href="{{ route('IndexMessage') }}">
                <div class="box-panel">
                    <i class="fa fa-dropbox"></i>
                    <h5>
                        پیام ها <span class="text-info numberMessageUser"></span>
                    </h5>
                </div>
            </a>
        </div>
{{--        <div class="col-md-2">--}}
{{--            <a href="{{ route('HostFactor') }}">--}}
{{--                <div class="box-panel">--}}
{{--                    <i class="fa fa-user"></i>--}}
{{--                    <h5>--}}
{{--                        خرید بسته--}}
{{--                    </h5>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--        <div class="col-md-2">--}}
{{--            <a href="{{ route('IndexChargeWallet') }}">--}}
{{--                <div class="box-panel">--}}
{{--                    <i class="fa fa-user"></i>--}}
{{--                    <h5>--}}
{{--                        شارژ کیف پول--}}
{{--                    </h5>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--        </div>--}}
    </div>
@endsection


@section('script')
    <script type="text/javascript">
        var id = {{ auth()->user()->id }};
        $.ajax({
            url:"{{ url('message/get/number').'/'}}"+id,
            method:"get",
        }).done(function(returnData){
            $('.numberMessageUser').text(returnData);
        });
    </script>
@endsection