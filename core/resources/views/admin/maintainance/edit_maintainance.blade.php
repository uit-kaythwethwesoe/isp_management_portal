@extends('admin.layout')
@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ __('Maintenance') }} </h1>
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
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title mt-1">{{ __('Edit Maintenance') }}</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.maintainance.setting',app()->getLocale()) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-angle-double-left"></i> {{ __('Back') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="{{route('admin.update.maintainance.setting', [app()->getLocale(),$settings->id])}}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-2 control-label">{{ __('Subject') }}<span class="text-danger">*</span></label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="subject" placeholder="{{ __('Subject') }}" value="{{ $settings->subject }}">
                                    @if ($errors->has('subject'))
                                        <p class="text-danger"> {{ $errors->first('subject') }} </p>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-sm-2 control-label">{{ __('Date') }}<span class="text-danger">*</span></label>

                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="date" placeholder="{{ __('Date') }}" value="{{ $settings->date }}">
                                    @if ($errors->has('date'))
                                        <p class="text-danger"> {{ $errors->first('date') }} </p>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-sm-2 control-label">{{ __('From Time') }}<span class="text-danger">*</span></label>

                                <div class="col-sm-10">
                                    <input type="time" class="form-control" name="from_time" placeholder="{{ __('From Time') }}" value="{{ $settings->from_time }}">
                                    @if ($errors->has('from_time'))
                                        <p class="text-danger"> {{ $errors->first('from_time') }} </p>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-sm-2 control-label">{{ __('To Time') }}<span class="text-danger">*</span></label>

                                <div class="col-sm-10">
                                    <input type="time" class="form-control" name="to_time" placeholder="{{ __('To Time') }}" value="{{ $settings->to_time }}">
                                    @if ($errors->has('to_time'))
                                        <p class="text-danger"> {{ $errors->first('to_time') }} </p>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-sm-2 control-label">{{ __('Message') }}<span class="text-danger">*</span></label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="message" placeholder="{{ __('Message') }}" value="{{ $settings->message }}">
                                    @if ($errors->has('message'))
                                        <p class="text-danger"> {{ $errors->first('message') }} </p>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
