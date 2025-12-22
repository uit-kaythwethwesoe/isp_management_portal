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
						{{ __('Package') }}
					</h1>
					<ul class="pages">
						<li>
							<a href="{{ route('front.index') }}">
								{{ __('Home') }}
							</a>
						</li>
						<li class="active">
							<a href="#">
								{{ __('Package') }}
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
    <!--Main Breadcrumb Area End -->
    
	<!-- Pricingplan Area Start -->
	<section class="pricingPlan-section packag-page">
		<div class="container">
			<div class="row justify-content-center">
                @foreach($plans as $key => $plan)
                <div class="col-lg-4 col-md-6">
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
	</section>
	<!-- Pricingplan Area End -->

@endsection
