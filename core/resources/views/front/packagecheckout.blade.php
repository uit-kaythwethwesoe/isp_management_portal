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
					{{ __('Buy Package') }}
				</h1>
				<ul class="pages">
					<li>
						<a href="{{ route('front.index') }}">
							{{ __('Home') }}
						</a>
					</li>
					<li class="active">
						<a href="#">
							{{ __('Buy Package') }}
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<!--Main Breadcrumb Area End -->

<!-- Package Checkout Area Start -->
<form class="needs-validation" action="javascript:;" id="plan_order_submit" method="POST">
	@csrf
<section class="pricingPlan-section packag-page orderpage">
	<div class="container">
		<div class="row">
			<div class="col-lg-8">
				<h4 class="mb-4">
					<strong>
						@if($already_purchased)
							{{ __('You already purchased a package, now update your package :') }}
						@else
							{{ __('Buy this package :') }}
						@endif
					</strong>
				</h4>
				<table class="table border table-striped">
					<tbody>
						<tr>
							<th scope="row">{{ __('Name') }}</th>
							<td>{{ Auth::user()->name }}</td>
						</tr>
						<tr>
							<th scope="row">{{ __('Email') }}</th>
							<td>{{ Auth::user()->email }}</td>
						</tr>
						<tr>
							<th scope="row">{{ __('Phone') }}</th>
							<td>{{ Auth::user()->phone }}</td>
						</tr>
						<tr>
							<th scope="row">{{ __('Address') }}</th>
							<td>{{ Auth::user()->address }}</td>
						</tr>
					</tbody>
				</table>
				<div class="patment-area">
					<h4 class="mb-3 g-title"> {{ __('Select Payment Gateway :') }} </h4>
					<div class="d-block my-3">
						<div class="payment-gateway">
							<ul class="select-payment">
								@foreach (DB::table('payment_gateweys')->where('status',1)->get() as $gateway)
								<li class="plan_payment_gateway_check" data-href="{{ $gateway->id }}" id="{{ $gateway->type == 'automatic' ? $gateway->name : $gateway->title }}">
								  <p class="mybtn2">{{ $gateway->name }}</p>
								</li>
								@endforeach
							  </ul>
							@if ($errors->has('gateway'))
								<p class="text-danger"> {{ $errors->first('gateway') }} </p>
							@endif
						</div>
					</div>
					<input type="hidden" value="" id="payment_gateway" name="payment_gateway" value="payment_gateway">
					<div class="payment_show_check d-none">
						<div class="gd-payment-form-wrapper">
							<div class="payment-form-wrapper-inner">
								<div class="card willFlip" id="willFlip">
									<div class="front">
											<div class="d-flex justify-content-between">
												<img src="{{ asset('assets/front/img') }}/card/card_bank.png" width="50" style="filter: contrast(0)" height="50" alt="">
												<img src="{{ asset('assets/front/img') }}/card/visa.png" width="50" height="50" alt="">
											</div>
											<div class="mt-1">
												<div class="form-group">
													<label for="cardNumber"></label>
													<input type="text" class="form-control animate__animated animate__bounce animate__duration-2s" disabled readonly id="cardNumber">
												</div>
											</div>
											<div class="front-bottom">
												<div class="card-holder-content">
													<div class="form-group">
														<label for="cardHolderValue">{{ __('Card Holder') }}</label>
														<input type="text" placeholder="FULL NAME" disabled class="cardHolder form-control animate__animated animate__bounce animate__duration-2s" id="cardHolderValue">
													</div>
												</div>
												<div class="card-expires-content">
													<div class="input-date">
														<label for="expiredMonth" class="text-right d-block">{{ __('Expires') }}</label>
														<div class="row content-date-input justify-content-end animate__animated animate__duration-2s animate__bounce">
															<input type="text" disabled class="cardHolder col-4 form-control" id="expiredMonth">
															<h4 class="mt-1 p-2 slash-text"> / </h4>
															<input type="text" disabled class="cardHolder col-4 form-control" id="expiredYear">
														</div>
													</div>
												</div>
											</div>
									</div>
									<div class="back">
										<div class="card-bar"></div>
										<div class="col-md-12  back-middle">
											<div class="form-group">
												<label for="cardCcv" class="text-right d-block">{{ __('CVC') }}</label>
												<input type="password" disabled class="form-control" id="cardCcv">
											</div>
											<img src="{{ asset('assets/front/img') }}/card/visa.png" class="float-right" width="50" height="50" alt="">
										</div>
									</div>
								</div>
								<div class="paymentmainform" id="paymentmainform">
									<input type="hidden" name="gateway" id="plan_payment_id" value="">
									<input type="hidden" name="packageprice"  value="
									@if($packagedetails->discount_price == null)
										{{ $packagedetails->price}}
									@else 
										{{ $packagedetails->discount_price }}
									@endif
									">
									<input type="hidden" name="packagename"  value="{{ $packagedetails->name }}">
									<input type="hidden" name="packageid"  value="{{ $packagedetails->id }}">
									<div class="stripe-inner-form">
										<div class="form-group">
											<label for="cardInput">{{ __('Card Number') }}</label>
											<input class="input card-input_field form-control" name="card_number" id="cardInput">
										</div>
										<div class="form-group">
											<label for="cardHolder">{{ __('Card Holder') }}</label>
											<input class="card-input_field form-control" name="fullname" id="cardHolder">
										</div>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label for="monthInput">{{ __('Expiration Date') }}</label>
													<select name="month" class="form-control card-input_field" id="monthInput">
														<option class="disabled" readonly>{{ __('Month') }}</option>
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="yearInput"></label>
													<select name="year" class="form-control card-input_field mt-2" id="yearInput">
														<option class="disabled" readonly>{{ __('Year') }}</option>
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="cwInput">{{ __('CVC') }}</label>
													<input type="text" name="cvc" class="form-control card-input_field" id="cwInput">
												</div>
											</div>
										</div>
									</div>
									
								</div>
							</div>
						</div>
					</div>
					<hr class="mb-4">
					<button type="submit" class="mybtn1 submitbtn">{{ __('Submit') }}</button>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="single-price">
					<h4 class="name">
						{{ $packagedetails->name }}
					</h4>
					<div class="mbps">
						{{ $packagedetails->speed }} <span>{{ __('Mbps') }}</span>
					</div>


					<div class="list">
						@php
						$feature = explode( ',', $packagedetails->feature );
						for ($i=0; $i < count($feature); $i++) { 
							echo '<li><p href="mailto:'.$feature[$i].'">'.$feature[$i].'</p></li>';
						}
					@endphp
					</div>
					<div class="bottom-area">
						<div class="price-area">
							<div class="price-top-area">
								@if($packagedetails->discount_price == null)
									<p class="price showprice">{{ Helper::showCurrency() }}{{ $packagedetails->price }}</p>
								@else
									<p class="discount_price showprice">{{ Helper::showCurrency() }}{{ $packagedetails->discount_price }}</p>
									<p class="price discounted"><del>{{ Helper::showCurrency() }}{{ $packagedetails->price }}</del></p>
								@endif
							</div>
							<p class="time">
								{{ $packagedetails->time }}
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
</form>


<input type="hidden" id="plan_paypal" value="{{route('package.paypal.submit')}}">
<input type="hidden" id="plan_stripe" value="{{route('package.stripe.submit')}}">
<!-- Package Checkout Area End-->

@endsection