@if(session('Errors'))

    <div class="alert alert-{{session('AlertType')}} alert-dismissable">

        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{session('Errors')}}
    </div>
@endif
