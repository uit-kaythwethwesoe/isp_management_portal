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
			<div class="col-lg-3 ">
				@includeif('user.dashboard-sidenav')
			</div>
			<div class="col-lg-9">
                <div class="card">
                    <h5 class="card-header">{{ __('Bill Pay') }}</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 mt-3 table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>{{ __('#') }}</th>
                                            <th>{{ __('Package Name') }}</th>
                                            <th>{{ __('Price') }}</th>
                                            <th>{{ __('Method') }}</th>
                                            <th>{{ __('Bill Paid') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
            
                                        @foreach ($bills as $id=>$bill)
                                        <tr>
                                            <td>{{ $id }}</td>
                                            <td>
                                                {{ $bill->package->name }}
                                            </td>
                                            <td>
                                                <strong>{{ $bill->currency_sign }}{{ $bill->package_cost }}</strong> / {{ $bill->package->time }}
                                            </td>
                                            <td>
                                                {{ $bill->method }}
                                            </td>
                                            <td>
                                                {{ $bill->fulldate }}
                                            </td>
                                            <td>
                                                <a href="#" data-id="{{ $bill->id }}" class="btn btn-primary btn-sm billpay_view" data-toggle="modal" data-target="#billpay_view"><i class="fas fa-eye mr-0"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
            
                                    </tbody>
                                </table>
                                </div>
                                <!-- /.card-body -->
                                <div class="mt-3 text-center d-block">
                                     {{ $bills->links() }}
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
<!-- Billpay view modal -->
<div class="modal fade" id="billpay_view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLaravel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">{{ __('Billpay Info :') }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-lg-12">
                    <table class="table border table-striped">
                        <tbody>
                            <tr>
                                <th scope="row">{{ __('Billpay Date') }}</th>
                                <td id="paydate"></td>
                            </tr>
                            
                            <tr>
                                <th scope="row">{{ __('Payment Method') }}</th>
                                <td id="method"></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Package Name') }}</th>
                                <td id="packname"></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Speed Limit') }}</th>
                                <td><span id="packspeed"></span> <span>{{ __('Mbps') }}</span></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Package Price') }}</th>
                                <td><span id="currency_sign"></span> <span id="packprice"></span> / <span id="packtime"></span></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Attendance Id') }}</th>
                                <td id="attendance_id"></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Txn Id') }}</th>
                                <td id="txn_id"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> 
      </div>
    </div>
</div>
@endsection
