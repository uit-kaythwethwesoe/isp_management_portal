@extends('front.layout')
@section('meta-keywords', "$setting->meta_keywords")
@section('meta-description', "$setting->meta_description")
@section('content')

		<!-- Hero Area Start -->
	<section class="hero-area">
		<div class="hero-area-slider">
			<div class="intro-carousel">
				@foreach($sliders as $slider)
				<div class="intro-content slide-one" style="background-image: url({{ asset('assets/front/img/'.$slider->image) }})">
					<div class="container">
						<div class="row">
							<div class="col-lg-12">
								<div class="slider-content">
									<!-- layer 1 -->
									<div class="layer-1">
										<h4 class="subtitle">{{ $slider->name }}</h4>
										<h2 class="title">{{ $slider->offer }}</h2>
									</div>
									<!-- layer 2 -->
									<div class="layer-2">
										<p class="text">
											{{ $slider->desc }}
										</p>
									</div>
									<!-- layer 3 -->
									<div class="layer-3">
										<a href="{{ route('front.package') }}" class="mybtn1"><span>{{ __('Start Now') }}
												<i class="fas fa-angle-right"></i>
											</span></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				@endforeach
				
			</div>
		</div>
	</section>
	<!-- Hero Area End -->

	@if($commonsetting->is_about_section)
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
						</div>
						
						<ul class="list">
							@foreach($abouts as $key => $about)
							<li>
								<p>{{ $about->feature }}</p>
							</li>
							@endforeach
						</ul>
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
	@endif

	@if($commonsetting->is_package_section)
	<!-- Pricingplan Area Start -->
	<section class="pricingPlan-section" 
	@if($commonsetting->is_package_bg)
		style="background-image : url('{{ asset('assets/front/img/' . $sectionInfo->pricing_bg) }}')"
	@endif
	>
	@if($commonsetting->is_package_bg)
		<div class="overlay"></div>
	@endif
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-6 col-md-8">
					<div class="section-heading
					@if($commonsetting->is_package_bg)
					white-color
					@endif
					">
						<h2 class="title">
							{{ $sectionInfo->plan_title }}
						</h2>
						<p class="text">
							{{ $sectionInfo->plan_subtitle }}
						</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="pricing-slider">
						@foreach($plans as $key => $plan)
						<div class="slider-item">
							<div class="single-price">
								<h4 class="name">
									{{ $plan->name }}
								</h4>
								<div class="mbps">
									{{ $plan->speed }} <span>{{ __('Mbps') }}</span>
								</div>
									
									
								<div class="list">
									@php
								$feature = explode( ',', $plan->feature );
								for ($i=0; $i < count($feature); $i++) { 
									echo '<li><p href="mailto:'.$feature[$i].'">'.$feature[$i].'</p></li>';
								}
							@endphp
								</div>
								<div class="bottom-area">
									<div class="price-area">
										<div class="price-top-area">
											@if($plan->discount_price == null)
												<p class="price showprice">{{ Helper::showCurrency() }}{{ $plan->price }}</p>
											@else
												<p class="discount_price showprice">{{ Helper::showCurrency() }}{{ $plan->discount_price }}</p>
												<p class="price discounted"><del>{{ Helper::showCurrency() }}{{ $plan->price }}</del></p>
											@endif
										</div>
										<p class="time">
											{{ $plan->time }}
										</p>
									</div>
									@if(Auth::user())
									<a href="{{ route('front.packagecheckout', $plan->id) }}" class="mybtn1">{{ __('Get Start') }}</a>
									@else
									<a href="{{ route('user.login') }}" class="mybtn1">{{ __('Get Start') }}</a>
									@endif
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Pricingplan Area End -->
	@endif

	@if($commonsetting->is_offer_section)
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
	@endif

	@if($commonsetting->is_counter_section)
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
	@endif

	@if($commonsetting->is_service_section)
	<!-- Service Area Start -->
	<section class="service-area">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-6 col-md-8">
					<div class="section-heading">
						<h2 class="title">
							{{ $sectionInfo->service_title }}
						</h2>
						<p class="text">
							{{ $sectionInfo->service_subtitle }}
						</p>
					</div>
				</div>
			</div>
			<div class="row">
				@foreach($services as $key => $service)
				<div class="col-lg-4 col-md-6">
					<a href="{{ route('front.service.details', $service->slug) }}" class="single-service">
						<div class="left-area">
							<img class="w-80" src="{{ asset('assets/front/img/'.$service->icon) }}" alt="">
						</div>
						<div class="right-area">
							<h4 class="title">
								{{ $service->name }}
							</h4>
							<p class="text">
								{{ (strlen(strip_tags(Helper::convertUtf8($service->content))) > 120) ? substr(strip_tags(Helper::convertUtf8($service->content)), 0, 120) . '...' : strip_tags(Helper::convertUtf8($service->content)) }}
							</p>
						</div>
					</a>
				</div>
				@endforeach
			</div>
		</div>
	</section>
	<!-- Service Area End -->
	@endif

	@if($commonsetting->is_testimonial_section)
	<!-- Testimonial Start -->
	<section class="testimonial" id="testimonial"  
	@if($commonsetting->is_testimonial_bg)
	style="background-image : url('{{ asset('assets/front/img/' . $sectionInfo->testimonial_bg) }}')"
	@endif
	>
	@if($commonsetting->is_testimonial_bg)
		<div class="overlay"></div>
		@endif
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-6 col-md-8">
					<div class="section-heading
					@if($commonsetting->is_testimonial_bg)
					white-color
					@endif
					">
						<h2 class="title">
							{{ $sectionInfo->testimonial_title }}
						</h2>
						<p class="text">
							{{ $sectionInfo->testimonial_subtitle }}
						</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="testimonial-slider">
						@foreach ($testimonials as $testimonial)
						<div class="slider-item">
							<div class="single-review">
								<div class="stars">
									@for ($i = 0; $i < $testimonial->rating; $i++)
									<i class="fas fa-star"></i>
								@endfor
								</div>
								<div class="content">
									<p>
										{{ $testimonial->message }}
									</p>
								</div>
								<div class="reviewr">
									<div class="img">
										<img src="{{asset('assets/front/img/'.$testimonial->image) }}" alt="">
									</div>
									<div class="content">
										<h4 class="name">
											{{ $testimonial->name }}
										</h4>
										<p>
											{{ $testimonial->position }}
										</p>
									</div>
								</div>
							</div>
						</div>
						@endforeach
						
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Testimonial End -->
	@endif


	@if($commonsetting->is_blog_section)
	<!-- Blog Area Start -->
	<section class="blog-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-6 col-md-8">
					<div class="section-heading">
						<h2 class="title">
							{{ $sectionInfo->blog_title }}
						</h2>
						<p class="text">
							{{ $sectionInfo->blog_subtitle }}
						</p>
					</div>
				</div>
			</div>
			<div class="row justify-content-center">
				@foreach ($blogs as $blog)
				<div class="col-lg-4 col-md-6">
					<a href="{{route('front.blogdetails', $blog->slug)}}" class="single-blog">
						<div class="img">
							<img src="{{asset('assets/front/img/'.$blog->main_image) }}" alt="">
						</div>
						<div class="content">
							<ul class="top-meta">
								<li>
									<p class="date">
										{{date ( 'd M, Y', strtotime($blog->created_at) )}}
									</p>
								</li>
								<li>
									<p class="post-by">
										{{__('By,')}}  {{__('Admin')}}
									</p>
								</li>
							</ul>
								<h4 class="title">
									{{ (strlen(strip_tags(Helper::convertUtf8($blog->title))) > 50) ? substr(strip_tags(Helper::convertUtf8($blog->title)), 0, 50) . '...' : strip_tags(Helper::convertUtf8($blog->title)) }}
							</h4>
						</div>
					</a>
				</div>
				@endforeach
			
			</div>
		</div>
	</section>
	<!-- Blog Area End -->
	@endif

@endsection
