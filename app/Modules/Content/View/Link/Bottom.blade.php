<?php
    $contentModel = App\Modules\Content\Controllers\ContentController::BottomLink()
?>


@foreach($contentModel as $key => $value)
    <li>
        <a href="{{ route('PageContent', ['alias' => $value->alias]) }}">{{ $value->title }}</a>
    </li>
@endforeach

