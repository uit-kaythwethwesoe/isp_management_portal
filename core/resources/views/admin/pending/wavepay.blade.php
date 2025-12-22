@extends('admin.layout')

@section('content')

<style>
    #loading_spinner { 
        display:none; 
    }
    
    #loading_spinner img{
        width: 100px;
    }
</style>

<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{ __('Wave Pay') }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard',app()->getLocale()) }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
                    <li class="breadcrumb-item">{{ __('Wave Pay') }}</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

@if(Session::has('message'))
    <div class="alert alert-success alert-dismissible text-center" style="width: 97%;">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Success!</strong> {{Session::get('message')}}
    </div>
@endif

<section class="content">
    <div class="container-fluid">
        <a href="{{ route('admin.update.wavepay',app()->getLocale()) }}" id="wavepay" style="color:#fff;" class="btn btn-success waves-effect waves-light collapsed mb-2">{{ __('Get Payment Status') }}</a>
        <div class="row">
            <div class="col-lg-12 text-center" id='loading_spinner'>
                <img src="{{ asset('assets/loading.gif') }}" style="margin-top: 100px;">
                <p>Processing Please Wait!</p>
            </div>
            
            <div class="col-lg-12" id='hiding_spinner'>
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title mt-1">{{ __('Pending Payments') }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-striped table-bordered data_table">
                            <thead>
                                <tr>
                                    <th>{{ __('#') }}</th>
                                    <th>{{ __('Username') }}</th>
                                    <th>{{ __('Order Id') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                    <th>{{ __('Created At') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($payments as $index=>$payment)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$payment->user_name}}</td>
                                        <td>{{$payment->order_no}}</td>
                                        <td>{{$payment->amount}}</td>
                                        <td>{{$payment->created_at}}</td>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<script>
    $(function() {
        $("#wavepay").click(function() {
            $('#loading_spinner').show();
            $('#hiding_spinner').hide();
        });
    });
</script>
@endsection