@extends('admin.layout')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ __('Contact Info') }}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard', app()->getLocale()) }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('Contact Info') }}</li>
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
                        <h3 class="card-title mt-1">{{ __('Contact Information') }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('admin.contact_info_update', app()->getLocale()) }}" method="POST">
                            @csrf
                            
                            <div class="form-group row">
                                <label class="col-sm-2 control-label">{{ __('Phone Number') }}<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="number" placeholder="{{ __('Phone Number') }}" value="{{ $setting->number ?? '' }}">
                                    @if ($errors->has('number'))
                                        <p class="text-danger"> {{ $errors->first('number') }} </p>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-sm-2 control-label">{{ __('Email') }}<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="email" placeholder="{{ __('Email') }}" value="{{ $setting->email ?? '' }}">
                                    @if ($errors->has('email'))
                                        <p class="text-danger"> {{ $errors->first('email') }} </p>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-sm-2 control-label">{{ __('Contact Email') }}<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="contactemail" placeholder="{{ __('Contact Email') }}" value="{{ $setting->contactemail ?? '' }}">
                                    @if ($errors->has('contactemail'))
                                        <p class="text-danger"> {{ $errors->first('contactemail') }} </p>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-sm-2 control-label">{{ __('Address') }}<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="address" rows="4" placeholder="{{ __('Address') }}">{{ $setting->address ?? '' }}</textarea>
                                    @if ($errors->has('address'))
                                        <p class="text-danger"> {{ $errors->first('address') }} </p>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                </div>
                            </div>
                        
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
