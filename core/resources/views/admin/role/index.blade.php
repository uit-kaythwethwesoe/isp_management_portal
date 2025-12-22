@extends('admin.layout')
<script src="https://telco.mbt.com.mm/assets/admin/plugins/data-table/cdn/jquery.min.js"></script>
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ __('Role manage') }} </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard',app()->getLocale()) }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item">{{ __('Role manage') }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    
     @if(Session::has('message'))
    <div class="alert alert-success alert-dismissible" style="width: fit-content;">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Success!</strong> {{Session::get('message')}}
    </div>
    @endif
    <section class="content">
        <div class="container-fluid">
          
    <a href="{{route('admin.role_add',app()->getLocale())}}" style="color:#fff;" class="btn btn-success  waves-effect waves-light collapsed mb-2" >{{__('Add Role')}}</a>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                       
                        <!-- /.card-header -->
                        <div class="card-body">
                           <table id="example" class="display nowrap  table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>{{ __('#') }}</th>
                                        <th>{{ __('Role Name') }}</th>
                                        <th>{{ __('Creation Date') }}</th>
                                        <th>{{ __('Operating') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                     $num = 1;
                                    @endphp
                                    @foreach($role as $value)
                                    <tr>
                                        <td>{{$num}}</td>
                                        <td>{{$value->name}}</td>    
                                        
                                        <td>{{$value->created_at}}</td>
                                        <td>
                                        <a class="btn btn-xs btn-success" href="{{route('admin.update_role',[app()->getLocale(),$value->id])}}" >{{__('Update')}}</a>&nbsp;
                                          <a class="btn btn-xs btn-Danger" href="{{route('admin.delete_role',[app()->getLocale(),$value->id])}}" >{{__('Delete')}}</a>
                                         <!-- <form action="{{route('admin.disable_role',app()->getLocale())}}" method="GET" onsubmit="return confirm('{{ trans('Are You Sure!') }}');" style="display: inline-block;">-->
                                         <!--  <input type="hidden" name="role_id" value="{{$value->id}}">-->
                                         <!--  <input type="submit" class="btn btn-xs btn-danger" value="Disable">-->
                                         <!--</form>-->
                                        </td>
                                      <!--   <td>-->
                                      <!--&nbsp;-->
                                         <!-- <form action="{{route('admin.disable_role',app()->getLocale())}}" method="GET" onsubmit="return confirm('{{ trans('Are You Sure!') }}');" style="display: inline-block;">-->
                                         <!--  <input type="hidden" name="role_id" value="{{$value->id}}">-->
                                         <!--  <input type="submit" class="btn btn-xs btn-danger" value="Disable">-->
                                         <!--</form>-->
                                      <!--  </td>-->
                                    </tr>
                                     @php
                                     $num++;
                                    @endphp
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
@endsection
	<script>
	$(document).ready(function(){
		$('.toggle').hide();
	  $(".collapsed").click(function(){
		 
		$(".toggle").slideToggle();
	  });
	});
	</script>

