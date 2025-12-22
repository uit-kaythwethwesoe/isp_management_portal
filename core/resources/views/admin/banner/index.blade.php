@extends('admin.layout')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{ __('App Banner') }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard',app()->getLocale()) }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
                    <li class="breadcrumb-item">{{ __('App Banner') }}</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="modal" id="myModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">{{ __('Add New Banner') }}</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
    <form action="{{route('admin.upload_banner',app()->getLocale())}}" method="post" enctype="multipart/form-data" >
        @csrf
       
       <div class="row"> 
        <div class="col-md-4">
        <label class="col-sm-4 control-label">{{ __('Banner Title') }}<span class="text-danger">*</span></label>
         <div class="col-sm-12">
             <input type="text" name="banner_title" required placeholder="{{ __('Enter Banner Title') }}" value="" class="form-control" >
          </div> 
        </div>
        <div class="col-md-4">
        <label class="col-sm-4 control-label">{{ __('Banner URL*') }}<span class="text-danger">*</span></label>
         <div class="col-sm-12">
             <input type="text" name="banner_url" required placeholder="{{ __('Enter Banner URL') }}" value="" class="form-control" >
          </div> 
        </div>
         <div class="col-md-4">
        <label class="col-sm-4 control-label">{{ __('upload Banner') }}<span class="text-danger">*</span></label>
         <div class="col-sm-12">
             <input type="file" name="upload_banner"   required class="form-control" >
          </div> 
        </div>
       </div>
      </div>
    <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" value="Submit" name="Submit">{{ __('Submit') }}</button>
      </div>
  </form>
    </div>
  </div>
</div>
 <section class="content">
        <div class="container-fluid">
            <a data-toggle="modal" data-target="#myModal"  style="color:#fff;" class="btn btn-success  waves-effect waves-light collapsed mb-2">{{ __('Add Banner') }}</a>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title mt-1">{{ __('Banner Lists') }}</h3>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-striped table-bordered data_table">
                                <thead>
                                    <tr>
                                        <th>{{ __('#') }}</th>
                                        <th>{{ __('Image') }}</th>
                                        <th>{{ __('Title') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($banner as $index=>$value)
                                     <tr>
                                        <td>
                                           {{$index+1}}
                                        </td>
                                        <td>
                                            <img src="{{ asset('assets/front/banner/'.$value->image) }}" alt="" width="60">
                                        </td>
                                         <td>
                                             {{$value->name}}
                                        </td>
                                         <td>
                                         <a  href="{{route('admin.delete_banner',[app()->getLocale(),$value->id])}}" title='Delete Banner' class="badge badge-danger"><i class="fas fa-trash"></i> </a>
                                         &nbsp;
                                          <a data-toggle="modal" style="color:white;cursor:pointer;" data-target="#myModal{{$index}}" title='Edit Banner' class="badge badge-primary">{{__('Edit')}} </a>
                                        </td>
                                        
                                        <div class="modal" id="myModal{{$index}}">
                                          <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                        
                                              <!-- Modal Header -->
                                              <div class="modal-header">
                                                <h4 class="modal-title">{{__('Update Banner')}}</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                              </div>
                                        
                                              <!-- Modal body -->
                                              <div class="modal-body">
                                            <form action="{{route('admin.edit_banner',app()->getLocale())}}" method="post" enctype="multipart/form-data" >
                                                @csrf
                                               <input type="hidden" name="old_url" value="{{$value->image}}">
                                                <input type="hidden" name="banner_id" value="{{$value->id}}">
                                               <div class="row">
                                                <div class="col-md-4">
                                                <label class="col-sm-4 control-label">{{ __('Banner Title') }}<span class="text-danger">*</span></label>
                                                 <div class="col-sm-12">
                                                     <input type="text" name="edit_banner_title" value="{{$value->name}}" required placeholder="Enter Banner Title" value="" class="form-control" >
                                                  </div> 
                                                </div>
                                                <div class="col-md-4">
                                                <label class="col-sm-4 control-label">{{ __('Banner URL*') }}<span class="text-danger">*</span></label>
                                                 <div class="col-sm-12">
                                                     <input type="text" name="banner_url" required placeholder="{{ __('Enter Banner URL') }}" value="{{$value->position}}" class="form-control" >
                                                  </div> 
                                                </div>
                                                 <div class="col-md-4">
                                                <label class="col-sm-4 control-label">{{ __('upload Banner') }}<span class="text-danger">*</span></label>
                                                <div class="col-sm-12">
                                                     <input type="file" name="edit_upload_banner"  class="form-control" >
                                                  </div> 
                                                   <img src="{{ asset('assets/front/banner/'.$value->image) }}" alt="" width="60">
                                                </div>
                                               </div>
                                              </div>
                                            <!-- Modal footer -->
                                              <div class="modal-footer">
                                                <button type="submit" class="btn btn-success" value="Submit" name="Submit">Submit</button>
                                              </div>
                                          </form>
                                            </div>
                                          </div>
                                        </div>
                                        
                                    </tr>
                               @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
<!--<section class="content">-->
<!--    <div class="container-fluid">-->
<!--        <div class="row">-->
<!--            <div class="col-md-12">-->
<!--                <div class="card card-primary card-outline">-->
<!--                    <div class="card-header">-->
<!--                        <h3 class="card-title">{{ __('Add Banner for  App') }} </h3>-->
<!--                           <div class="card-tools d-flex">-->
<!--                        </div>-->
<!--                    </div>-->
                    <!-- /.box-header -->
<!--                    <div class="card-body">-->
<!--                        <form class="form-horizontal" action="" method="POST" >-->
<!--                            @csrf-->
                            
<!--                            <div class="form-group row">-->
<!--                                <label for="website_title" class="col-sm-2 control-label">{{ __('Banner Title') }} <span-->
<!--                                        class="text-danger">*</span></label>-->

<!--                                <div class="col-sm-10">-->
<!--                                    <input type="text" class="form-control" name="website_title" value="" placeholder="{{ __('Banner Title') }}">-->
<!--                                    @if ($errors->has('website_title'))-->
<!--                                    <p class="text-danger"> {{ $errors->first('website_title') }} </p>-->
<!--                                    @endif-->
<!--                                </div>-->
<!--                            </div>-->
                           
<!--                            <div class="form-group row">-->
<!--                                <label class="col-sm-2 control-label">{{ __('Banner Image') }} <span class="text-danger">*</span></label>-->
<!--                                <div class="col-sm-10">-->
<!--                                    <img class="mb-3 show-img img-demo" src="" alt="">-->
                                
<!--                                    <div class="custom-file">-->
<!--                                        <label class="custom-file-label" for="header_logo">Choose New Image</label>-->
<!--                                        <input type="file" class="custom-file-input up-img" name="header_logo" id="header_logo">-->
<!--                                    </div>-->
<!--                                    <p class="help-block text-info">{{ __('Upload 150X40 (Pixel) Size image for best quality.-->
<!--                                        Only jpg, jpeg, png image is allowed.') }}-->
<!--                                    </p>-->
<!--                                </div>-->

<!--                            </div>-->
<!--                            <div class="form-group row">-->
<!--                                <div class="offset-sm-2 col-sm-10">-->
<!--                                    <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>-->
<!--                                </div>-->
<!--                            </div>-->

<!--                        </form>-->

<!--                    </div>-->
                    <!-- /.box-body -->
<!--                </div>-->

<!--            </div>-->
           
<!--        </div>-->
<!--    </div>-->


<!--</section>-->

@endsection
