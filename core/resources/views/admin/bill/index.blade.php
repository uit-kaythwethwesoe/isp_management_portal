@extends('admin.layout')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ __('Bill pay') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard', app()->getLocale()) }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('Bill pay') }}</li>
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
                        <h3 class="card-title mt-1">{{ __('Bill pay List') }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <table class="table table-striped table-bordered data_table">
                        <thead>
                            <tr>
                                <th>{{ __('#') }}</th>
                                <!--<th>{{ __('Package Name') }}</th>-->
                                <th>{{ __('User Name') }}</th>
                                <th>{{ __('User Account ID') }}</th>
                                <th>{{ __('Sub Company') }}</th>
                                <th>{{ __('Expiry date') }}</th>
                                <th>{{ __('Payment Date') }}</th>
                                <th>{{ __('Payment Amount') }}</th>
                                <th>{{ __('Invoice Number') }}</th>
                                <th>{{ __('Payment Method') }}</th>
                                <!--<th>{{ __('Package Duration') }}</th>-->
                                <!--<th>{{ __('Bill Paid') }}</th>-->
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($bills as $id=>$bill)
                            <tr>
                                <td>
                                    {{ $id }}
                                </td>
                                <!--<td>-->
                                <!--    {{ $bill->package->name }}-->
                                <!--</td>-->
                                <td>
                                    {{ $bill->user->username }}
                                </td>
                                
                                <td>
                                    {{ $bill->user->account_id }}
                                </td>
                                
                                <td>
                                    {{ $bill->user->sub_company }}
                                </td>
                                
                                <td>
                                    {{ $bill->user->expiry_date }}
                                </td>
                                
                                <td>
                                    {{ $bill->fulldate }}
                                </td>
                                <td>
                                    {{ $bill->currency_sign }}{{ $bill->package_cost }}
                                </td>
                                
                                <td>
                                    {{ $bill->user->invoice_number }}
                                </td>
                                <td>
                                    {{ $bill->method }}
                                </td>
                                <!--<td>-->
                                <!--    {{ $bill->package->time }}-->
                                <!--</td>-->
                                
                                <td>
                                    <form  id="deleteform" class="d-inline-block" action="{{ route('admin.billpay_delete', ['locale' => app()->getLocale(), 'id' => $bill->id]) }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $bill->id }}">
                                        <button type="submit" class="btn btn-danger btn-sm" id="delete">
                                        <i class="fas fa-trash"></i>
                                        </button>
                                    </form> @if($bill->invoice_number)
                                    <a class="btn btn-warning btn-sm" href="{{asset('assets/front/invoices/bill/'.$bill->invoice_number)}}" target="_blank">Invoice</a>
                                    @endif
                                    <a href="#" data-id="{{ $bill->id }}" class="btn btn-primary btn-sm billpay_view" data-toggle="modal" data-target="#billpay_view"><i class="fas fa-eye mr-0"></i></a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</section>
<!-- Billpay view modal -->
<div class="modal fade" id="billpay_view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLaravel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">{{ __('Bill Quick View') }}</h5>
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
                                <td id="name"></td>
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
                    <h6 class="mb-3"><strong>{{ __('Billpay Info :') }}</strong></h6>
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
