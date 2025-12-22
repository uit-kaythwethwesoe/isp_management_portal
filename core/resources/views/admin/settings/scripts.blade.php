@extends('admin.layout')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{ __('Scripts') }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard', app()->getLocale()) }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
                    <li class="breadcrumb-item">{{ __('Scripts') }}</li>
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
                        <h3 class="card-title">{{ __('Update Scripts') }} </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('admin.commonsetting.updateScripts', app()->getLocale()) }}" method="POST">
                            @csrf

                            <div class="form-group row">
                                <label class="col-sm-2 control-label">Tawk.to Status <span
                                            class="text-danger">*</span></label>

                                <div class="col-sm-10">
                                    <input type="checkbox" {{ $commonsetting->is_tawk_to == '1' ? 'checked' : '' }} data-size="large" name="is_tawk_to" data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on-text="Active" data-label-text="<i class='fas fa-mouse'></i>"  data-off-text="Deactive">
                                    @if ($errors->has('is_tawk_to'))
                                        <p class="text-danger"> {{ $errors->first('is_tawk_to') }} </p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 control-label">Tawk.to Widget Code<span
                                    class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <textarea type="text" class="form-control" name="tawk_to" rows="5">{!! $commonsetting->tawk_to !!}</textarea>
                                    @if ($errors->has('tawk_to'))
                                        <p class="text-danger"> {{ $errors->first('tawk_to') }} </p>
                                    @endif
                                </div>
                            </div>

                            {{-- <div class="form-group row mt-5">
                                <label class="col-sm-2 control-label">Messenger Status <span
                                            class="text-danger">*</span></label>

                                <div class="col-sm-10">
                                    <input type="checkbox" {{ $commonsetting->is_massenger == '1' ? 'checked' : '' }} data-size="large" name="is_massenger" data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on-text="Active" data-label-text="<i class='fas fa-mouse'></i>"  data-off-text="Deactive">
                                    @if ($errors->has('is_massenger'))
                                        <p class="text-danger"> {{ $errors->first('is_massenger') }} </p>
                                    @endif
                                </div>
                            </div> --}}
                            {{-- <div class="form-group row">
                                <label class="col-sm-2 control-label">FB Page ID<span
                                    class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="is_massenger_id" value="{{$commonsetting->is_massenger_id}}" placeholder="Facebook Page ID">
                                    @if ($errors->has('is_massenger_id'))
                                        <p class="text-danger"> {{ $errors->first('is_massenger_id') }} </p>
                                    @endif
                                </div>
                            </div> --}}

                            <div class="form-group row mt-5">
                                <label class="col-sm-2 control-label">{{ __('Disqus Status') }}<span
                                        class="text-danger">*</span></label>

                                <div class="col-sm-10">
                                        <input type="checkbox" {{ $commonsetting->is_disqus == '1' ? 'checked' : '' }} data-size="large" name="is_disqus" data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on-text="Active" data-label-text="<i class='fas fa-mouse'></i>"  data-off-text="Deactive">
                                        @if ($errors->has('is_disqus'))
                                        <p class="text-danger"> {{ $errors->first('is_disqus') }} </p>
                                        @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 control-label">{{ __('Disqus Shortname') }}<span
                                        class="text-danger">*</span></label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="disqus" value="{{$commonsetting->disqus}}" placeholder="{{ __('Disqus Shortname') }}">
                                    @if ($errors->has('disqus'))
                                    <p class="text-danger"> {{ $errors->first('disqus') }} </p>
                                    @endif
                                </div>
                            </div>

                            {{-- <div class="form-group row  mt-5">
                                <label class="col-sm-2 control-label">Google Analytics Status<span
                                            class="text-danger">*</span></label>

                                <div class="col-sm-10">
                                    <input type="checkbox" {{ $commonsetting->is_analytics == '1' ? 'checked' : '' }} data-size="large" name="is_analytics" data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on-text="Active" data-label-text="<i class='fas fa-mouse'></i>"  data-off-text="Deactive">
                                    @if ($errors->has('is_analytics'))
                                        <p class="text-danger"> {{ $errors->first('is_analytics') }} </p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 control-label">Google Analytics ID<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="google_analytics_id" value="{{ $commonsetting->google_analytics }}" placeholder="Google Analytics ID">
                                    @if ($errors->has('google_analytics_id'))
                                        <p class="text-danger"> {{ $errors->first('google_analytics_id') }} </p>
                                    @endif
                                </div>
                            </div> --}}

                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                                </div>
                            </div>

                        </form>

                    </div>
                    <!-- /.box-body -->
                </div>

            </div>
            <!-- /.col -->
        </div>
    </div>


</section>

@endsection
