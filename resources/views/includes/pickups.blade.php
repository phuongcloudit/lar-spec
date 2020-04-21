<section class="slider-pickups-section">
	<div class="slider-pickups-content">
		<div class="swiper-container" id="slider-pickups">
			<div class="swiper-wrapper">
				@foreach($featuredProjects as $pProject)
					<div class="swiper-slide">
						<div class="project">
							<img src="{{$pProject->thumbnail}}">
						</div>
					</div>
				@endforeach
			</div>
			<div class="swiper-button swiper-button-next"></div>
			<div class="swiper-button swiper-button-prev"></div>
		</div>
	</div>
</section>
@push("scripts")
<script type="text/javascript" src="{{ asset('/assets/libs/swiper/js/swiper.min.js') }}"></script>
<script>
var swiper = new Swiper('#slider-pickups', {
	slidesPerView: 1,
	loop: true,
	pagination: {
		el: '.swiper-pagination',
		clickable: true,
	},
	navigation: {
		nextEl: '.swiper-button-next',
		prevEl: '.swiper-button-prev',
	},
	breakpoints: {
		768: {
			slidesPerView: 3,
			spaceBetween: 30,
		},
		1230: {
			slidesPerView: 5,
			spaceBetween: 50,
		},
	}
});
</script>
@endpush
@push('head')
	<link rel="stylesheet" href="{{ asset('/assets/libs/swiper/css/swiper.min.css') }}">
@endpush