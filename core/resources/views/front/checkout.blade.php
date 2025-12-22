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
						{{ __('Checkout') }}
					</h1>
					<ul class="pages">
						<li>
							<a href="{{ route('front.index') }}">
								{{ __('Home') }}
							</a>
						</li>
						<li class="active">
							<a href="#">
								{{ __('Checkout') }}
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!--Main Breadcrumb Area End -->


	<form class="needs-validation" action="javascript:;" id="payment_gateway_check" method="POST">
		@csrf
		<!-- Checkout Area Start -->
		<section class="checkout-area">
		  <div class="container">
			<div class="row">
			  <div class="col-md-5 order-md-2 mb-4">
				<div class="cart-product">
				  <h4 class="d-flex justify-content-between align-items-center mb-3 g-title">
					<span>{{ __('Your cart') }}</span>
				  @php
					  $countitem = 0;
					  $cartTotal = 0;
					  if($cart){
						  foreach($cart as $p){
							  $cartTotal += (double)$p['price'] * (int)$p['qty'];
							  $countitem += $p['qty'];
						  }
					  }
	  
				  @endphp
					<span class="badge badge-success badge-pill cart-item-view">{{ $countitem }}</span>
				  </h4>
				  <div class="table-responsive">
					<table class="table table-bordered">
					  <thead>
						<tr>
						  <th width="45%">{{ __('Product Name') }}</th>
						  <th width="25%" class="t-total">{{ __('Total') }}</th>
						</tr>
					  </thead>
					  <tbody>
					  @foreach ($cart as $id => $item)
					  <tr>
						<td>
						  @php
							  $product = App\Product::findOrFail($id);
						  @endphp
						  <h4 class="product-title"><a href="{{ route('front.product.details',$product->slug) }}">{{ $item['name'] }}</a></h4>
						</td>
						<td class="price">{{ $item['price'] }} * {{ $item['qty'] }}
						  = {{ Helper::showCurrencyPrice($item['price'] * $item['qty']) }}</td>
					  </tr>
					  @endforeach
					  </tbody>
					</table>
				  </div>
				  @php
					  $shipping_methods = DB::table('shippings')->where('language_id',$currentLang->id)->where('status',1)->get();
				  @endphp
				  @if(count($shipping_methods)>0)
				  <div class="add-shiping-methods">
					<h4 class="g-title">{{ __('Shipping Methods') }}</h4>
					<div class="table-responsive">
					  <table class="table table-bordered">
						<thead class="cart-header">
						  <tr>
							<th class="custom-space">#</th>
							<th>{{ __('Method') }}</th>
						  </tr>
						</thead>
						<tbody>
							@foreach ($shipping_methods as $method)
							<tr>
							  <td>
								<input type="radio" @if($loop->first ) checked="" @endif name="shipping_charge" data="{{ Helper::showPrice($method->cost) }}" class="shipping-charge"
								  value="{{ Helper::showPrice($method->cost) }}">
							  </td>
							  <td>
								<p><strong>{{ $method->title }} (<span>{{ Helper::showCurrencyPrice($method->cost) }}</span>)</strong></p>
								<p><small>{{ $method->subtitle }}</small></p>
							  </td>
							</tr>
							@endforeach
						</tbody>
					  </table>
					</div>
				  </div>
				  @endif
				  <div class="cart-summery">
					<h4 class="title g-title">
					  {{ __('Cart Summery') }} :
					</h4>
					<table class="table table-bordered">
					  <tr>
						<th width="33.3%">{{ __('Subtotal') }}</th>
						<td>{{ Helper::showCurrencyPrice($cartTotal) }} </td>
					  </tr>
					  @if($shipping_methods->count() > 0)
					  @php
						  $shipping_cost = Helper::showPrice(json_decode($shipping_methods,true)[0]['cost']);
					  @endphp
					  <tr>
						  <th width="33.3%">{{ __('Shiping Cost') }}</th>
						  <td>+ <span>{{ Helper::showCurrency() }}</span><span class="shipping_cost">{{ $shipping_cost }}</span> </td>
						</tr>
					  @endif
					  <tr>
						<th width="33.3%">{{ __('Total') }}</th>
						<td><span>{{ Helper::showCurrency() }}</span><span class="grand_total" data="{{ $cartTotal }}" >{{ $cartTotal + $shipping_cost }}</span> </td>
					  </tr>
					</table>
				  </div>
				</div>
	  
	  
			  </div>
			  <div class="col-md-7 order-md-1">
				
				  <div class="billing-area">
					<h4 class="mb-3 g-title">{{ __('Billing Address') }}</h4>
					  @php
						  $user = Auth::user();
					  @endphp
					<div class="mb-3">
					  <label for="name">{{ __('Name') }}</label>
					  <input type="text" class="form-control" id="name" name="billing_name" value="{{ $user->name }}">
					  @if ($errors->has('billing_name'))
						<p class="text-danger"> {{ $errors->first('billing_name') }} </p>
					  @endif
					</div>
					<div class="mb-3">
					  <label for="address">{{ __('Address') }}</label>
					  <input type="text" class="form-control" name="billing_address" value="{{ $user->address }}" id="address">
					  @if ($errors->has('billing_address'))
						<p class="text-danger"> {{ $errors->first('billing_address') }} </p>
					  @endif
					</div>
	  
					<div class="row">
					  <div class="col-md-6 mb-3">
						<label for="email">{{ __('Email') }}</label>
						<input type="email" class="form-control" name="billing_email" value="{{ $user->email }}" id="email" >
						@if ($errors->has('billing_email'))
						<p class="text-danger"> {{ $errors->first('billing_email') }} </p>
						@endif
					  </div>
					  <div class="col-md-6 mb-3">
						<label for="number">{{ __('Phone Number') }}</label>
						<input type="text" class="form-control" id="number" value="{{ $user->phone }}" name="billing_number"  >
						@if ($errors->has('billing_number'))
						<p class="text-danger"> {{ $errors->first('billing_number') }} </p>
						@endif
					  </div>
					</div>
	  
					<div class="row">
					  <div class="col-md-5 mb-3">
						<label for="country">{{ __('Country') }}</label>
						<input type="text" class="form-control" name="billing_country" value="{{ $user->country }}" id="country">
						@if ($errors->has('billing_country'))
						<p class="text-danger"> {{ $errors->first('billing_country') }} </p>
						@endif
					  </div>
					  <div class="col-md-4 mb-3">
						<label for="state">{{ __('City') }}</label>
						<input type="text" class="form-control" name="billing_city" value="{{ $user->city }}" id="city" >
						@if ($errors->has('billing_city'))
						<p class="text-danger"> {{ $errors->first('billing_city') }} </p>
						@endif
					  </div>
					  <div class="col-md-3 mb-3">
						<label for="zip-code">{{ __('Zip Code') }}</label>
						<input type="text" class="form-control" name="billing_zip" value="{{ $user->zipcode }}" id="zip-code" >
						@if ($errors->has('billing_zip'))
						<p class="text-danger"> {{ $errors->first('billing_zip') }} </p>
						@endif
					  </div>
					</div>
				  </div>
	  
				  <div class="ship-diff-toogle">
					<div class="custom-control custom-switch">
					  <input type="checkbox" class="custom-control-input" name="is_ship" id="change_address"{{ old('is_ship') == 'on' ? 'checked' : '' }}>
					  <label class="custom-control-label" for="change_address">{{ __('Ship to a different location?') }}</label>
					</div>
				  </div>
	  
				  <div class="shipping-area mb-4 {{ old('is_ship') == 'on' ? '' : 'd-none' }}" id="shipping-area">
					<h4 class="mb-3 g-title">{{ __('shipping Address') }}</h4>
						 <div class="mb-3">
					  <label for="name">{{ __('Name') }}</label>
					  <input type="text" class="form-control" id="name" name="shipping_name">
					  @if ($errors->has('shipping_name'))
					  <p class="text-danger"> {{ $errors->first('shipping_name') }} </p>
					  @endif
					</div>
					<div class="mb-3">
					  <label for="address">{{ __('Address') }}</label>
					  <input type="text" class="form-control" name="shipping_address" id="address" >
					  @if ($errors->has('shipping_address'))
					  <p class="text-danger"> {{ $errors->first('shipping_address') }} </p>
					  @endif
					</div>
	  
					<div class="row">
					  <div class="col-md-6 mb-3">
						<label for="email">{{ __('Email') }}</label>
						<input type="email" class="form-control" name="shipping_email" id="email"  >
						@if ($errors->has('shipping_email'))
						<p class="text-danger"> {{ $errors->first('shipping_email') }} </p>
						@endif
					  </div>
					  <div class="col-md-6 mb-3">
						<label for="number">{{ __('Phone Number') }}</label>
						<input type="text" class="form-control" id="number" name="shipping_number" >
						@if ($errors->has('shipping_number'))
						<p class="text-danger"> {{ $errors->first('shipping_number') }} </p>
						@endif
					  </div>
					</div>
	  
					<div class="row">
					  <div class="col-md-5 mb-3">
						<label for="country">{{ __('Country') }}</label>
						<input type="text" class="form-control" name="shipping_country" id="country" >
						@if ($errors->has('shipping_country'))
						<p class="text-danger"> {{ $errors->first('shipping_country') }} </p>
						@endif
					  </div>
					  <div class="col-md-4 mb-3">
						<label for="state">{{ __('City') }}</label>
						<input type="text" class="form-control" name="shipping_city" id="state" placeholder="{{ __('City') }}" >
						@if ($errors->has('shipping_city'))
						<p class="text-danger"> {{ $errors->first('shipping_city') }} </p> 
						@endif
					  </div>
					  <div class="col-md-3 mb-3">
						<label for="zip-code">{{ __('Zip Code') }}</label>
						<input type="text" class="form-control" name="shipping_zip" id="zip-code" >
						@if ($errors->has('shipping_zip'))
						<p class="text-danger"> {{ $errors->first('shipping_zip') }} </p>
						@endif
					  </div>
					</div>
				  </div>
				  
				  <div class="patment-area">
					<h4 class="mb-3 g-title"> {{ __('Select Payment Gateway') }} </h4>
					<div class="d-block my-3">
					  <div class="payment-gateway">
						  <ul class="select-payment">
							  @foreach (DB::table('payment_gateweys')->where('status',1)->get() as $gateway)
							  <li class="product_payment_gateway_check" data-href="{{ $gateway->id }}" id="{{ $gateway->type == 'automatic' ? $gateway->name : $gateway->title }}">
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
	  
					<hr class="mb-4">
					<button class="mybtn1" type="submit">{{ __('Place Order') }}</button>
				  </div>
			   
			  </div>
			</div>
		  </div>
		</section>
	</form>
	<input type="hidden" id="product_paypal" value="{{route('product.paypal.submit')}}">
	<input type="hidden" id="product_stripe" value="{{route('product.stripe.submit')}}">



@endsection
