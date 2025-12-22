@extends('admin.layout')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">
              {{ __('Order Details') }}
            </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard', app()->getLocale()) }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">
              {{ __('Order Details') }}
            </li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="
            @if($order->shipping_name && $order->shipping_email && $order->shipping_number &&  $order->shipping_address)
                col-md-4
                @else
                col-md-6 
            @endif
            ">
                <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title mt-1">{{ __('Order') }}  [ {{ $order->order_number}} ]</h3>
                        </div>

                        <div class="card-body">
                            <table class="table  table-bordered">
                                <tr>
                                    <th>{{__('Payment Status')}} :</th>
                                    <td>
                                        @if($order->payment_status =='Pending' || $order->payment_status == 'pending')
                                        <span class="badge badge-danger">{{Helper::convertUtf8($order->payment_status)}}  </span>
                                        @else
                                        <span class="badge badge-success">{{Helper::convertUtf8($order->payment_status)}}  </span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{__('Order Status')}} :</th>
                                    <td>
                                        @if ($order->order_status == 'pending')
                                        <span class="badge badge-warning">{{Helper::convertUtf8($order->order_status)}}  </span>
                                        @elseif ($order->order_status == 'processing')
                                        <span class="badge badge-primary">{{Helper::convertUtf8($order->order_status)}}  </span>
                                        @elseif ($order->order_status == 'completed')
                                        <span class="badge badge-success">{{Helper::convertUtf8($order->order_status)}}  </span>
                                        @elseif ($order->order_status == 'rejected')
                                        <span class="badge badge-danger">{{Helper::convertUtf8($order->order_status)}}  </span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{__('Paid amount')}} :</th>
                                    <td>{{  Helper::showCurrency() }}{{$order->total}}</td>
                                </tr>
                                <tr>
                                    <th>{{__('Shipping Charge')}} :</th>
                                    <td>{{  Helper::showCurrency() }}{{$order->shipping_charge}}</td>
                                </tr>
                                <tr>
                                    <th>{{__('Payment Method')}} :</th>
                                    <td>{{Helper::convertUtf8($order->method)}}</td>
                                </tr>
                                <tr>
                                    <th>{{__('Order Date')}} :</th>
                                    <td>{{Helper::convertUtf8($order->created_at->format('d-m-Y'))}}</td>
                                </tr>
                            </table>
                    </div>
                </div>
            </div>
            @if($order->shipping_name && $order->shipping_email && $order->shipping_number &&  $order->shipping_address)
            <div class="col-md-4">
                <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title mt-1">{{ __('Billing Details') }}</h3>
                        </div>

                        <div class="card-body">
                            <table class="table  table-bordered">
                                <tr>
                                    <th>{{__('Email')}} :</th>
                                    <td>{{Helper::convertUtf8($order->billing_email)}}</td>
                                </tr>
                                <tr>
                                    <th>{{__('Phone')}} :</th>
                                    <td> {{$order->billing_number}}</td>
                                </tr>
                                <tr>
                                    <th>{{__('City')}} :</th>
                                    <td>{{Helper::convertUtf8($order->billing_city)}}</td>
                                </tr>
                                <tr>
                                    <th>{{__('Address')}} :</th>
                                    <td>{{Helper::convertUtf8($order->billing_address)}}</td>
                                </tr>
                                <tr>
                                    <th>{{__('Country')}} :</th>
                                    <td>{{Helper::convertUtf8($order->billing_country)}}</td>
                                </tr>
                                <tr>
                                    <th>{{__('Zip Code')}} :</th>
                                    <td>{{Helper::convertUtf8($order->billing_zip)}}</td>
                                </tr>
                            </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title mt-1">{{ __('Shipping Details') }}</h3>
                        </div>

                        <div class="card-body">
                            <table class="table  table-bordered">
                                <tr>
                                    <th>{{__('Email')}} :</th>
                                    <td>{{Helper::convertUtf8($order->shipping_email)}}</td>
                                </tr>
                                <tr>
                                    <th>{{__('Phone')}} :</th>
                                    <td> {{$order->shipping_number}}</td>
                                </tr>
                                <tr>
                                    <th>{{__('City')}} :</th>
                                    <td>{{Helper::convertUtf8($order->shipping_city)}}</td>
                                </tr>
                                <tr>
                                    <th>{{__('Address')}} :</th>
                                    <td>{{Helper::convertUtf8($order->shipping_address)}}</td>
                                </tr>
                                <tr>
                                    <th>{{__('Country')}} :</th>
                                    <td>{{Helper::convertUtf8($order->shipping_country)}}</td>
                                </tr>
                                <tr>
                                    <th>{{__('Zip Code')}} :</th>
                                    <td>{{Helper::convertUtf8($order->shipping_zip)}}</td>
                                </tr>
                            </table>
                    </div>
                </div>
            </div>
            @else 
                <div class="col-md-6">
                    <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title mt-1">{{ __('Billing Details') }}</h3>
                            </div>

                            <div class="card-body">
                                <table class="table  table-bordered">
                                    <tr>
                                        <th>{{__('Email')}} :</th>
                                        <td>{{Helper::convertUtf8($order->billing_email)}}</td>
                                    </tr>
                                    <tr>
                                        <th>{{__('Phone')}} :</th>
                                        <td> {{$order->billing_number}}</td>
                                    </tr>
                                    <tr>
                                        <th>{{__('City')}} :</th>
                                        <td>{{Helper::convertUtf8($order->billing_city)}}</td>
                                    </tr>
                                    <tr>
                                        <th>{{__('Address')}} :</th>
                                        <td>{{Helper::convertUtf8($order->billing_address)}}</td>
                                    </tr>
                                    <tr>
                                        <th>{{__('Country')}} :</th>
                                        <td>{{Helper::convertUtf8($order->billing_country)}}</td>
                                    </tr>
                                    <tr>
                                        <th>{{__('Zip Code')}} :</th>
                                        <td>{{Helper::convertUtf8($order->billing_zip)}}</td>
                                    </tr>
                                </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title mt-1">{{ __('Order Product') }}</h3>
                        </div>

                        <div class="card-body">
                            <table class="table  table-bordered table-striped data_table">
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
                                    @foreach ($order->orderitems as $key => $item)
                                    <tr>
                                       <td>{{$key+1}}</td>
                                       <td><img class="w-80" src="{{asset('assets/front/img/'.$item->image)}}" alt="product" ></td>
                                       <td>{{Helper::convertUtf8($item->title)}}</td>
                                       <td>
                                          <b>{{__('Quantity')}}:</b> <span>{{$item->qty}}</span><br>
                                       </td>
                                       <td>{{  Helper::showCurrency() }}{{$item->price}}</td>
                                       <td>{{  Helper::showCurrency() }}{{$item->price * $item->qty}}</td>
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



@endsection
