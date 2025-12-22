@extends('admin.layout')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ __('Customers') }} </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard', app()->getLocale()) }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item">{{ __('Customers') }}</li>
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
                            <h3 class="card-title mt-1">{{ __('Customer Who buy package :') }}</h3>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                           <table id="example" class="display nowrap  table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>{{ __('#') }}</th>
                                        <th>{{ __('Image') }}</th>
                                        <th>{{ __('Username') }}</th>
                                        <th>{{ __('Email') }}</th>
                                        <th>{{ __('Number') }}</th>
                                        <th>{{ __('Address') }}</th>
                                        <th>{{ __('View More') }}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                @foreach ($activeusers as $id=>$user)
                                    <tr>
                                        <td>
                                            {{ $id }}
                                        </td>
                                        <td>
                                            <img src="{{!empty($user->photo) ? asset('assets/front/img/'.$user->photo) : ''}}" alt="" width="60">
                                        </td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{$user->phone}}</td>
                                        <td>{{$user->address}}</td>
                                        <td>
                                            <a  href="{{route('register.user.view',$user->id)}}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> View</a>
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
