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
						{{ $service->name }}
					</h1>
					<ul class="pages">
						<li>
							<a href="{{ route('front.index') }}">
								{{ __('Home') }}
							</a>
						</li>
						<li class="active">
							<a href="{{ route('front.service') }}">
								{{ __('Service') }}
							</a>
						</li>
						<li class="active">
							<a href="#">
								{{ $service->name }}
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!--Main Breadcrumb Area End -->

    <!-- Faq Area Start -->
	<section class="service-area service-page">
        <div class="container">
            <div class="row">
              <div class="col-lg-4">
                <div class="category-widget">
                    <h4>{{ __('Services') }}</h4>
                  <ul class="category-list">
                    @foreach ($all_services as $data)
                    <li>
                      <a href="{{ route('front.service.details', $data->slug) }}" class="@if($service->id == $data->id ) active  @endif">
                        <i class="fas fa-angle-double-right"></i>{{ $data->name }} 
                      </a>
                    </li>
                    @endforeach
                  </ul>
                </div>
                <div class="get-support">
                  <i class="fas fa-headset"></i>
                  <h4>{{ __('Live Support') }}</h4>
                  @php
                    $number = explode( ',', $commonsetting->number );
                    for ($i=0; $i < count($number); $i++) { 
                      echo '<p class="number">'.$number[$i].'</p>';
                    }
                  @endphp
                </div>
              </div>
              <div class="col-lg-8">
                <div class="service-content-wrapper">
                  <div class="main-image">
                    <img src="{{ asset('assets/front/img/'.$service->image) }}" alt="">
                  </div>
                  <div class="content">
  
                    <h3 class="title">{{ $service->name }}</h3>
                    {!! $service->content !!}
                  </div>
                </div>
              </div>
            </div>
          </div>
	</section>
	<!-- Faq Area End -->

@endsection
