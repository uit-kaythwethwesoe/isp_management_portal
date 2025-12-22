@extends('admin.layout')
<script src="https://telco.mbt.com.mm/assets/admin/plugins/data-table/cdn/jquery.min.js"></script>
<script src="https://telco.mbt.com.mm/assets/admin/plugins/data-table/cdn/tableToExcel.js"></script>
@section('content')

    <style>
        #user_query_filter, #user_query_info, #user_query_paginate, .dt-buttons{
            display: none !important;
        }
    </style>
    
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ __('User Query') }} </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard',app()->getLocale()) }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item">{{ __('User Query') }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline" style="border-radius:0px!important;">
                        <div class="card-header">
                            <h1 class="card-title mt-1">{{ __('Search Conditions') }}</h1>
                        </div>
                        
                        <div class="card-body">
                            <form class="form-horizontal" action="{{ route('admin.user_query',app()->getLocale()) }}" method="GET">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="col-sm-4 control-label">{{ __('Register phone') }}<span class="text-danger">*</span></label>
                                        <div class="col-sm-12">
                                           <input type="number" class="form-control" id="phone" name="userphone" placeholder="{{ __('Enter register phone number') }}">
                                        </div> 
                                    </div>
                                        
                                    <div class="col-md-4">
                                        <label class="col-sm-4 control-label">{{ __('User Name') }}<span class="text-danger">*</span></label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="accountID" name="username" placeholder="{{ __('username') }}">
                                        </div> 
                                    </div>
                                        
                                    <div class="col-md-4">
                                        <label class="col-sm-4 control-label">{{ __('User Status') }}<span class="text-danger">*</span></label>
                                        <div class="col-sm-12">
                                            <select class="form-control lang" name="acc_status">
                                                <option value="0"  >{{ __('Normal') }}</option>
                                                <option value="1"  >{{ __('Disabled') }}</option>
                                            </select>
                                        </div> 
                                    </div>
                                
                                    <div class="col-md-4">
                                        <label class="col-sm-4 control-label">{{ __('Register date from') }}<span class="text-danger">*</span></label>
                                        <div class="col-sm-12">
                                            <input type="date" name="reg_date_str" class="form-control">
                                        </div> 
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <label class="col-sm-4 control-label">{{ __('Register date end') }}<span class="text-danger">*</span></label>
                                        <div class="col-sm-12">
                                            <input type="date" name="reg_date_end" class="form-control">
                                        </div> 
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary" style="margin-top: 30px;">{{ __('Search') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>    
            </div>   
        
        <a href="{{ route('admin.export_users_excel',app()->getLocale()) }}">
            <button class="btn btn-success">Excel</button>
        </a>
        <a href="{{ route('admin.export_users_pdf',app()->getLocale()) }}">
            <button class="btn btn-success">PDF</button>
        </a>
        
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title mt-1">{{ __('Search result') }}</h3>
                        </div>
                        
                        <div class="card-body">
                            <div id="demo" class="display">
                                <table id="user_query" class="table-bordered">                                
                                    <thead>
                                        <tr>
                                            <th>{{ __('#') }}</th>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Register phone') }}</th>
                                            <th>{{ __('Password') }}</th>
                                            <th>{{ __('Register date') }}</th>
                                            <th>{{ __('Account Status') }}</th>
                                            <th>{{ __('Operating') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($bind_user as $index =>$value)
                                            <tr>
                                                <td>{{$index+1}}</td>
                                                <td>{{$value->name}}</td>    
                                                <td>{{$value->phone}}</td>
                                                {{-- SECURITY: Show masked password instead of plaintext --}}
                                                <td>{{ $value->new_pass ? '••••••••' : 'N/A' }}</td>
                                                <td>{{date('Y-m-d', strtotime($value->created_at))}}</td>
                                                <td>
                                                    <?php 
                                                        if($value->user_status == 0)
                                                        {
                                                            $status = "<b class='badge badge-warning'>Normal</b>"; 
                                                        }else
                                                        {
                                                            $status = "<b class='badge badge-danger'>Disabled</b>";
                                                        }
                                                        echo $status;
                                                    ?>
                                                </td>
                                                <td><a href="{{route('admin.userdetails',[app()->getLocale(),$value->id])}}" >{{__('Details')}}</a> </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $bind_user->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

<script>
    $(document).ready(function(){
       $(".lang").on("change", function() {
        var value = $(this).val().toLowerCase();
       // alert(value);
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
     
    });
</script>

<script>
      $(document).ready(function(){
      $("#phone").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
      $("#accountID").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
      });
</script>

<script>
	function exportReportToExcel() {
	  let table = document.getElementsByTagName("table"); // you can use document.getElementById('tableId') as well by providing id to the table tag
	  TableToExcel.convert(table[0], { // html code may contain multiple tables so here we are refering to 1st table tag
		name: `user_query.xlsx`, // fileName you could use any name
		sheet: {
		  name: 'Sheet 1' // sheetName
		}
	  });
	}
</script>