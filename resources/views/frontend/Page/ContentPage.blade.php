@extends('frontend.MasterPage.Layout')
@section('title',TitlePage($contentModel->title))
@section('style')
    <style>
        #main1 p {
            font-size: 14px;
            line-height: 35px;
        }
        .title-main {
            color: #007e8d;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-10 col-md-offset-1">
            <div id="main1">
                <h3 class="title-main"><i class="fas fa-home"></i> {{ $contentModel->title }}</h3>
                {!! $contentModel->content !!}
            </div>
        </div>
    </div>
@endsection
