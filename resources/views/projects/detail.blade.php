@extends('layouts.app')
@push('title'){{ $project->name }}@endpush
@section('content')

@include("includes.sorting")
<section class="section project-detail single-project">
    <div class="container">
        <h1 class="page-title"><span>{{ $project->name }}</span></h1>
        <div class="category"> カテゴリ <span>{{ $project->project_category->name }}</span></div>
        <div class="project-info">
        	<div class="left">
				<!-- Swiper -->
				@if($project->gallery)
				<div class="swiper-container gallery-project">
					<div class="swiper-wrapper">
						@foreach( $project->gallery as  $image)
						<div class="swiper-slide">
							<img src="{{ $image }}" />
						</div>
						@endforeach
					</div>
					<!-- Add Arrows -->
					<div class="swiper-button-next swiper-button-white"></div>
					<div class="swiper-button-prev swiper-button-white"></div>
				</div>
				<div class="swiper-container gallery-thumbs">
					<div class="swiper-wrapper">
						@foreach( $project->gallery as  $image)
						<div class="swiper-slide">
							<img src="{{ $image }}" />
						</div>
						@endforeach
					</div>
				</div>
				@endif
        	</div>
        	<div class="right">
        		<div class="details">
        			<div class="detail">
        				<label>募金総額</label>
        				<div class="info money">¥{{ $project->TotalDonatedFormat}}</div>
        			</div>
        			<div class="detail">
        				<label>募金者数</label>
        				<div class="info donated">{{ $project->TotalDonatedNumber}} 人</div>
        			</div>
        			<div class="detail">
        				<label>募集終了まで</label>
        				<div class="info end_time">{{ $project->days_left}}</div>
        			</div>
        		</div>
        		<div class="detail-action">
        			<form method="POST" action="{{ route('donate.store',['id' =>  $project->id])}}" >
                    @csrf
	                    <div class="donate-control">
	                        <label>
	                            <p>※募金する金額を入力してください</p>
	                            <input type="number" name="money" value="">
	                            @if($errors->any())
	                            	<div class="errors">{{$errors->first()}}</div>
	                            @endif
	                        </label>
	                    </div>
	                    <div class="donate-action">
	                        <button class="btn btn-donate" type="submit">このプロジェクトに募金する</button>
	                    </div>
                	</form>
                	<a href="{{ route('reports.index') }}" class="btn  btn-report">
                		募金現場レポート
                	</a>
        		</div>
        	</div>
        </div>
    </div>
</section>
<section class="section single-project">
	<div class="container">
        <div class="project-info">
        	<div class="left">
        		<div class="project-content" >
        			{!! $project->content !!}
        		</div>
	            <div class="project-recruiter">
	            	<div class="info">
	            		<div class="avatar">
	            			<img src="{{  $project->recruiter_avatar?:asset('assets/images/common/recruiter-avatar.png') }}">
	            		</div>
	            		<h3 class="name">{{  $project->recruiter_name }}</h3>
	            	</div>
	            	<div class="about">
	            		{!!  nl2br($project->recruiter_content) !!}
	            	</div>
	            </div>
        	</div>
        </div>
    </div>
</section>

@include("includes.pickups")
@stop
@if($project->gallery)
@push('scripts')
 <script>
    var galleryThumbs = new Swiper('.gallery-thumbs', {
      spaceBetween: 10,
      slidesPerView: 4,
      loop: true,
      freeMode: false,
      loopedSlides: 10, //looped slides should be the same
      watchSlidesVisibility: true,
      watchSlidesProgress: true,
    });
    var galleryTop = new Swiper('.gallery-project', {
      spaceBetween: 0,
      loop:true,
      loopedSlides: 5, //looped slides should be the same
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      thumbs: {
        swiper: galleryThumbs,
      },
    });
  </script>
@endpush
@endif