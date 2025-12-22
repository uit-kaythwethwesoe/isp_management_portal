@extends('admin.layout')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                @if (request()->path()=='admin/product/pending/orders')
                {{ __('Pending') }}
              @elseif (request()->path()=='admin/product/all/orders')
                {{ __('All') }}
              @elseif (request()->path()=='admin/product/processing/orders')
                {{ __('Processing') }}
              @elseif (request()->path()=='admin/product/completed/orders')
                {{ __('Completed') }}
              @elseif (request()->path()=='admin/product/rejected/orders')
                {{ __('Rejcted') }}
              @endif
              {{ __('Order') }}
            </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard', app()->getLocale()) }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">
                @if (request()->path()=='admin/product/pending/orders')
                {{ __('Pending') }}
              @elseif (request()->path()=='admin/product/all/orders')
                {{ __('All') }}
              @elseif (request()->path()=='admin/product/processing/orders')
                {{ __('Processing') }}
              @elseif (request()->path()=='admin/product/completed/orders')
                {{ __('Completed') }}
              @elseif (request()->path()=='admin/product/rejected/orders')
                {{ __('Rejcted') }}
              @endif
              {{ __('Order') }}
            </li>
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
                        <h3 class="card-title mt-1">
                            @if (request()->path()=='admin/product/pending/orders')
                            {{ __('Pending') }}
                          @elseif (request()->path()=='admin/product/all/orders')
                            {{ __('All') }}
                          @elseif (request()->path()=='admin/product/processing/orders')
                            {{ __('Processing') }}
                          @elseif (request()->path()=='admin/product/completed/orders')
                            {{ __('Completed') }}
                          @elseif (request()->path()=='admin/product/rejected/orders')
                            {{ __('Rejcted') }}
                          @endif
                          {{ __('Order List') }}
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <table class="table table-striped table-bordered data_table">
                        <thead>
                            <tr>
                                <th>{{ __('#') }}</th>
                                <th scope="col">{{ __('Order Number') }}</th>
                                <th scope="col" width="15%">{{ __('Gateway') }}</th>
                                <th scope="col">{{ __('Total') }}</th>
                                <th scope="col">{{ __('Order Status') }}</th>
                                <th scope="col">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $key => $order)
                            <tr>
                                <td>{{ $key }}</td>
                                <td>#{{$order->order_number}}</td>
                                <td>{{$order->method}}</td>
                                <td>{{  Helper::showCurrency() }}{{round($order->total,2)}}</td>
                                <td>
                                    <form id="statusForm{{$order->id}}" class="d-inline-block" action="{{route('admin.product.orders.status')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="order_id" value="{{$order->id}}">
                                        <select class="form-control form-control-sm
                                        @if ($order->order_status == 'pending')
                                          bg-warning
                                        @elseif ($order->order_status == 'processing')
                                          bg-primary
                                        @elseif ($order->order_status == 'completed')
                                          bg-success
                                        @elseif ($order->order_status == 'rejected')
                                          bg-danger
                                        @endif
                                        " name="order_status" onchange="document.getElementById('statusForm{{$order->id}}').submit();">
                                          <option value="pending" {{$order->order_status == 'pending' ? 'selected' : ''}}>Pending</option>
                                          <option value="processing" {{$order->order_status == 'processing' ? 'selected' : ''}}>Processing</option>
                                          <option value="completed" {{$order->order_status == 'completed' ? 'selected' : ''}}>Completed</option>
                                          <option value="rejected" {{$order->order_status == 'rejected' ? 'selected' : ''}}>Rejected</option>
                                        </select>
                                      </form>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          Actions
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                          <a class="dropdown-item" href="{{route('admin.product.details', $order->id)}}" target="_blank">Details</a>
                                          <a class="dropdown-item" href="{{asset('assets/front/invoices/product/'.$order->invoice_number)}}" target="_blank">Invoice</a>
                                          <form  id="deleteform" class="d-inline-block dropdown-item" action="{{ route('admin.product.order.delete') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                                            <button type="submit" id="delete">
                                                {{ __('Delete') }}
                                            </button>
                                        </form>
                                        </div>
                                    </div>
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



@endsection
