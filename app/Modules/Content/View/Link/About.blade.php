<?php
    $aboutModel = \App\Modules\Content\Controllers\ContentController::AboutLink();
?>

<p>
    {!! $aboutModel->content !!}
</p>
