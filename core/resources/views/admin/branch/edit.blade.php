@extends('admin.layout')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ __('Branches') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard', app()->getLocale()) }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
                <li class="breadcrumb-item">{{ __('Branches') }}</li>
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
                                <h3 class="card-title mt-1">{{ __('Edit Branch') }}</h3>
                                <div class="card-tools">
                                    <a href="{{ route('admin.branch'). '?language=' . $currentLang->code }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-angle-double-left"></i> {{ __('Back') }}
                                    </a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form class="form-horizontal" action="{{ route('admin.branch.update',  $branch->id) }}" method="POST">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-sm-2 control-label">{{ __('Language') }}<span class="text-danger">*</span></label>
        
                                        <div class="col-sm-10">
                                            <select class="form-control lang" name="language_id">
                                                @foreach($langs as $lang)
                                                    <option value="{{$lang->id}}" {{ $branch->language_id == $lang->id ? 'selected' : '' }} >{{$lang->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('language_id'))
                                                <p class="text-danger"> {{ $errors->first('language_id') }} </p>
                                            @endif
                                        </div>
                                    </div>
                                     <div class="form-group row">
                                        <label class="col-sm-2 control-label">{{ __('Map Embed Code') }}<span class="text-danger">*</span>
                                        </label>
        
                                        <div class="col-sm-10">
                                            <textarea name="iframe" class="form-control"  rows="3" placeholder="{{ __('Map Embed Code') }}">{{ $branch->iframe }}</textarea>
                                            @if ($errors->has('iframe'))
                                                <p class="text-danger"> {{ $errors->first('iframe') }} </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 control-label">{{ __('Branch Name') }}<span class="text-danger">*</span></label>
                                        <div class="col-sm-10">
                                            <input type="text" name="branch_name" class="form-control" placeholder="{{ __('Branch Name') }}" value="{{ $branch->branch_name }}">
                                            @if ($errors->has('branch_name'))
                                                <p class="text-danger"> {{ $errors->first('branch_name') }} </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 control-label">{{ __('Manager') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="manager" class="form-control" placeholder="{{ __('Manager') }}" value="{{ $branch->manager }}">
                                            @if ($errors->has('manager'))
                                                <p class="text-danger"> {{ $errors->first('manager') }} </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label  class="col-sm-2 control-label">{{ __('Phone Number') }}<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" data-role="tagsinput" name="phone" placeholder="{{ __('Number') }}" value="{{ $branch->phone }}">
                                            @if ($errors->has('phone'))
                                                <p class="text-danger"> {{ $errors->first('phone') }} </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label  class="col-sm-2 control-label">{{ __('Email') }}<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" data-role="tagsinput" name="email" placeholder="{{ __('Email') }}" value="{{ $branch->email }}">
                                            @if ($errors->has('email'))
                                                <p class="text-danger"> {{ $errors->first('email') }} </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 control-label">{{ __('Address') }}<span class="text-danger">*</span></label>
                                        <div class="col-sm-10">
                                            <input type="text" name="address" class="form-control" placeholder="{{ __('Address') }}" value="{{ $branch->address }}">
                                            @if ($errors->has('address'))
                                                <p class="text-danger"> {{ $errors->first('address') }} </p>
                                            @endif
                                        </div>
                                    </div>
                                        
                                    <div class="form-group row">
                                        <label for="status" class="col-sm-2 control-label">{{ __('Status') }}<span class="text-danger">*</span></label>
        
                                        <div class="col-sm-10">
                                            <select class="form-control" name="status">
                                               <option value="0" {{ $branch->status == '0' ? 'selected' : '' }}>{{ __('Unpublish') }}</option>
                                               <option value="1" {{ $branch->status == '1' ? 'selected' : '' }}>{{ __('Publish') }}</option>
                                              </select>
                                            @if ($errors->has('status'))
                                                <p class="text-danger"> {{ $errors->first('status') }} </p>
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
