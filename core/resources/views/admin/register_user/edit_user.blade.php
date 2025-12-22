@extends('admin.layout')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ __('Add Role User') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard',app()->getLocale()) }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('Add Role User') }}</li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
@if ($errors->any())
  <div class="alert alert-danger" style="width: fit-content;">
     <ul>
        @foreach ($errors->all() as $error)
           <li>{{ $error }}</li>
        @endforeach
     </ul>
     @if ($errors->has('email'))
     @endif
  </div>
@endif
  @if(Session::has('message'))
    <div class="alert alert-success alert-dismissible" style="width: fit-content;">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Success!</strong> {{Session::get('message')}}
    </div>
    @endif
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title mt-1">{{ __('Add User') }}</h3>
                                <div class="card-tools">
                                    <a href="{{ route('admin.register.user',app()->getLocale())}}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-angle-double-left"></i> {{ __('Back') }}
                                    </a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                         

                                <form class="form-horizontal" action="{{ route('register.user.edit',app()->getLocale())}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    
                                    <div class="form-group row">
                                        <input type="hidden" name="id" value="{{ $user->id }}" />
                                        <label class="col-sm-2 control-label">{{ __('Login name') }}<span class="text-danger">*</span></label>
        
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="username" value="{{ $user->username }}" placeholder="{{ __('Loginname') }}" value="{{ old('name') }}">
                                          
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label  class="col-sm-2 control-label">{{ __('Email') }}<span class="text-danger">*</span></label>
        
                                        <div class="col-sm-10">  
                                            <input type="text" class="form-control" name="email" value="{{ $user->email }}" placeholder=" {{ __('Email') }}" value="{{ old('offer') }}">
                                          
                                        </div>
                                    </div>  
                                
                                    <div class="form-group row">
                                        <label  class="col-sm-2 control-label">{{ __('Telephone') }}<span class="text-danger">*</span></label>
        
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="phone"  value="{{ $user->phone }}" placeholder="{{ __('Number') }}" value="">
                                           
                                        </div>
                                    </div>
                                   
                                  
                                    <!--</div>-->
                                    <div class="form-group row">
                                        <label  class="col-sm-2 control-label">{{ __('Add New Password') }}<span class="text-danger">*</span></label>
        
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="{{ __('Add New Password') }}">
                                           
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label  class="col-sm-2 control-label">{{ __('Confirm Password') }}<span class="text-danger">*</span></label>
        
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" name="confpassword" placeholder="{{ __('Confirm Password') }}" id="confpassword">
                                            
                                                <small id="error" class="text-danger">Password and Confirm Password should be Same!</small>
                                          
                                        </div>
                                    </div>  
                                    <div class="form-group row">
                                        <label for="status" class="col-sm-2 control-label">{{ __('Status') }}<span class="text-danger">*</span></label>
                                         <div class="col-sm-10">
                                                <select class="form-control" name="status">
                                                
                                                  <option value="1">Normal</option>
                                                  <option value="2">Disable</option>
                                                                                            
                                              </select>
                                            
                                            
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="status" class="col-sm-2 control-label">{{ __('Assign Role') }}<span class="text-danger">*</span></label>
                                         <div class="col-sm-10">
                                          

                                          <select class="form-control" name="role_id" required="">
                                              
                                                <option value="" selected="">Select Role</option>
                                             
                                              @foreach ($role as $users)
                                                 <option value="{{ $users->id }}" {{ $users->id == $user->role_id? 'selected' : '' }}>{{ $users->name }}</option>
                                            @endforeach                                     
                                              
                                          </select>
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" id="sub" class="btn btn-primary">{{ __('Save') }}</button>
                                        </div>
                                    </div>
                                
                                </form>
            

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <script>
                            $(document).ready(function(){
                            //   $('#sub').prop('disabled', true);
                              $('#error').hide();
                              $("#confpassword").keyup(function(){
                                  var conf = $('#confpassword').val();
                                  var pass = $('#password').val();
                                  if(pass == conf)
                                  {
                                      //alert('ok');
                                     $('#error').hide();
                                      $('#sub').prop('disabled', false);
                                  }else
                                  {
                                       //alert('not');
                                       $('#error').show();
                                      $('#sub').prop('disabled', true);
                                  }
                              });
                            });
                         </script>
            </div>
        </div>
    </div>
    <!-- /.row -->

</section>
@endsection
