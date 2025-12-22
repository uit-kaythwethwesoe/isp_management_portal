@extends('admin.layout')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ __('Edit Email Template') }}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard', app()->getLocale()) }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.mail.index', app()->getLocale()) }}">{{ __('Email Templates') }}</a></li>
            <li class="breadcrumb-item">{{ __('Edit') }}</li>
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
                        <h3 class="card-title mt-1">{{ __('Edit Template') }}: {{ $template->email_type }}</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.mail.index', app()->getLocale()) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-angle-double-left"></i> {{ __('Back') }}
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('admin.mail.update', ['locale' => app()->getLocale(), 'id' => $template->id]) }}" method="POST">
                            @csrf
                            
                            <div class="form-group row">
                                <label class="col-sm-2 control-label">{{ __('Email Type') }}</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="{{ $template->email_type }}" readonly disabled>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-sm-2 control-label">{{ __('Email Subject') }}<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="email_subject" placeholder="{{ __('Email Subject') }}" value="{{ $template->email_subject }}">
                                    @if ($errors->has('email_subject'))
                                        <p class="text-danger"> {{ $errors->first('email_subject') }} </p>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-sm-2 control-label">{{ __('Email Body') }}<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <textarea class="form-control summernote" name="email_body" rows="10">{{ $template->email_body }}</textarea>
                                    @if ($errors->has('email_body'))
                                        <p class="text-danger"> {{ $errors->first('email_body') }} </p>
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
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
