<style>
	.owl-city img {
		border-radius: 6px;
	}
</style>
<div class="owl-carousel owl-theme owl-city">
	@foreach($slideShowModel as $key => $value)
		<item>
		    <div class="Box-11">
		        <a href="@if($value->township_id != 0) {{route('VisitedCity', ['id' => $value->township_id])}} @else {{$value->link}} @endif" target="_blank">
    				<img src="{{asset('Uploaded/SlideShow/Img/'.$value->img)}}"/>
    				<div class="welcome-popular-cities-desc bx-contect">
    					<div class="name">{{$value->title}}</div>
    					{{--<span class="count" data-count="">۴۶ خانه </span>--}}
    				</div>
    			</a>
		    </div>
			
		</item>
	@endforeach
</div>

<script>
    var owl = $('.owl-city');
    owl.owlCarousel({
        loop:true,
        rtl:true,
        dots:false,
        navText: ["<i class='fas fa-angle-left'></i>", "<i class='fas fa-angle-right'></i>"],
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        responsiveClass:true,

        responsive:{
            0:{
                items:1,
                nav:false
            },

            320:{
                items:2,
                nav:false,
                stagePadding: 30,
                margin:8
            },
            800:{
                items:3,
                nav:false,
                stagePadding: 20,
                margin: 12
            },
            1000:{
                items:5,
                nav:true,
                stagePadding: 30,
                margin: 10
            }
        }
    });
</script>