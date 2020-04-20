<section class="section slider-pickups">
    <div class="container">
   		<!-- Swiper -->
	  	<div class="swiper-container" id="slider-pickups">
			<div class="container swiper-wrapper">
				@foreach($featuredProjects as $pProject)
					<div class="swiper-slide">
						<div class="project">
							<img src="{{$pProject->thumbnail}}">
						</div>
					</div>
				@endforeach
			</div>
			<!-- Add Arrows -->
			<div class="swiper-button-next"></div>
			<div class="swiper-button-prev"></div>
	  </div>
	</div>
</section>
@push("scripts")
	<script type="text/javascript" src="{{ asset('/assets/libs/swiper/js/swiper.min.js') }}"></script>
	<script>
    var swiper = new Swiper('#slider-pickups', {
		slidesPerView: 3,
		loop: true,
		loopFillGroupWithBlank: false,
		pagination: {
			el: '.swiper-pagination',
			clickable: true,
		},
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
    });
  </script>
@endpush
@push('head')
	<link rel="stylesheet" href="{{ asset('/assets/libs/swiper/css/swiper.min.css') }}">
	<style type="text/css">
	.swiper-container {
		width: 100%;
		height: 100%;
	}
	.swiper-container .swiper-wrapper{
		max-width: 1000px;
	}
	.swiper-slide {
    		padding: 10px;
		text-align: center;
		font-size: 18px;
		background: transparent;

		/* Center slide text vertically */
		display: -webkit-box;
		display: -ms-flexbox;
		display: -webkit-flex;
		display: flex;
		-webkit-box-pack: center;
		-ms-flex-pack: center;
		-webkit-justify-content: center;
		justify-content: center;
		-webkit-box-align: center;
		-ms-flex-align: center;
		-webkit-align-items: center;
		align-items: center;

	}
	.swiper-slide .project{
		width: 100%;
		height: 100%;
		display: block;
		box-shadow: 2px 2px 8px #842c2c;	
		background-color: #FFF;
		display: flex;
		align-items: center;
		justify-content: center;
	}
	.swiper-slide .project img{
		width: 100%;
	}
	</style>
  @endpush