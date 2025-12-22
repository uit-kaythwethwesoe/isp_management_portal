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
						{{ __('Media') }}
					</h1>
					<ul class="pages">
						<li>
							<a href="{{ route('front.index') }}">
								{{ __('Home') }}
							</a>
						</li>
						<li class="active">
							<a href="#">
								{{ __('Media') }}
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!--Main Breadcrumb Area End -->

<!-- Media Area Start -->
	<section class="media-page">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-6 col-md-8">
					<div class="section-heading">
						<h2 class="title">
							{{ $sectionInfo->entertainment_title }}
						</h2>
						<p class="text">
							{{ $sectionInfo->entertainment_subtitle }}
						</p>
					</div>
				</div>
			</div>
			<div class="row">
                @foreach($entertainments as $key => $entertainment)
				<div class="col-lg-3 col-md-6">
					<div class="single-service entertainment">
						<div class="left-area">
							<img src="{{ asset('assets/front/img/'.$entertainment->icon) }}" alt="">
						</div>
						<div class="right-area">
							<h4 class="title">
								{{ $entertainment->counter }}{{ __('+') }}
							</h4>
							<p class="sub-title">{{ $entertainment->name }}</p>
						</div>
					</div>
                </div>
                @endforeach
			</div>
		</div>
		<div class="container mt-5 pt-3">
			<div class="row justify-content-center">
				<div class="col-lg-6 col-md-8">
					<div class="section-heading">
						<h2 class="title">
						{{ $sectionInfo->media_zone_title }}
						</h2>
						<p class="text">
						{{ $sectionInfo->media_zone_subtitle }}
						</p>
					</div>
				</div>
			</div>
			<div class="row">
                @foreach($mediazones as $key => $mediazone)
				<div class="col-lg-3 col-md-6">
					<a href="{{ $mediazone->link }}" class="single-service media d-block" target="_blank">
						<div class="left-area">
								<img src="{{ asset('assets/front/img/'.$mediazone->icon) }}" alt="">
						</div>
						<div class="right-area">
							<h4 class="title">
								{{ $mediazone->name }}
							</h4>
						</div>
					</a>
                </div>
                @endforeach
			</div>
		</div>
	</section>
<!-- Media Area End-->

@endsection
