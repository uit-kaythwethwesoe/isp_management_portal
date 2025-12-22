@extends('admin.layout')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ __('Promotions') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard',app()->getLocale()) }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('Promotions') }}</li>
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
                        <h3 class="card-title mt-1">{{ __('Promotions List') }}</h3>
                        <div class="card-tools d-flex">
                            <a href="{{ route('admin.promotion.add',app()->getLocale()) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> {{ __('Add') }}
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <table class="table table-striped table-bordered data_table">
                        <thead>
                            <tr>
                                <th>{{ __('#') }}</th>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Description') }}</th>
                                <th>{{ __('Type') }}</th>
                                <th>{{ __('Duration') }}</th>
                                <th>{{ __('Extra Months') }}</th>
                                <th>{{ __('Extra Days') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($promotions as $k=>$promotion)
                                <tr>
                                    <td>{{ ++$k }}</td>
                                    <td>{{ $promotion->title }}</td>
                                    <td><?php echo $promotion->description; ?></td>
                                    <td>
                                        @if($promotion->promotion_type == 1)
                                            <span class="badge badge-success">{{ __('Group 17') }}</span>
                                        @else
                                            <span class="badge badge-warning">{{ __('Normal') }}</span>
                                        @endif
    
                                    </td>
                                    <td>{{ $promotion->duration }}</td>
                                    <td>{{ $promotion->extra_month }}</td>
                                    <td>{{ $promotion->extra_days }}</td>
                                    <td>
                                        @if($promotion->status == 1)
                                            <span class="badge badge-success">{{ __('Publish') }}</span>
                                        @else
                                            <span class="badge badge-warning">{{ __('Unpublish') }}</span>
                                        @endif
    
                                    </td>
                                    <td>
                                        <a href="{{route('admin.promotion.edit',[app()->getLocale(),$promotion->id])}}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i>{{ __('Edit') }}</a>
                                        <form  id="deleteform" class="d-inline-block" action="{{route('admin.promotion.delete',[app()->getLocale(),$promotion->id])}}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $promotion->id }}">
                                            <button type="submit" class="btn btn-danger btn-sm" id="delete">
                                            <i class="fas fa-trash"></i>{{ __('Delete') }}
                                            </button>
                                        </form>
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
