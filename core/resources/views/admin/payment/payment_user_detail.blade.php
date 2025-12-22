@extends('admin.layout')
<script src="https://telco.mbt.com.mm/assets/admin/plugins/data-table/cdn/jquery.min.js"></script>
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ __('Payment Details') }} </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard',app()->getLocale()) }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.user_query',app()->getLocale()) }}">{{ __('Payment Details') }}</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <style>
     span {
         float:right;
     }
    </style>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title mt-1">{{ __('Payment Details') }}</h3>
                            <a href="{{route('admin.payment_query',app()->getLocale())}}" class="btn btn-success" style="float: right;"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;
                             Back</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                              <div class="col-md-6">
                                    <ul class="list-group">
                                      <li class="list-group-item">{{__('Register phone')}} <span class="badge">{{ $bind_users->phone }}</span></li>
                                      <li class="list-group-item">{{__('Register date')}} <span class="badge">{{date('Y-m-d H:i:s', $bind_users->user_create_time)}}</span></li>
                                      <li class="list-group-item">{{__('Name')}} <span class="badge">{{ !empty($users->name) ? $users->name : '-'}}</span></li>
                                      <li class="list-group-item">{{__('MBT Account ID')}} <span class="badge">{{ $bind_users->user_name }}</span></li>
                                      <li class="list-group-item">{{__('Install address')}} <span class="badge">{{ $bind_users->user_address }}</span></li>
                                      <li class="list-group-item">{{__('Sub-company')}} <span class="badge">{{App\SubCompany::find($bind_users->Sub_company)->company_name??''}}</span></li>
                                    </ul> 
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-group">
                                      <li class="list-group-item">{{__('Broadband Name')}} <span class="badge">{{$bind_users->user_real_name}}</span></li>
                                      <li class="list-group-item">{{__('Broadband Phone')}} <span class="badge">{{$bind_users->phone}}/{{$bind_users->Phone_number}}</span></li>
                                      <li class="list-group-item">{{__('Now Package')}} <span class="badge">{{ !empty($response['products_name']) ? $response['products_name'] : '-'}}</span></li>
                                      <li class="list-group-item">{{__('Monthly Cost')}} <span class="badge">{{ !empty($response['billing_name']) ? $response['billing_name'] : '-'}}</span></li>
                                      <li class="list-group-item">{{__('Expiry Date')}} <span class="badge">{{$bind_users->user_expire_time}}</span></li>
                                    </ul> 
                                </div>
                           </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
@endsection
	<script>
	$(document).ready(function(){
		$('.toggle').hide();
	  $(".collapsed").click(function(){
		 
		$(".toggle").slideToggle();
	  });
	});
	</script>

