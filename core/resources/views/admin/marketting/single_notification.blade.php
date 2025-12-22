@extends('admin.layout')
<script src="https://telco.mbt.com.mm/assets/admin/plugins/data-table/cdn/jquery.min.js"></script>
<script src="https://telco.mbt.com.mm/assets/admin/plugins/data-table/cdn/tableToExcel.js"></script>

<link href="https://telco.mbt.com.mm/assets/admin//plugins/data-table/cdn/select2.min.css" rel="stylesheet" />
<script src="https://telco.mbt.com.mm/assets/admin//plugins/data-table/cdn/select2.min.js"></script>
@section('content')
<style>
.select2-container--default .select2-selection--multiple .select2-selection__choice__remove{
    margin-left:-2px!important;
}
#user_notificatio_filter, #user_notificatio_info, #user_notificatio_paginate{
    display: none !important;
}
</style>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ __('User Notification') }} </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard',app()->getLocale()) }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item">{{ __('User Notification') }}</li>
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
                            <h1 class="card-title mt-1">{{ __('Send Notification to Single customers') }}</h1>
                         </div>
                        <div class="card-body">
                            <form action="{{route('admin.store.notification',app()->getLocale())}}" method="post">
                           @csrf
                          <div class="row">
                               
                              <div class="col-md-4">
                                <label class="col-sm-4 control-label">{{ __('Register Phone') }}<span class="text-danger">*</span></label>
                                 <div class="col-sm-12">
                                     <select class="js-example-basic-multiple form-control lang shubham"  multiple="multiple"  id="myInput_change" name="account_id[]" required>
                                       <!--<option value="" selected disabled  >--{{ __('Account ID') }}--</option>-->
                                        @foreach($allusers as $value)
                                          <option value="{{$value->phone}}"  >{{$value->phone}}</option>
                                       @endforeach
                                     </select>
                                  </div> 
                                </div>
                           
                       
                        <!--        <div class="col-md-3">-->
                        <!--         <label class="col-sm-4 control-label">{{ __('Title') }}<span class="text-danger">*</span></label>-->
                        <!--          <div class="col-sm-12">-->
                        <!--             <input type="text" class="form-control"  placeholder="Enter Title ..." name="sub_com_id" required >-->
                        <!--          </div> -->
                        <!--        </div>-->
                            
                       
                        <!--<div class="col-md-3">-->
                        <!--        <label class="col-sm-4 control-label">{{ __('Image') }}<span class="text-danger">*</span></label>-->
                        <!--         <div class="col-sm-12">-->
                        <!--             <input type="file" class="form-control"  placeholder="Enter Title ..." name="sub_com_id" required>-->
                        <!--          </div> -->
                        <!--        </div>-->
                           
                        
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
                        </form>
                         </div>
                         </div>
                    </div>
                </div>    
        </div>   
<div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                       <div class="card-header">
                            <h1 class="card-title mt-1">{{ __('Search Conditions') }}</h1>
                            <!--<button type="button" style="color:#fff;float: right;" class="btn btn-xs btn-success collapsed mb-2" ><i class="filter-m-blue"></i>Advance Filter &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-down"></i></button>&nbsp;&nbsp;&nbsp;-->
                         </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{route('admin.user_notification',app()->getLocale())}}" method="GET">
                            <div class="row">
                                <div class="col-md-4">
                                        <label class="col-sm- control-label">{{ __('Register Phone') }}<span class="text-danger">*</span></label>
                                          <div class="col-sm-12">
                                            <input type="number" class="form-control" id="shubham" placeholder="{{ __('Register Phone') }}">
                                          </div> 
                                        </div>
                                        
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
                            <table id="user_notificatio" class="display nowrap  table-striped table-bordered">
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
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
@endsection

  <script>
  $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
  
	 function exportReportToExcel() {
		  let table = document.getElementsByTagName("table"); // you can use document.getElementById('tableId') as well by providing id to the table tag
		  TableToExcel.convert(table[0], { // html code may contain multiple tables so here we are refering to 1st table tag
			name: `publish.xlsx`, // fileName you could use any name
			sheet: {
			  name: 'Sheet 1' // sheetName
			}
		  });
		}
		$(document).ready(function(){
          $("#shubham").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });
          });
	</script>