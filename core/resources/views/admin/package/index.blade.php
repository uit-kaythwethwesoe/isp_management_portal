@extends('admin.layout')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ __('Packages') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard',app()->getLocale()) }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('Package') }}</li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<section class="content">
    <div class="container-fluid">
        <!--<div class="row">-->
        <!--    <div class="col-lg-12">-->
        <!--        <div class="card card-primary card-outline">-->
        <!--            <div class="card-header">-->
        <!--                <h3 class="card-title mt-1">{{ __('Pakage Content') }}</h3>-->
        <!--                <div class="card-tools">-->
        <!--                    <div class="d-inline-block mr-4">-->
        <!--                <select class="form-control lang" id="languageSelect" data="{{url()->current() . '?language='}}">-->
        <!--                    @foreach($langs as $lang)-->
        <!--                        <option value="{{$lang->code}}" {{$lang->code == request()->input('language') ? 'selected' : ''}} >{{$lang->name}}</option>-->
        <!--                    @endforeach-->
        <!--                </select>-->
        <!--            </div>-->
        <!--                </div>-->
        <!--            </div>-->
                    <!-- /.card-header -->
        <!--            <div class="card-body">-->
        <!--                <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">-->
        <!--                    @csrf-->
                            
        <!--                    <div class="form-group row">-->
        <!--                        <label class="col-sm-2 control-label">{{ __('Pakage Title') }}<span class="text-danger">*</span></label>-->

        <!--                        <div class="col-sm-10">-->
        <!--                            <input type="text" class="form-control" name="plan_title" placeholder="{{ __('Pakage Title') }}" value="{{ $saectiontitle->plan_title }}">-->
        <!--                            @if ($errors->has('plan_title'))-->
        <!--                                <p class="text-danger"> {{ $errors->first('plan_title') }} </p>-->
        <!--                            @endif-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                    <div class="form-group row">-->
        <!--                        <label  class="col-sm-2 control-label">{{ __('Pakage Sub-title') }}<span class="text-danger">*</span></label>-->

        <!--                        <div class="col-sm-10">-->
        <!--                            <input type="text" class="form-control" name="plan_subtitle" placeholder="{{ __('Pakage Sub-Title') }}" value="{{ $saectiontitle->plan_subtitle }}">-->
        <!--                            @if ($errors->has('plan_subtitle'))-->
        <!--                                <p class="text-danger"> {{ $errors->first('plan_subtitle') }} </p>-->
        <!--                            @endif-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                    <div class="form-group row">-->
        <!--                        <label class="col-sm-2 control-label">{{ __('Pakage BG Image') }} </label>-->
        <!--                        <div class="col-sm-10">-->
        <!--                            <img class="mw-400 mb-3 show-img img-demo" src="-->
        <!--                            @if($saectiontitle->pricing_bg)-->
        <!--                            {{ asset('assets/front/img/'.$saectiontitle->pricing_bg) }}-->
        <!--                            @else-->
        <!--                            {{ asset('assets/admin/img/img-demo.jpg') }}-->
        <!--                            @endif" alt="">-->
        <!--                            <div class="custom-file">-->
        <!--                                <label class="custom-file-label" for="pricing_bg">Choose New Image</label>-->
        <!--                                <input type="file" class="custom-file-input up-img" name="pricing_bg" id="pricing_bg">-->
        <!--                            </div>-->
        <!--                            <p class="help-block text-info">{{ __('Upload 1920X900 (Pixel) Size image for best quality.-->
        <!--                                Only jpg, jpeg, png image is allowed.') }}-->
        <!--                            </p>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                    <div class="form-group row">-->
        <!--                        <div class="offset-sm-2 col-sm-10">-->
        <!--                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>-->
        <!--                        </div>-->
        <!--                    </div>-->
                        
        <!--                </form>-->
                        
        <!--            </div>-->
                    <!-- /.card-body -->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title mt-1">{{ __('Package List') }}</h3>
                        <div class="card-tools d-flex">
                            <!--<div class="d-inline-block mr-4">-->
                            <!--    <select class="form-control lang languageSelect" data="{{url()->current() . '?language='}}">-->
                            <!--        @foreach($langs as $lang)-->
                            <!--            <option value="{{$lang->code}}" {{$lang->code == request()->input('language') ? 'selected' : ''}} >{{$lang->name}}</option>-->
                            <!--        @endforeach-->
                            <!--    </select>-->
                            <!--</div>-->
                            <!--a href="{{route('admin.package.add',app()->getLocale())}}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> {{ __('Add Package') }}
                            </a-->
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <table class="table table-striped table-bordered data_table">
                        <thead>
                            <tr>
                                <th>{{ __('#') }}</th>
                                <th>{{ __('Name') }}</th>
                                <!--<th>{{ __('Price') }}</th>-->
                                <th>{{ __('Duration') }}</th>
                                <th>{{ __('Description') }}</th>
                                <th>{{ __('Bill package ID') }}</th>
                                <!--<th>{{ __('Speed') }}</th>-->
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($packages as $id=>$package)
                            <tr>
                                <td>
                                    {{ $id+1 }}
                                </td>
                                <td>
                                    {{ $package->name }}
                                </td>
                                <!--<td>-->
                                <!--    Ks  {{ $package->price }}-->
                                <!--</td>-->
                                <td>
                                    
                                    <span class="badge badge-info">{{ __($package->time) }}</span>
                                  
                                </td>
                                <td>
                                    {{ $package->feature }}
                                </td>
                                 <td>
                                   {{ $package->billing_package_id }}
                                </td>
                                <td>
                                    @if($package->status == 1)
                                        <span class="badge badge-success">{{ __('Publish') }}</span>
                                    @else
                                        <span class="badge badge-warning">{{ __('Unpublish') }}</span>
                                    @endif

                                </td>
                                <td>
                                    <a href="{{route('admin.package.edit',[app()->getLocale(),$package->id])}}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i>{{ __('Edit') }}</a>
                                    <!--form  id="deleteform" class="d-inline-block" action="{{route('admin.package.delete',[app()->getLocale(),$package->id])}}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $package->id }}">
                                        <button type="submit" class="btn btn-danger btn-sm" id="delete">
                                        <i class="fas fa-trash"></i>{{ __('Delete') }}
                                        </button>
                                    </form-->
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
    <!-- /.row -->
</section>
@endsection
