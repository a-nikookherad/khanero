@extends('backend.MasterPage.Auth')

@section('title')
    صفحه وجود ندارد
@endsection

@section('content')
<script type="text/javascript">
    $('body').attr('id', 'error-body');
</script>
    <div class="error-page">
        <div class="error-panel col-md-4 col-md-offset-4">
            <span class="error-heading">404</span>
            <h3 class="white">متاسفانه این صفحه وجود ندارد</h3>
            <div class="input-group error-search">
                <input type="text" placeholder="کلمات کلیدی" class="form-control warning">
                <span class="input-group-btn">
						  <button class="btn btn-warning" type="button"><i class="fa fa-search"></i> جستجو</button>
					</span>
            </div>
            <h5 class="white copy">تمامی حقوق این اثر محفوظ می باشد</h5>
        </div>
    </div>

@endsection