
@extends('admin.layout')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{ __('Update Languages') }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard',app()->getLocale()) }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
                <li class="breadcrumb-item">{{ __('Update Languages') }}</li>
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
                            <h3 class="card-title mt-1">{{ __('Update Languages') }}</h3>
                            <div class="card-tools">
                                <a href="{{ route('admin.language.index',app()->getLocale()) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-angle-double-left"></i> {{ __('Back') }}
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <form  action="{{route('admin.language.store.app',app()->getLocale())}}" method="POST">
                               @csrf
                               <input type="hidden" name="lang_id" value="{{$language->lang_id}}">
                                <div class="form-group row">
                                    <!--<label for="title" class="col-sm-2 control-label">{{ __('String') }}<span class="text-danger">*</span></label>-->
                                    <div class="col-sm-10">
                                        <input type="hidden" class="form-control" name="string" required placeholder="{{ __('Enter Sting') }}" value="{{ $language->lang_string }}">
                                        @if ($errors->has('name'))
                                            <p class="text-danger"> {{ $errors->first('name') }} </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="title" class="col-sm-2 control-label">{{ __('English') }}<span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="english" required placeholder="{{ __('Enter Label in English') }}" value="{{ $language->lang_english }}">
                                        @if ($errors->has('code'))
                                            <p class="text-danger"> {{ $errors->first('code') }} </p>
                                        @endif
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label for="title" class="col-sm-2 control-label">{{ __('Burmese') }}<span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="burmese" required placeholder="{{ __('Enter Label in burmese') }}" value="{{ $language->lang_burmese }}">
                                        @if ($errors->has('code'))
                                            <p class="text-danger"> {{ $errors->first('code') }} </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="title" class="col-sm-2 control-label">{{ __('Chinese') }}<span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="chinese" required placeholder="{{ __('Enter Label in chinese') }}" value="{{ $language->lang_chinese }}">
                                        @if ($errors->has('code'))
                                            <p class="text-danger"> {{ $errors->first('code') }} </p>
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
        <!-- /.row -->

    </section>
@endsection
