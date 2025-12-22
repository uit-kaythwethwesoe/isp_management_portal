
@extends('admin.layout')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{ __('Languages') }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard',app()->getLocale()) }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
                <li class="breadcrumb-item">{{ __('Label') }}</li>
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
                            <h3 class="card-title mt-1">{{ __('Languages List') }}</h3>
                            <div class="card-tools">
                                <a href="{{ route('admin.language.add',app()->getLocale()) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> {{ __('Add Label') }}
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!--@if (count($languages) == 0)-->
                            <!--    <h3 class="text-center">NO LANGUAGE FOUND</h3>-->
                            <!--@else-->
                           <table id="language_file" class="display nowrap  table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('String') }}</th>
                                        <th>{{ __('English') }}</th>
                                        <th>{{ __('Burmese') }}</th>
                                        <th>{{ __('Chinese') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($languages as $id=>$language)
                                    <tr>
                                        <td>{{$id+1}}</td>
                                        <td>{{$language->lang_string}}</td>
                                        <td>{{$language->lang_english}}</td>
                                        <td>{{$language->lang_burmese}}</td>
                                        <td>{{$language->lang_chinese}}</td>
                                        <td><a href="{{route('admin.language.Appedit',[app()->getLocale(),$language->lang_id])}}" >{{__('Edit')}}</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!--@endif-->
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->

    </section>
@endsection
