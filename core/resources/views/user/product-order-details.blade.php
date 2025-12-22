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
						{{ __('User Dashboard') }}
					</h1>
					<ul class="pages">
						<li>
							<a href="{{ route('front.index') }}">
								{{ __('Home') }}
							</a>
						</li>
						<li class="active">
							<a href="#">
								{{ __('User Dashboard') }}
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!--Main Breadcrumb Area End -->

    <!-- User Dashboard Start -->
	<section class="user-dashboard-area">
		<div class="container">
		  <div class="row">
			<div class="col-lg-3">
				@includeif('user.dashboard-sidenav')
			</div>
			<div class="col-lg-9">
                <div class="card">
                    <h5 class="card-header">{{ __('Order Details') }}</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 mt-3">
                                <div class="user-profile-details">
                                    <div class="order-details">
                                        <div class="progress-area-step">
                                            <ul class="progress-steps">
                                                <li class="{{$data->order_status == 'pending' ? 'active' : ''}}">
                                                    <div class="icon"><i class="fas fa-arrow-alt-circle-right"></i></div>
                                                    <div class="progress-title">{{__('Pending')}}</div>
                                                </li>
                                                <li class="{{$data->order_status == 'processing' ? 'active' : ''}}">
                                                    <div class="icon"><i class="fas fa-arrow-alt-circle-right"></i></div>
                                                    <div class="progress-title">{{__('Processing')}}</div>
                                                </li>
                                                <li class="{{$data->order_status == 'completed' ? 'active' : ''}}">
                                                    <div class="icon"><i class="fas fa-check-circle"></i></div>
                                                    <div class="progress-title">{{__('Completed')}}</div>
                                                </li>
                                                <li class="{{$data->order_status == 'rejected' ? 'active' : ''}}">
                                                    <div class="icon"><i class="fas fa-times-circle"></i></div>
                                                    <div class="progress-title">{{__('Rejected')}}</div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="title">
                                            <h4><strong>{{__('Order Details') }}</strong></h4>
                                            <hr>
                                        </div>
                                        <div id="print">
                                        <div class="view-order-page">
                                            <div class="order-info-area">
                                                <div class="row align-items-center">
                                                    <div class="col-lg-8">
                                                       <div class="order-info">
                                                           <h5 class="text-primary"><strong>{{__('Order')}} {{$data->order_id}} [{{$data->order_number}}]</strong></h5>
                                                       <p><strong>{{__('Order Date')}}</strong> {{$data->created_at->format('d-m-Y')}}</p>
                                                       </div>
                                                    </div>
                                                    <div class="col-lg-4 print-btn">
                                                        <div class="prinit">
                                                            <a href="{{asset('assets/front/invoices/product/' . $data->invoice_number)}}" download="invoice.pdf" id="print-click" class="btn btn-info"><i class="fas fa-print mr-1"></i>{{__('Download Invoice')}}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="billing-add-area">
                                            <div class="row">
                                                @if($data->shipping_name && $data->shipping_email && $data->shipping_number &&  $data->shipping_address)
                                                <div class="col-md-4">
                                                    <div class="main-info">
                                                        <h6><strong>{{__('Billing Details')}}</strong></h6>
                                                        <ul class="list">
                                                            <li><p><span>{{__('Email')}} : </span> {{$data->billing_email}}</p></li>
                                                            <li><p><span>{{__('Phone')}} : </span>{{$data->billing_number}}</p></li>
                                                            <li><p><span>{{__('City')}} : </span>{{$data->billing_city}}</p></li>
                                                            <li><p><span>{{__('Address')}} :</span>{{$data->billing_address}}</p></li>
                                                            <li><p><span>{{__('Country')}} :</span>{{$data->billing_country}}</p></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="main-info">
                                                        <h6><strong>{{__('Shipping Details')}}</strong></h6>
                                                        <ul class="list">
                                                            <li><p><span>{{__('Email')}}:</span>{{$data->shipping_email}}</p></li>
                                                            <li><p><span>{{__('Phone')}}:</span>{{$data->shipping_number}}</p></li>
                                                            <li><p><span>{{__('City')}}:</span>{{$data->shipping_city}}</p></li>
                                                            <li><p><span>{{__('Address')}}:</span>{{$data->shipping_address}}</p></li>
                                                            <li><p><span>{{__('Country')}}:</span>{{$data->shipping_country}}</p></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                @else 
                                                <div class="col-md-6">
                                                    <div class="main-info">
                                                        <h6><strong>{{__('Billing Details')}}</strong></h6>
                                                        <ul class="list">
                                                            <li><p><span>{{__('Email')}} :</span>{{$data->billing_email}}</p></li>
                                                            <li><p><span>{{__('Phone')}} : </span>{{$data->billing_number}}</p></li>
                                                            <li><p><span>{{__('City')}} : </span>{{$data->billing_city}}</p></li>
                                                            <li><p><span>{{__('Address')}} : </span>{{$data->billing_address}}</p></li>
                                                            <li><p><span>{{__('Country')}} : </span>{{$data->billing_country}}</p></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                @endif
    
                                                <div class="
                                                @if($data->shipping_name && $data->shipping_email && $data->shipping_number &&  $data->shipping_address)
                                                col-md-4 
                                                @else
                                                col-md-6
                                                @endif ">
                                                    <div class="payment-information">
                                                        <h6><strong>{{__('Payment Information : ')}}</strong> </h6>
                                                        <p>{{__('Payment Status')}} :
                                                            @if($data->payment_status =='Pending' || $data->payment_status == 'pending')
                                                            <span class="badge badge-danger">{{$data->payment_status}}  </span>
                                                            @else
                                                            <span class="badge badge-success">{{$data->payment_status}}  </span>
                                                            @endif
                                                        </p>
                                                        <p>{{__('Paid Amount')}} : <span class="amount">
    
                                                            {{ Helper::showCurrency() }}{{$data->total}}
    
                                                        </span></p>
    
                                                        <p>
                                                            {{__('Shipping Charge')}} :
                                                            
    
                                                            {{ Helper::showCurrency() }}{{$data->shipping_charge}}
    
                                                            
                                                        </p>
    
                                                        <p>{{__('Payment Method')}} : {{$data->method}}</p>
    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="table-responsive product-list">
                                            <h5 class="mb-3"><strong>{{ __('Ordered Products :') }}</strong></h5>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>{{__('Image')}}</th>
                                                        <th>{{__('Name')}}</th>
                                                        <th>{{__('Details')}}</th>
                                                        <th>{{__('Price')}}</th>
                                                        <th>{{__('Total')}}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($data->orderitems as $key => $order)
                                                    @php
                                                        $product = App\Product::findOrFail($order->product_id);
                                                    @endphp
                                                    <tr>
                                                        <td>{{$key+1}}</td>
                                                        <td><img src="{{asset('assets/front/img/'.$order->product->image)}}" alt="product" width="80"></td>
                                                        <td><a href="{{route('front.product.details',$product->slug)}}">{{$order->title}}</a></td>
                                                        <td>
                                                            <b>{{__('Quantity')}}:</b> <span>{{$order->qty}}</span><br>
                                                        </td>
                                                        <td>{{ Helper::showCurrency() }}{{$order->price}}</td>
                                                        <td>{{ Helper::showCurrency() }}{{$order->price * $order->qty}}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        </div>
                                        <div class="edit-account-info">
                                            <a href="{{ URL::previous() }}" class="mybtn1 mt-3"><i class="fas fa-angle-double-left"></i>{{__('Back')}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		  </div>
		</div>
	
	  </section>
    <!-- User Dashboard End -->

@endsection
