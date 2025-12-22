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
						{{ __('Shop') }}
					</h1>
					<ul class="pages">
						<li>
							<a href="{{ route('front.index') }}">
								{{ __('Home') }}
							</a>
						</li>
						<li class="active">
							<a href="#">
								{{ __('Shop') }}
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!--Main Breadcrumb Area End -->

 	<!-- Shop Area Start -->
     <section class="shop-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="product-filter ">
						<div class="left">
							<p>{{ __('Total Available Products :') }} {{ $count_product }}</p>
						</div>
						<div class="right">
							<form action="{{ route('front.products') }}" method="GET" class="product-search-form">
									<input type="text" class="form-control" name="search" placeholder="{{ __('Search') }}" value="{{ request()->input('search')}}">
									<button type="submit"><i class="fas fa-search"></i></button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="row ">
				@foreach ($products as $product)
				<div class="col-lg-3 col-md-6">
					<div class="single-product">
						<div class="img">
							<img src="{{ asset('assets/front/img/'. $product->image) }}" alt="">
						</div>
						<div class="content">
							<h4 class="name">
								<a href="{{ route('front.product.details', $product->slug) }}">{{ $product->title }}</a>
							</h4>
							<div class="price">
								{{ Helper::showCurrency() }}{{ $product->current_price }} <del>{{ Helper::showCurrency() }}{{ $product->current_price }}</del>
							</div>
							@if(Auth::user())
								<a data-href="{{route('add.cart',$product->id)}}" href="#" class="mybtn1 add-cart-btn first cart-link"> {{__('Add
								to Cart')}} <i class="fas fa-shopping-cart"></i></a>
							@else
								<a href="{{ route('user.login') }}" class="mybtn1">{{ __('Add to Cart') }}</a>
							@endif
						</div>
					</div>
				</div>
				@endforeach
			</div>
			<div class="row">
				<div class="d-inline-block mx-auto">
				  {{$products->links()}}
				</div>
			  </div>
		</div>
	</section>
	<!-- Shop Area End -->

@endsection
