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
                    <h5 class="card-header">{{ __('Package Order') }}</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 mt-3">
                                @if($order)
                                <table class="table border table-striped">
                                    <tbody>
                                        <tr>
                                            <th scope="row">{{ __('Package Name') }}</th>
                                            <td>{{ $order->package->name }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">{{ __('Speed Limit') }}</th>
                                            <td>{{ $order->package->speed }} <span>{{ __('Mbps') }}</span></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">{{ __('Package Price') }}</th>
                                            <td>{{ $order->currency_sign }}{{ $order->package->price}} / {{ $order->package->time }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">{{ __('Package Feature') }}</th>
                                            <td>{{ $order->package->feature}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">{{ __('Payment Method') }}</th>
                                            <td>{{ $order->method}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">{{ __('Attendance Id') }}</th>
                                            <td>{{ $order->attendance_id}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">{{ __('Txn Id') }}</th>
                                            <td>{{ $order->txn_id}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">{{ __('Status') }}</th>
                                            <td>
                                                @if($order->status == 0)
                                                    <span class="badge badge-info">{{ __('Pending') }}</span>
                                                @elseif($order->status == 1)
                                                    <span class="badge badge-primary">{{ __('In Progress') }}</span>
                                                @elseif($order->status == 2)
                                                    <span class="badge badge-success">{{ __('Completed') }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                @else 
                                <h4>{{ __("You don't purchase any package. First buy a package.") }}</h4>
                                @endif
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
