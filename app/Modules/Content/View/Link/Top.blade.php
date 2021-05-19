<?php
$contentModel = App\Modules\Content\Controllers\ContentController::TopLink()
?>
@foreach($contentModel as $key => $value)
    <li class="sub-menu-parent" tab-index="0">
        <a href="{{ route('PageContent', ['alias' => $value->alias]) }}">{{ $value->title }}</a>
    </li>
@endforeach

