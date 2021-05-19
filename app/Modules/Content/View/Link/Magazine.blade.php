<?php
$contentModel = App\Modules\Content\Controllers\ContentController::Magazine()
?>
<style>
    .magazine span {
        color: #a4c5caad;
    }
</style>

@foreach($contentModel as $key => $value)
    <li class="magazine">
        <a href="{{ route('PageContent', ['alias' => $value->alias]) }}"> <span>#</span> {{ $value->title }}</a>
    </li>
@endforeach

