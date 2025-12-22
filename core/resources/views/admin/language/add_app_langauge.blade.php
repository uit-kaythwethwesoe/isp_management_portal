
@extends('admin.layout')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{ __('Languages') }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard',app()->getLocale()) }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
                <li class="breadcrumb-item">{{ __('Languages') }}</li>
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
                            <h3 class="card-title mt-1">{{ __('Add Language') }}</h3>
                            <div class="card-tools">
                                <a href="{{ route('admin.language.index',app()->getLocale()) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-angle-double-left"></i> {{ __('Back') }}
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <form  action="{{route('admin.language.store',app()->getLocale())}}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label for="title" class="col-sm-2 control-label">{{ __('String') }}<span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="string" required placeholder="{{ __('Enter Sting') }}" value="{{ old('name') }}">
                                        @if ($errors->has('name'))
                                            <p class="text-danger"> {{ $errors->first('name') }} </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="title" class="col-sm-2 control-label">{{ __('English') }}<span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="english" required placeholder="{{ __('Enter Label in English') }}" value="{{ old('code') }}">
                                        @if ($errors->has('code'))
                                            <p class="text-danger"> {{ $errors->first('code') }} </p>
                                        @endif
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label for="title" class="col-sm-2 control-label">{{ __('Burmese') }}<span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="burmese" required placeholder="{{ __('Enter Label in burmese') }}" value="{{ old('code') }}">
                                        @if ($errors->has('code'))
                                            <p class="text-danger"> {{ $errors->first('code') }} </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="title" class="col-sm-2 control-label">{{ __('Chinese') }}<span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="chinese" required placeholder="{{ __('Enter Label in chinese') }}" value="{{ old('code') }}">
                                        @if ($errors->has('code'))
                                            <p class="text-danger"> {{ $errors->first('code') }} </p>
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
        <!-- /.row -->

    </section>
@endsection
