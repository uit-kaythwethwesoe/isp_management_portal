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
						{{ __('Contact') }}
					</h1>
					<ul class="pages">
						<li>
							<a href="{{ route('front.index') }}">
								{{ __('Home') }}
							</a>
						</li>
						<li class="active">
							<a href="#">
								{{ __('Contact') }}
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!--Main Breadcrumb Area End -->

    <!-- Contact Us Area Start -->
	<section class="contact-us">
		<div class="container">
			<div class="row ">
				<div class="col-lg-7">
					<div class="left-area">
						<div class="contact-form">
							<form action="{{ route('front.contact.submit') }}" method="POST">
								@csrf
								<ul>
									<li>
										<input type="text" name="name" class="input-field" placeholder="{{ __('Name') }} *">
									</li>
									<li>
										<input type="email" name="email" class="input-field" placeholder="{{ __('Email Address') }} *">
									</li>
									<li>
										<input type="number" name="phone" class="input-field" placeholder="{{ __('Phone Number') }} *">
									</li>
									<li>
										<textarea name="message" class="input-field textarea" placeholder="{{ __('Your Message') }} *"></textarea>
									</li>
								</ul>
								<button class="submit-btn mybtn1" type="submit">{{ __('Send Message') }}</button>
							</form>
						</div>
					</div>
				</div>
				<div class="col-lg-5 align-self-center">
					<div class="right-area">
						<div class="contact-info">
							<div class="left ">
									<div class="icon">
										<i class="fas fa-envelope"></i>
									</div>
							</div>
							<div class="content">
									<h4 class="title">
										{{ __('Email') }}
									</h4>
									@php
										$email = explode( ',', $commonsetting->email );
										for ($i=0; $i < count($email); $i++) { 
											echo '<a href="mailto:'.$email[$i].'">'.$email[$i].'</a>';
										}
									@endphp
							</div>
                        </div>
                        <div class="contact-info">
							<div class="left ">
									<div class="icon">
										<i class="fas fa-phone"></i>
									</div>
							</div>
							<div class="content">
									<h4 class="title">
										{{ __('Phone') }}
									</h4>
									@php
										$number = explode( ',', $commonsetting->number );
										for ($i=0; $i < count($number); $i++) { 
											echo '<a href="tel:'.$number[$i].'">'.$number[$i].'</a>';
										}
									@endphp
							</div>
						</div>
						<div class="contact-info">
							<div class="left ">
									<div class="icon">
										<i class="fas fa-map-marker-alt"></i>
									</div>
							</div>
							<div class="content">
									<h4 class="title">
										{{ __('Location') }} 
									</h4>
										{{ $setting->address }}
							</div>
						</div>
						
						<div class="social-links">
							<h4 class="title">{{ __('Find us here :') }}</h4>
							<ul>
								@foreach($socials as $key => $social)
								<li>
									<a href="{{ $social->url }}">
										<i class="{{ $social->icon }}"></i>
									</a>
								</li>
								@endforeach
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Contact Us Area End-->

@endsection
