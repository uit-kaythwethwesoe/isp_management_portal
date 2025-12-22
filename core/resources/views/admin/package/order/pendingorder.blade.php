@extends('admin.layout')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ __('Package Orders') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard', app()->getLocale()) }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('Package Orders') }}</li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title mt-1">{{ __('Pending Order List') }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <table class="table table-striped table-bordered data_table">
                        <thead>
                            <tr>
                                <th>{{ __('#') }}</th>
                                <th>{{ __('Package Name') }}</th>
                                <th>{{ __('User Name') }}</th>
                                <th>{{ __('Price') }}</th>
                                <th>{{ __('Payment Method') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($package_pendingorders as $id=>$order)
                            <tr>
                                <td>
                                    {{ $id }}
                                </td>
                                <td>
                                    {{ $order->package->name }}
                                </td>
                                <td>
                                    {{ $order->user->username }}
                                </td>
                                <td>
                                    {{ $order->currency_sign }} {{ $order->package_cost }}
                                </td>
                                <td>
                                    {{ $order->method }}
                                </td>
                                <td>
                                    @if($order->status == 0)
                                        <span class="badge badge-info">{{ __('Pending') }}</span>
                                    @elseif($order->status == 1)
                                        <span class="badge badge-primary">{{ __('In Progress') }}</span>
                                    @elseif($order->status == 2)
                                        <span class="badge badge-success">{{ __('Completed') }}</span>
                                    @endif
                                </td>
                                <td>
                                    <form  id="deleteform" class="d-inline-block" action="{{ route('admin.package.delete_order', $order->id ) }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $order->id }}">
                                        <button type="submit" class="btn btn-danger btn-sm" id="delete">
                                        <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    <a href="#" data-id="{{ $order->id }}" class="btn btn-primary btn-sm package_order_view" data-toggle="modal" data-target="#package_order_view"><i class="fas fa-eye mr-0"></i></a>
                                    @if($order->invoice_number)
                                    <a class="btn btn-warning btn-sm" href="{{asset('assets/front/invoices/package/'.$order->invoice_number)}}" target="_blank">Invoice</a>
                                    @endif
                                    <a href="#" data-id="{{ $order->id }}" class="btn btn-info btn-sm package_order_status"  data-toggle="modal" data-target="#package_order_status">{{ __('Update Status') }}</a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    </div>
                </div>
                <span class="text-danger">{{ __('If package orders are deleted then all bill pay information under this package will be deleted !!!') }}</span>
            </div>
        </div>
    </div>
    <!-- /.row -->
</section>
<!-- Package order view modal -->
<div class="modal fade" id="package_order_view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLaravel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">{{ __('Order Quick View') }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-lg-6">
                    <h6 class="mb-3"><strong>{{ __('Customar Info :') }}</strong></h6>
                    <table class="table border table-striped">
                        <tbody>
                            <tr>
                                <th scope="row">{{ __('Full Name') }}</th>
                                <td id="fname"></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Username') }}</th>
                                <td id="username"></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Email') }}</th>
                                <td id="email"></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Phone') }}</th>
                                <td id="phone"></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Address') }}</th>
                                <td id="address"></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Country') }}</th>
                                <td id="country"></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('City') }}</th>
                                <td id="city"></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Zip Code') }}</th>
                                <td id="zipcode"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-6">
                    <h6 class="mb-3"><strong>{{ __('Order Info :') }}</strong></h6>
                    <table class="table border table-striped">
                        <tbody>
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
                                <th scope="row">{{ __('Package Feature') }}</th>
                                <td id="packfeature"></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Payment Method') }}</th>
                                <td id="method"></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Attendance Id') }}</th>
                                <td id="attendance_id"></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Txn Id') }}</th>
                                <td id="txn_id"></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Status') }}</th>
                                <td id="status"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> 
      </div>
    </div>
</div>
<!-- package_order_status  modal -->
<div class="modal fade" id="package_order_status" tabindex="-1" role="dialog" aria-labelledby="exampleModalLaravel" aria-hidden="true">
    <div class="modal-dialog " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">{{ __('Update Order Status') }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" action="{{ route('admin.package.order_update_status') }}" method="POST">
                @csrf
                <input type="hidden" name="status_orderid" id="status_orderid" value="">
                <div class="form-group">
                    <div id="status-wrape">
                        <select class="form-control" name="status">
                        </select>
                    </div>
                    @if ($errors->has('status'))
                        <p class="text-danger"> {{ $errors->first('status') }} </p>
                    @endif
                </div>
                <div class="form-group">
                    <div class="">
                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                    </div>
                </div>
            
            </form>
        </div> 
      </div>
    </div>
</div>


@endsection
