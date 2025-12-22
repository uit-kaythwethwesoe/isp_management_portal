@extends('admin.layout')

@section('content')

<div class="content-header">
        <div class="container-fluid">
            <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{ __('Payment Gateway') }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard', app()->getLocale()) }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
                <li class="breadcrumb-item">{{ __('Payment Gateway') }}</li>
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
                    <h3 class="card-title mt-1">{{ __('Payment Gateway List') }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <table id="idtable" class="table table-bordered table-striped data_table">
                        <thead>
                            <tr>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Description') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $id=>$gateway)
                        <tr>

                            <td>{{ $gateway->name }}</td>
                            <td>
                            @if($gateway->type == 'automatic')
                                {{ $gateway->getAutoDataText() }}
                            @else
                                {{ mb_strlen(strip_tags($gateway->details),'utf-8') > 250 ? mb_substr(strip_tags($gateway->details),0,250,'utf-8').'...' : strip_tags($gateway->details) }}
                            @endif
                            </td>

                            <td>
                                @if($gateway->status == 1)
                                    <span class="badge badge-success">{{ __('Active') }}</span>
                                @else
                                    <span class="badge badge-warning">{{ __('Dactive') }}</span>
                                @endif
                            </td>

                            <td width="18%">
                                <a href="{{ route('admin.payment.edit', $gateway->id) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i>{{ __('Edit') }}</a>
                                @if($gateway->type == 'menual' && $gateway->keyword == null)
                                <a href="javascript:;" data-href="{{ route('admin.payment.delete', $gateway->id ) }}" class="btn btn-danger btn-sm delete" data-toggle="modal" data-target=".deleteModel"><i class="fas fa-trash"></i>{{ __('Delete') }}</a>
                                @endif
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
    <div class="modal fade deleteModel" tabindex="-1" role="dialog"
    aria-labelledby="deleteModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">{{ __("Confirm Delete") }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <p class="text-center">{{__("Are you sure")}}</p>
            <p class="text-center">{{ __("Do you want to proceed?") }}</p>
        </div>
        <div class="modal-footer">
            <a href="javascript:;" class="btn btn-secondary" data-dismiss="modal">{{ __("Cancel") }}</a>
            <a href="javascript:;" class="btn btn-danger btn-delete">{{ __("Delete") }}</a>
        </div>
    </div>
    </div>
    </div>
</section>
@endsection
