@extends('admin.layout')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ __('Role Users') }} </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard',app()->getLocale()) }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item">{{ __('Users') }}</li>
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
            <a href="{{route('admin.user.form',app()->getLocale())}}" style="color:#fff;" class="btn btn-success  waves-effect waves-light collapsed mb-2">{{__('Add User')}}</a>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title mt-1">{{ __('Role User Lists') }}</h3>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                           <table id="example" class="display nowrap  table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>{{ __('#') }}</th>
                                        <!--<th>{{ __('Image') }}</th>-->
                                        <th>{{ __('User ID') }}</th>
                                        <th>{{ __('Login Name') }}</th>
                                        <th>{{ __('Role') }}</th>
                                        <th>{{ __('Email') }}</th>
                                        <th>{{ __('Number') }}</th>
                                        <th>{{ __('View More') }}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                @foreach ($users as $id=>$user)
                                    <tr>
                                        <td>
                                            {{ $id+1 }}
                                        </td>
                                        <!--<td>-->
                                        <!--    <img src="{{!empty($user->photo) ? asset('assets/front/img/'.$user->photo) : ''}}" alt="" width="60">-->
                                        <!--</td>-->
                                        <td>{{ $user->uniqid??'' }}</td>
                                        <td>{{ $user->username??'Null' }}</td>
                                        <td><b class="badge badge-success"> {{App\Role::find($user->role_id)->name??''}}</b></td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <!--<td><b class="{{ App\StatusDescription::find($user->user_status)->status_class??'' }}">{{App\StatusDescription::find($user->user_status)->status_name??''}}</b></td>-->
                                        <td>
                                            <a  href="{{route('register.user.view',[app()->getLocale(),$user->id])}}" class="badge badge-primary"><i class="fas fa-eye"></i> {{__('Update')}}</a>
                                            <a  href="{{route('register.user.delete',[app()->getLocale(),$user->id])}}" title='Delete Staff' class="badge badge-danger"><i class="fas fa-trash"></i> </a>
            <a  href="{{route('register.user.edit_role',[app()->getLocale(),$user->id])}}" title='Edit Staff' class="badge badge-danger"><i class="fas fa-edit"></i> </a>

                                        </td>
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
@endsection
