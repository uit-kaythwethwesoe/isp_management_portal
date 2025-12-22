@extends('admin.layout')
<script src="https://telco.mbt.com.mm/assets/admin/plugins/data-table/cdn/jquery.min.js"></script>
<script src="https://telco.mbt.com.mm/assets/admin/plugins/data-table/cdn/tableToExcel.js"></script>

@section('content')

<style>
    #Marketing_Information_filter, #Marketing_Information_info, #Marketing_Information_paginate{
        display: none !important;
    }
</style>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ __('Marketing Information') }} </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard',app()->getLocale()) }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item">{{ __('Marketing Information') }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
             
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline " style="border-radius:0px!important;">
                        <div class="card-header">
                            <h1 class="card-title mt-1">{{ __('Send Notification to All customers') }}</h1>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-6">
                                    <input type="text" placeholder="{{__('Search users')}}..."  name="search_users" id="username" class="form-control">
                                </div>
                            </div>
                            <form action="{{route('admin.store.multi.notification',app()->getLocale())}}" method="post" class="">
                                @csrf
                                    <div class="table-responsive">
                                      <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                          <tr>
                                            <th>{{ __('Id') }}</th>
                                            <th>{{ __('Select') }} <input type="checkbox" onclick="toggle(this);"></th>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Register phone') }}</th>
                                          </tr>
                                        </thead>
                                        <tbody id="allusers">
                                            @foreach($users as $index =>$value)
                                                <tr>
                                                    <td>{{$value->id}}</td>
                                                    <td>
                                                        <input type="checkbox" id="checkItem" name="users[]" value="{{$value->id}}">
                                                    </td>
                                                    <td>{{$value->name}}</td>    
                                                    <td>{{$value->phone}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tbody id="newusers">
                                        </tbody>
                                      </table>
                                      <div id="allusers1">
                                          {{ $users->links() }}
                                      </div>
                                    </div>
                                    
                                    <div class="row mt-5">
                                        <input type="hidden" name="account_id" value="0">
                                        <div class="col-md-12">
                                            <label class="col-sm-4 control-label">{{ __('Publish Information') }}<span class="text-danger">*</span></label>
                                            <div class="col-sm-12">
                                                <textarea class="form-control"  placeholder="{{ __('Enter Title') }}" name="publish_information" required></textarea>
                                            </div> 
                                        </div>
                                        <div class="col-md-3">
                                            <label class="col-sm-4 control-label"><span class="text-danger"></span></label>
                                            <div class="col-sm-12">
                                                <input type="submit" class="btn btn-success" value="{{ __('Send Notification') }}" style="margin-top: 43px;">
                                            </div> 
                                        </div>
                                    </div>
                              </form>
                        </div>
                    </div>
                </div>    
            </div> 
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h1 class="card-title mt-1">{{ __('Search Conditions') }}</h1>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{route('admin.marketting_information',app()->getLocale())}}" method="GET">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="col-sm- control-label">{{ __('Send Start Date') }}<span class="text-danger">*</span></label>
                                        <div class="col-sm-12">
                                            <input type="date" name="start_date" class="form-control">
                                        </div> 
                                    </div>
                                    <div class="col-md-4">
                                        <label class="col-sm-4 control-label">{{ __('Send End Date') }}<span class="text-danger">*</span></label>
                                        <div class="col-sm-12">
                                            <input type="date" name="end_date" class="form-control">
                                        </div> 
                                    </div>
                                    <div class="form-group row mr-8" >
                                        <div class="offset-sm-2 col-sm-10" style="margin-top: 31px;">
                                            <button type="submit" class="btn btn-primary">{{ __('Search') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                        <div class="card-body">     
                            <table id="Marketing_Information" class="table table-striped table-bordered data_table">
                                <thead>
                                    <tr>
                                        <th>{{ __('Send Date') }}</th>
                                        <th>{{ __('Publish Informaiton') }}</th>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
                                    @foreach($all_notifications as $notification)
                                        <?php
                                            $notifications = DB::table('notification')->where('publish_info', $notification->publish_info)->first();
                                        ?>
                                        <tr>
                                           <td>{{date('Y-m-d h:i a',strtotime($notifications->created_at))}}</td>
                                           <td>
                                                {{$notification->publish_info}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $all_notifications->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        $(document).on('input', '#username', function(){
            var to_user_id   =  $('#username').val();
            
            $.ajax({
                type:"GET",
                url:"{{url('en/admin/fetch-all-user')}}?user_id="+to_user_id,
                success:function(res){
                    $('#newusers').html(res);
                    $('#allusers').hide();
                    $('#allusers1').hide();
                    $('#newusers').show();
                }
            });
        });
    </script>
    
    <script>
        function toggle(source) {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i] != source)
                    checkboxes[i].checked = source.checked;
            }
        }
    </script>

  <script>
	 function exportReportToExcel() {
		  let table = document.getElementsByTagName("table"); // you can use document.getElementById('tableId') as well by providing id to the table tag
		  TableToExcel.convert(table[0], { // html code may contain multiple tables so here we are refering to 1st table tag
			name: `publish.xlsx`, // fileName you could use any name
			sheet: {
			  name: 'Sheet 1' // sheetName
			}
		  });
		}
	</script>