@extends('admin.layout')
@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ __('Maintenance Settings') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard',app()->getLocale()) }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('Maintenance') }}</li>
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
                        <h3 class="card-title mt-1">{{ __('Maintenance Settings List') }}</h3>
                        <div class="card-tools d-flex">
                            <a href="{{ route('admin.add.maintainance.setting',app()->getLocale()) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> {{ __('Add') }}
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <table class="table table-striped table-bordered data_table">
                        <thead>
                            <tr>
                                <th>{{__('#')}}</th>
                                <th>{{__('Subject')}}</th>
                                <th>{{__('Date')}}</th>
                                <th>{{__('Time')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Created')}}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($settings as $k=>$val)
                                <tr>
                                    <td>{{++$k}}.</td>
                                    <td>{{$val->subject}}</td>
                                    <td>{{$val->date}}</td>
                                    <td>{{date("h:i:A", strtotime($val->from_time))}} - {{date("h:i:A", strtotime($val->to_time))}}</td>
                                    <td>
                                        @if($val->status==0)
                                        <span class="badge badge-pill badge-danger">{{__('Inactive')}}</span>
                                        @elseif($val->status==1)
                                        <span class="badge badge-pill badge-info">{{__('Active')}}</span>
                                        @endif
                                    </td>
                                    <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>
                                    <td>
                                        <a href="{{route('admin.edit.maintainance.setting',[app()->getLocale(),$val->id])}}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i>{{ __('Edit') }}</a>
                                        <a data-toggle="modal" data-target="#delete{{$val->id}}" href="" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>{{__('Delete')}}</a>
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
    
    @foreach($settings as $k=>$val)
        <div class="modal fade" id="delete{{$val->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card bg-white border-0 mb-0">
                            <div class="card-header">
                                <h3 class="mb-0">{{__('Are you sure you want to delete this?')}}</h3>
                            </div>
                            <div class="card-body px-lg-5 py-lg-5 text-right">
                                <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal">{{__('Close')}}</button>
                                <a href="{{route('admin.delete.maintainance.setting', [app()->getLocale(),$val->id])}}" class="btn btn-danger btn-sm">{{__('Proceed')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    
    <!-- /.row -->
</section>
@endsection
