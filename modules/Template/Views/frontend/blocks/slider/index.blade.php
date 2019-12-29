@endsection

<div class="container">
    <div class="bravo-vendor-form-register py-5 @if(!empty($layout)) {{ $layout }} @endif">
        <div class="row">
        	<div class="col-md-9">
        		<div class="owl-carousel owl-theme" id="test-slider">

        			@if(!empty($sliders))
        				@foreach($sliders as $slider)
						    <div class="item" style="width: 100%;">
						    	{{ get_image_tag($slider['icon_image'], 'thumb', array('class' => 'test')) }}
								<p>{{ $slider['sub_text'] }}</p>
								<h3>{{  $slider['sub_title'] }}</h3>
								<button>{{$slider['btn_shop_now']}}</button>
						    </div>
		            	@endforeach
		            @endif
				</div>
        	</div>
        </div>
    </div>
</div>
@section('footer')
    <!-- <script type="text/javascript" src="{{ asset("/module/vendor/js/vendor-register.js") }}"></script> -->
    <script>
    	$(function () {
    		$('#test-slider').owlCarousel({
		    loop:true,
		    nav:true,
		    // animateOut: 'slideOutDown',
		    // animateIn: 'flipInX',
		    items:1,
		    // margin:30,
		    // stagePadding:30,
		    // smartSpeed:450
		})
    	})
    </script>
@endsection
