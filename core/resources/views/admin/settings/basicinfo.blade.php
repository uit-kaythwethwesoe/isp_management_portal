@extends('admin.layout')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{ __('Basic Information') }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard',app()->getLocale()) }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
                    <li class="breadcrumb-item">{{ __('Basic Information') }}</li>
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
                        <h3 class="card-title">{{ __('Update Basic Information') }} </h3>
                        <!--<div class="card-tools d-flex">-->
                        <!--    <div class="d-inline-block mr-4">-->
                        <!--        <select class="form-control lang languageSelect"  data="{{url()->current() . '?language='}}">-->
                        <!--            @foreach($langs as $lang)-->
                        <!--                <option value="{{$lang->code}}" {{$lang->code == request()->input('language') ? 'selected' : ''}} >{{$lang->name}}</option>-->
                        <!--            @endforeach-->
                        <!--        </select>-->
                        <!--    </div>-->
                        <!--</div>-->
                    </div>
                    <!-- /.box-header -->
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('admin.setting.updateBasicinfo', [app()->getLocale(),$basicinfo->language_id] ) }}" method="POST"  enctype="multipart/form-data">
                            @csrf
                            
                            <div class="form-group row">
                                <label for="website_title" class="col-sm-2 control-label">{{ __('App Title') }} <span
                                        class="text-danger">*</span></label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="website_title" value="{{ $basicinfo->website_title }}" placeholder="{{ __('Site Title') }}">
                                    @if ($errors->has('website_title'))
                                    <p class="text-danger"> {{ $errors->first('website_title') }} </p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 control-label">{{ __('App Address') }} <span
                                        class="text-danger">*</span></label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="address" value="{{ $basicinfo->address }}" placeholder="{{ __('Address') }}">
                                    @if ($errors->has('address'))
                                    <p class="text-danger"> {{ $errors->first('address') }} </p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 control-label">{{ __('App Logo') }} <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <img class="mb-3 show-img img-demo" src="
                                    @if($commoninfo->app_logo)
                                    {{ asset('assets/front/app/'.$commoninfo->app_logo) }}
                                    @else
                                    {{ asset('assets/admin/img/img-demo.jpg') }}
                                    @endif" alt="">
                                    <div class="custom-file">
                                        <label class="custom-file-label" for="header_logo">{{__('Choose New Image')}}</label>
                                        <input type="file" class="custom-file-input up-img" name="app_logo" id="header_logo">
                                    </div>
                                    <p class="help-block text-info">{{ __('Upload 550X550 (Pixel) Size image for best quality. Only jpg, jpeg, png image is allowed') }}
                                    </p>
                                </div>

                            </div>
                            
                            <div class="form-group row">
                                <label for="website_title" class="col-sm-2 control-label">{{ __('Package Expiry Days') }} <span
                                        class="text-danger">*</span></label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="package_expiry_days" value="{{ $basicinfo->package_expiry_days }}" placeholder="{{ __('Package Expiry Days') }}">
                                    @if ($errors->has('package_expiry_days'))
                                    <p class="text-danger"> {{ $errors->first('package_expiry_days') }} </p>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="website_title" class="col-sm-2 control-label">{{ __('IP Address') }} <span
                                        class="text-danger">*</span></label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="ip_address" value="{{ $basicinfo->ip_address }}" placeholder="{{ __('IP Address') }}">
                                    @if ($errors->has('ip_address'))
                                    <p class="text-danger"> {{ $errors->first('ip_address') }} </p>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="website_title" class="col-sm-2 control-label">{{ __('Payment due number of days') }} <span class="text-danger">*</span></label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="number_days" value="{{ $basicinfo->number_days }}" placeholder="{{ __('Number of Days') }}">
                                    @if ($errors->has('number_days'))
                                    <p class="text-danger"> {{ $errors->first('number_days') }} </p>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="website_title" class="col-sm-2 control-label">{{ __('New Payment Interface days') }} <span class="text-danger">*</span></label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="new_user_days" value="{{ $basicinfo->new_user_days }}" placeholder="{{ __('Number of Days') }}">
                                    @if ($errors->has('new_user_days'))
                                    <p class="text-danger"> {{ $errors->first('new_user_days') }} </p>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="website_title" class="col-sm-2 control-label">{{ __('New Payment Interface days 1') }} <span class="text-danger">*</span></label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="new_user_days1" value="{{ $basicinfo->new_user_days1 }}" placeholder="{{ __('Number of Days 1') }}">
                                    @if ($errors->has('new_user_days1'))
                                    <p class="text-danger"> {{ $errors->first('new_user_days1') }} </p>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="website_title" class="col-sm-2 control-label">{{ __('Discount') }} <span class="text-danger">*</span></label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="discount" value="{{ $basicinfo->discount }}" placeholder="{{ __('Discount') }}">
                                    @if ($errors->has('discount'))
                                    <p class="text-danger"> {{ $errors->first('discount') }} </p>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="website_title" class="col-sm-2 control-label">{{ __('Commercial Tax') }} <span class="text-danger">*</span></label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="commercial_tax" value="{{ $basicinfo->commercial_tax }}" placeholder="{{ __('Commercial Tax') }}">
                                    @if ($errors->has('commercial_tax'))
                                    <p class="text-danger"> {{ $errors->first('commercial_tax') }} </p>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="website_title" class="col-sm-2 control-label">{{ __('Maintenance Mode') }} <span class="text-danger">*</span></label>

                                <div class="col-sm-10">
                                    <select class="form-control" name="maintenance_mode">
                                        <option value="off" @if($basicinfo->maintenance_mode == 'off') selected @endif>OFF</option>
                                        <option value="on" @if($basicinfo->maintenance_mode == 'on') selected @endif>ON</option>
                                    </select>
                                    @if ($errors->has('maintenance_mode'))
                                    <p class="text-danger"> {{ $errors->first('maintenance_mode') }} </p>
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
                    <!-- /.box-body -->
                </div>

            </div>
            <!--<div class="col-md-12">-->
            <!--    <div class="card card-primary card-outline">-->
            <!--        <div class="card-header">-->
            <!--            <h3 class="card-title">{{ __('Update Basic Information') }} </h3>-->
            <!--        </div>-->
                    <!-- /.box-header -->
            <!--        <div class="card-body">-->
            <!--            <form class="form-horizontal" action="{{ route('admin.setting.commoninfo',app()->getLocale()) }}" method="POST" enctype="multipart/form-data">-->
            <!--                @csrf-->
                            <!--<div class="form-group row">-->
                            <!--    <label for="base_color" class="col-sm-2 control-label">{{ __('Theme Color') }}</label>-->
                            <!--    <div class="col-sm-10">-->
                            <!--        <div class="input-group my-colorpicker2">-->
                            <!--            <input type="text" class="form-control" value="{{ $commoninfo->base_color }}"  placeholder="#000000" name="base_color">-->
                            <!--            <div class="input-group-append">-->
                            <!--              <span class="input-group-text"><i class="fas fa-square"></i></span>-->
                            <!--            </div>-->
                            <!--          </div>-->
                            <!--    </div>-->
                            <!--</div>-->
            <!--                <div class="form-group row">-->
            <!--                    <label  class="col-sm-2 control-label">{{ __('Phone Number') }}<span-->
            <!--                            class="text-danger">*</span></label>-->
            <!--                    <div class="col-sm-10">-->
            <!--                        <input type="text" class="form-control" data-role="tagsinput" name="number" placeholder="{{ __('Number') }}" value="{{ $commoninfo->number }}">-->
            <!--                        <p class="help-block text-info">{{ __('The first entered number will show in the header top menu') }}-->
            <!--                        @if ($errors->has('number'))-->
            <!--                            <p class="text-danger"> {{ $errors->first('number') }} </p>-->
            <!--                        @endif-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--                <div class="form-group row">-->
            <!--                    <label  class="col-sm-2 control-label">{{ __('Email') }}<span-->
            <!--                            class="text-danger">*</span></label>-->
            <!--                    <div class="col-sm-10">-->
            <!--                        <input type="text" class="form-control" data-role="tagsinput" name="email" placeholder="{{ __('Email') }}" value="{{ $commoninfo->email }}">-->
            <!--                        <p class="help-block text-info">{{ __('The first entered email will show in the header top menu') }}-->
            <!--                        @if ($errors->has('email'))-->
            <!--                            <p class="text-danger"> {{ $errors->first('email') }} </p>-->
            <!--                        @endif-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--                <div class="form-group row">-->
            <!--                    <label  class="col-sm-2 control-label">{{ __('Contact Form Email') }}<span-->
            <!--                            class="text-danger">*</span></label>-->
            <!--                    <div class="col-sm-10">-->
            <!--                        <input type="email" class="form-control"  name="contactemail" placeholder="{{ __('Contact Form Email') }}" value="{{ $commoninfo->contactemail }}">-->
            <!--                        <p class="help-block text-info">{{ __('Contact page form  maill will send this email') }}-->
            <!--                        @if ($errors->has('contactemail'))-->
            <!--                            <p class="text-danger"> {{ $errors->first('contactemail') }} </p>-->
            <!--                        @endif-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--                <div class="form-group row">-->
            <!--                    <label class="col-sm-2 control-label">{{ __('Favicon') }} <span class="text-danger">*</span></label>-->
            <!--                    <div class="col-sm-10">-->
            <!--                        <img class="mb-3 show-img img-demo" src="-->
            <!--                        @if($commoninfo->fav_icon)-->
            <!--                        {{ asset('assets/front/img/'.$commoninfo->fav_icon) }}-->
            <!--                        @else-->
            <!--                        {{ asset('assets/admin/img/img-demo.jpg') }}-->
            <!--                        @endif"-->
            <!--                         alt="">-->
            <!--                        <div class="custom-file">-->
            <!--                            <label class="custom-file-label" for="fav_icon">{{ __('Choose New Image') }}</label>-->
            <!--                            <input type="file" class="custom-file-input up-img" name="fav_icon" id="fav_icon">-->
            <!--                        </div>-->
            <!--                        <p class="help-block text-info">{{ __('Upload 40X40 (Pixel) Size image or Squre size image for best quality. -->
            <!--                            Only jpg, jpeg, png image is allowed.') }}-->
            <!--                        </p>-->
            <!--                    </div>-->

            <!--                </div>-->
                            
            <!--                <div class="form-group row">-->
            <!--                    <label class="col-sm-2 control-label">{{ __('Site Header Logo') }} <span class="text-danger">*</span></label>-->
            <!--                    <div class="col-sm-10">-->
            <!--                        <img class="mb-3 show-img img-demo" src="-->
            <!--                        @if($commoninfo->header_logo)-->
            <!--                        {{ asset('assets/front/img/'.$commoninfo->header_logo) }}-->
            <!--                        @else-->
            <!--                        {{ asset('assets/admin/img/img-demo.jpg') }}-->
            <!--                        @endif" alt="">-->
            <!--                        <div class="custom-file">-->
            <!--                            <label class="custom-file-label" for="header_logo">Choose New Image</label>-->
            <!--                            <input type="file" class="custom-file-input up-img" name="header_logo" id="header_logo">-->
            <!--                        </div>-->
            <!--                        <p class="help-block text-info">{{ __('Upload 150X40 (Pixel) Size image for best quality.-->
            <!--                            Only jpg, jpeg, png image is allowed.') }}-->
            <!--                        </p>-->
            <!--                    </div>-->

            <!--                </div>-->
            <!--                <div class="form-group row">-->
            <!--                    <label class="col-sm-2 control-label">{{ __('Breadcrumb Image') }} <span class="text-danger">*</span></label>-->
            <!--                    <div class="col-sm-10">-->
            <!--                        <img class="mw-400 mb-3 show-img img-demo" src="-->
            <!--                        @if($commoninfo->breadcrumb_image)-->
            <!--                        {{ asset('assets/front/img/'.$commoninfo->breadcrumb_image)}}-->
            <!--                        @else-->
            <!--                        {{ asset('assets/admin/img/img-demo.jpg') }}-->
            <!--                        @endif"-->
            <!--                         alt="">-->
            <!--                        <div class="custom-file">-->
            <!--                            <label class="custom-file-label" for="breadcrumb_image">{{ __('Choose New Image') }}</label>-->
            <!--                            <input type="file" class="custom-file-input up-img" name="breadcrumb_image" id="breadcrumb_image">-->
            <!--                        </div>-->
            <!--                        <p class="help-block text-info">{{ __('Upload 1920X390 (Pixel) Size image for best quality.-->
            <!--                            Only jpg, jpeg, png image is allowed.') }}-->
            <!--                        </p>-->
            <!--                    </div>-->

            <!--                </div>-->
            <!--                <div class="form-group row">-->
            <!--                    <div class="offset-sm-2 col-sm-10">-->
            <!--                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </form>-->

            <!--        </div>-->
                    <!-- /.box-body -->
            <!--    </div>-->

            <!--</div>-->
            
            <!-- /.col -->
        </div>
    </div>


</section>

@endsection
