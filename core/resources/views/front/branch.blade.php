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
						{{ __('Branch') }}
					</h1>
					<ul class="pages">
						<li>
							<a href="{{ route('front.index') }}">
								{{ __('Home') }}
							</a>
						</li>
						<li class="active">
							<a href="#">
								{{ __('Branch') }}
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!--Main Breadcrumb Area End -->

<!-- Branch Area Start -->
	<section class="branch-page">
		<div class="container">
			<div class="row">
                @foreach($branches as $key => $branche)
				<div class="col-lg-6">
					<div class="single-branch">
						{!! $branche->iframe !!}
						<div class="content">
							<div class="top-area">
								<div class="icon">
								<i class="fas fa-code-branch"></i>
								</div>
								<h4>{{ $branche->branch_name }}</h4>
							</div>
							<ul>
								<li>
									<i class="fas fa-user-tie"></i>  {{ $branche->manager }}
								</li>
								<li>
									<i class="fas fa-phone"></i> 
									@php
										$phone = explode( ',', $branche->phone );
										for ($i=0; $i < count($phone); $i++) { 
											echo $phone[$i].', ';
										}
									@endphp
								</li>
								<li>
									<i class="fas fa-envelope"></i>
									@php
										$email = explode( ',', $branche->email );
										for ($i=0; $i < count($email); $i++) { 
											echo $email[$i].', ';
										}
									@endphp
								</li>
								<li>
									<i class="fas fa-map-marker-alt"></i> {{ $branche->address }} 
								</li>
							</ul>
						</div>
					</div>
                </div>
                @endforeach
			</div>
		</div>
	</section>
	<!-- Branch Area End-->

@endsection
