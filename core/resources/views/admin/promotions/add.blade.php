@extends('admin.layout')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ __('Promotions') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard',app()->getLocale()) }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('Promotions') }}</li>
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
                        <h3 class="card-title mt-1">{{ __('Add Promotion') }}</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.promotion',app()->getLocale()) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-angle-double-left"></i> {{ __('Back') }}
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('admin.promotion.store',app()->getLocale()) }}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-2 control-label">{{ __('Title') }}<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="title" placeholder="{{ __('Title') }}" value="{{ old('title') }}">
                                    @if ($errors->has('title'))
                                        <p class="text-danger"> {{ $errors->first('title') }} </p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 control-label">{{ __('English Description') }}<span class="text-danger">*</span></label>

                                <div class="col-sm-10">
                                    <textarea name="description" class="form-control"  rows="3" placeholder="{{ __('English Description') }}">{{ old('description') }}</textarea>
                                    @if ($errors->has('content'))
                                        <p class="text-danger"> {{ $errors->first('description') }} </p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 control-label">{{ __('Chinese Description') }}<span class="text-danger">*</span></label>

                                <div class="col-sm-10">
                                    <textarea name="chinese" class="form-control"  rows="3" placeholder="{{ __('Chinese Description') }}">{{ old('chinese') }}</textarea>
                                    @if ($errors->has('chinese'))
                                        <p class="text-danger"> {{ $errors->first('chinese') }} </p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 control-label">{{ __('Myanmar Description') }}<span class="text-danger">*</span></label>

                                <div class="col-sm-10">
                                    <textarea name="myanmar" class="form-control"  rows="3" placeholder="{{ __('Myanmar Description') }}">{{ old('myanmar') }}</textarea>
                                    @if ($errors->has('myanmar'))
                                        <p class="text-danger"> {{ $errors->first('myanmar') }} </p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="promotion_type" class="col-sm-2 control-label">{{ __('Promotion Type') }}<span class="text-danger">*</span></label>

                                <div class="col-sm-10">
                                    <select class="form-control" name="promotion_type">
                                       <option value="0">{{ __('Normal') }}</option>
                                       <option value="1">{{ __('Group 17') }}</option>
                                      </select>
                                    @if ($errors->has('promotion_type'))
                                        <p class="text-danger"> {{ $errors->first('promotion_type') }} </p>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-sm-2 control-label">{{ __('Duration(In Months)') }}<span class="text-danger">*</span></label>

                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="duration" placeholder="{{ __('Duration') }}">
                                    @if ($errors->has('duration'))
                                        <p class="text-danger"> {{ $errors->first('duration') }} </p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 control-label">{{ __('Extra Month') }}<span class="text-danger">*</span></label>

                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="extra_month" placeholder="{{ __('Extra Month') }}">
                                    @if ($errors->has('extra_month'))
                                        <p class="text-danger"> {{ $errors->first('extra_month') }} </p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 control-label">{{ __('Extra Days') }}<span class="text-danger">*</span></label>

                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="extra_days" placeholder="{{ __('Extra Days') }}">
                                    @if ($errors->has('extra_days'))
                                        <p class="text-danger"> {{ $errors->first('extra_days') }} </p>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="status" class="col-sm-2 control-label">{{ __('Status') }}<span class="text-danger">*</span></label>

                                <div class="col-sm-10">
                                    <select class="form-control" name="status">
                                       <option value="0">{{ __('Unpublish') }}</option>
                                       <option value="1">{{ __('Publish') }}</option>
                                      </select>
                                    @if ($errors->has('status'))
                                        <p class="text-danger"> {{ $errors->first('status') }} </p>
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
