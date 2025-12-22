@extends('front.layout')

@section('meta-keywords', "$setting->meta_keywords")
@section('meta-description', "$setting->meta_description")
@section('content')

	<!--Main Breadcrumb Area Start -->
	<div class="main-breadcrumb-area" style="background-image : url('{{ asset('assets/front/img/' . $commonsetting->breadcrumb_image) }}');">
        <div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="pagetitle">
						{{ __('About') }}
					</h1>
					<ul class="pages">
						<li>
							<a href="{{ route('front.index') }}">
								{{ __('Home') }}
							</a>
						</li>
						<li class="active">
							<a href="#">
								{{ __('About') }}
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!--Main Breadcrumb Area End -->

	<!-- About Area Start -->
	<section class="about-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 align-self-center">
					<div class="section-heading">
						<h4 class="title">
							{{ $sectionInfo->about_title }}
						</h4>
						<p class="text">
							{!! $sectionInfo->about_subtitle !!}
						</p>
						<ul class="list">
							@foreach($abouts as $key => $about)
							<li>
								<p>{{ $about->feature }}</p>
							</li>
							@endforeach
						</ul>
					</div>
				</div>
				<div class="col-lg-6 align-self-center">
					<div class="right-images">
						<img  src="{{ asset('assets/front/img/'.$sectionInfo->about_image) }}" alt="">
					</div>
				</div>
			</div>
		</div>
	</section>
    <!-- About Area End -->
    
	
	<!-- Counter Area Start -->
	<section class="counter-section"  
	@if($commonsetting->is_counter_bg)
	style="background-image : url('{{ asset('assets/front/img/' . $sectionInfo->funfact_bg) }}')"
	@endif
	>
	@if($commonsetting->is_counter_bg)
		<div class="overlay"></div>
		@endif
		<div class="container">
			<div class="row">
				@foreach ($funfacts as $funfact)
					<div class="col-lg-3 col-md-6">
						<div class="single-counter">
							<div class="icon">
								<img src="{{ asset('assets/front/img/'.$funfact->icon) }}" alt="">
							</div>
							<div class="content">
								<h4>{{ $funfact->value }}</h4>
								<p>{{ $funfact->name }}</p>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</section>
	<!-- Counter Banner Area End -->
	

	<!-- Offer Area Start -->
	<section class="offer-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-6 col-md-8">
					<div class="section-heading">
						<h2 class="title">
							{{ $sectionInfo->offer_title }}
						</h2>
						<p class="text">
							{{ $sectionInfo->offer_subtitle }}
						</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 align-self-center">
					<ul class="offer-list">
						@foreach($offers as $key => $offer)
						<li>
							<div class="content">
								{!! $offer->offer !!}
							</div>
						</li>
						@endforeach
					</ul>
				</div>
				<div class="col-lg-6 align-self-center">
					<div class="offer-image">
						<img class="w-80" src="{{ asset('assets/front/img/'.$sectionInfo->offer_image) }}" alt="">
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Offer Area End -->

@endsection
