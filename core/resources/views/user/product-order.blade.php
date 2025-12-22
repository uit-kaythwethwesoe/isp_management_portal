@extends('front.layout')

@section('meta-keywords', "$setting->meta_keywords")
@section('meta-description', "$setting->meta_description")
@section('style')
  <!-- DataTable css -->
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/data-table/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/data-table/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/data-table/buttons.bootstrap4.min.css') }}">
@endsection
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
                    <h5 class="card-header">{{ __('All Order') }}</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 mt-3 table-responsive">
                                <table  class="table table-bordered table-striped data_table" >
                                    <thead>
                                        <tr>
                                            <th>{{__('Order number')}}r</th>
                                            <th>{{__('Date')}}</th>
                                            <th>{{__('Total Price')}}</th>
                                            <th>{{__('Action')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($orders)
                                        @foreach ($orders as $order)
                                        <tr>
                                        <td>{{$order->order_number}}</td>
                                             <td>{{$order->created_at->format('d-m-Y')}}</td>
                                            <td>{{ Helper::showCurrency() }}{{$order->total}} </td>
                                            <td><a href="{{route('user.product.orderDetails',$order->id)}}" class="btn btn-info btn-sm">{{__('Details')}}</a></td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr class="text-center">
                                            <td colspan="4">
                                                {{__('No Orders')}}
                                            </td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
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

@section('script')
<!-- DataTable js -->
<script src="{{ asset('assets/admin/plugins/data-table/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/data-table/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/data-table/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/data-table/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/data-table/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/data-table/buttons.bootstrap4.min.js') }}"></script>

<script>
    //  Datatable js
    $(".data_table").DataTable();
</script>

@endsection
