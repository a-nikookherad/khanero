@extends('backend.MasterPage.Layout')
@section('title',TitlePage('گزارش نمودار کاربران'))
@section('style')
    <link rel="stylesheet" href="{{asset('backend/css/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/TableTools.css')}}">
    <style>
        #ToolTables_DataTables_Table_0_0 {
            display: none;
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
                    <h3 class="panel-title">گزارش نمودار کاربران</h3>
                </div>
                <div class="panel-body">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#user">نمودار کاربران</a></li>
                        <li><a data-toggle="tab" href="#reserve">نمودار رزروها</a></li>
                        <li><a data-toggle="tab" href="#price">نمودار درامد رزروها</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="user" class="tab-pane fade in active">
                            <div id="container_user" style="min-width: 550px; height: 400px; margin: 0 auto"></div>
                        </div>
                        <div id="reserve" class="tab-pane fade">
                            <div id="container_reserve" style="min-width: 550px; height: 400px; margin: 0 auto"></div>
                        </div>
                        <div id="price" class="tab-pane fade">
                            <div id="container_price" style="min-width: 550px; height: 400px; margin: 0 auto"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script>
        $(function () {
            Highcharts.setOptions({
                chart: {
                    style:{
                        fontFamily:'Arial, Helvetica, sans-serif',
                        fontSize: '1em',
                        color:'#f00'
                    }
                }
            });
            $('#container_user').highcharts({
                chart: {
                    type: 'column'
                },
                colors: [
                    '#0d5c32',
                    '#88C347'

                ],
                title: {
                    text: 'گزارش ثبت نام کاربران',
                    style: {
                        color: '#555'
                    }
                },
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom',
                    borderWidth: 0,
                    backgroundColor: '#FFFFFF'
                },
                xAxis: {
                    categories: [
                        'فروردین',
                        'اردیبهشت',
                        'خرداد',
                        'تیر',
                        'مرداد',
                        'شهریور',
                        'مهر',
                        'آبان',
                        'آذر',
                        'دی',
                        'بهمن',
                        'اسفند',
                    ]
                },
                yAxis: {
                    allowDecimals: false,
                    title: {
                        text: ' بر اساس تعداد ثبت نام'

                    }

                },
                tooltip: {
                    shared: false,
                    valueSuffix: 'نفر'
                },
                credits: {
                    enabled: false
                },
                plotOptions: {
                    areaspline: {
                        fillOpacity: 0.1
                    },
                    series: {
                        groupPadding: .15
                    }
                },
                series: [
                    {
                        name: 'کاربران عضو شده',
                        data: [
                            32,
                            94,
                            112,
                            85,
                            76,
                            741,
                            311,
                            23,
                            12,
                            85,
                            76,
                            74
                        ]
                    },
                    // {
                    //     name: 'Active School Up For renewal',
                    //     data: [17333,4237,1786,458,322]
                    // }
                ]

            });


            $('#container_reserve').highcharts({
                chart: {
                    type: 'column'
                },
                colors: [
                    '#0d5c32',
                    '#88C347'

                ],
                title: {
                    text: 'گزارش نمودار رزروها',
                    style: {
                        color: '#555'
                    }
                },
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom',
                    borderWidth: 0,
                    backgroundColor: '#FFFFFF'
                },
                xAxis: {
                    categories: [
                        'فروردین',
                        'اردیبهشت',
                        'خرداد',
                        'تیر',
                        'مرداد',
                        'شهریور',
                        'مهر',
                        'آبان',
                        'آذر',
                        'دی',
                        'بهمن',
                        'اسفند',
                    ]
                },
                yAxis: {
                    allowDecimals: false,
                    title: {
                        text: ' بر اساس تعداد رزرو'

                    }

                },
                tooltip: {
                    shared: false,
                    valueSuffix: 'رزرو'
                },
                credits: {
                    enabled: false
                },
                plotOptions: {
                    areaspline: {
                        fillOpacity: 0.1
                    },
                    series: {
                        groupPadding: .15
                    }
                },
                series: [
                    {
                        name: 'نمودار رزروها',
                        data: [
                            12,
                            94,
                            7,
                            85,
                            76,
                            86,
                            320,
                            23,
                            2,
                            85,
                            45,
                            74
                        ]
                    },
                    // {
                    //     name: 'Active School Up For renewal',
                    //     data: [17333,4237,1786,458,322]
                    // }
                ]

            });


            $('#container_price').highcharts({
                chart: {
                    type: 'column'
                },
                colors: [
                    '#0d5c32',
                    '#88C347'

                ],
                title: {
                    text: 'گزارش نمودار درامد رزروها',
                    style: {
                        color: '#555'
                    }
                },
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom',
                    borderWidth: 0,
                    backgroundColor: '#FFFFFF'
                },
                xAxis: {
                    categories: [
                        'فروردین',
                        'اردیبهشت',
                        'خرداد',
                        'تیر',
                        'مرداد',
                        'شهریور',
                        'مهر',
                        'آبان',
                        'آذر',
                        'دی',
                        'بهمن',
                        'اسفند',
                    ]
                },
                yAxis: {
                    allowDecimals: false,
                    title: {
                        text: ' بر اساس قیمت'

                    }

                },
                tooltip: {
                    shared: false,
                    valueSuffix: 'تومان'
                },
                credits: {
                    enabled: false
                },
                plotOptions: {
                    areaspline: {
                        fillOpacity: 0.1
                    },
                    series: {
                        groupPadding: .15
                    }
                },
                series: [
                    {
                        name: 'نمودار درامد رزروها',
                        data: [
                            86,
                            320,
                            23,
                            2,
                            76,
                            200,
                            12,
                            23,
                            33,
                            85,
                            76,
                            74
                        ]
                    },
                    // {
                    //     name: 'Active School Up For renewal',
                    //     data: [17333,4237,1786,458,322]
                    // }
                ]

            });
        });

    </script>
@endsection