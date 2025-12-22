@extends('admin.layout')
<script src="https://telco.mbt.com.mm/assets/admin/plugins/data-table/cdn/jquery.min.js"></script>
<script src="https://telco.mbt.com.mm/assets/admin/plugins/data-table/cdn/tableToExcel.js"></script>
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ __('User Disable') }} </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard', app()->getLocale()) }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item">{{ __('User Disable') }}</li>
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
             
         <div class="row">
            
        <div class="col-md-12">

                    <div class="card card-primary card-outline" style="border-radius:0px!important;">
                       <div class="card-header">
                            <h1 class="card-title mt-1">{{ __('Search Conditions') }}</h1>
                            <button type="button" style="color:#fff;float: right;" class="btn btn-xs btn-success collapsed mb-2" ><i class="filter-m-blue"></i>Advance Filter &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-down"></i></button>&nbsp;&nbsp;&nbsp;
                           &nbsp;<a href="{{route('admin.user_disabled')}}" style="color:#fff;float: right;margin-right: 7px;" class="btn btn-xs btn-danger mb-2" >Referesh &nbsp;<i class="fa fa-refresh"></i></a>
                           <a onclick="exportReportToExcel(this)" style="color:#fff;float: right;margin-right: 7px;" class="btn btn-xs btn-success mb-2" >Export  &nbsp;<i class="fas fa-file-excel"></i></a>
                         </div>
                        <div class="card-body">
                              <div class="row">
                                       <div class="col-md-3">
                                        <label class="col-sm-4 control-label">{{ __('Register phone') }}<span class="text-danger">*</span></label>
                                         <div class="col-sm-12">
                                           <input type="number" class="form-control" id="phone">
                                          </div> 
                                        </div>
                                        <div class="col-md-3">
                                        <label class="col-sm-4 control-label">{{ __('Sub Company') }}<span class="text-danger">*</span></label>
                                         <div class="col-sm-12">
                                             <select class="form-control lang shubham" id="myInput_change" name="sub_com_id" >
                                               <option value="" selected disabled  >--Select Sub Company--</option>
                                               @foreach($sub_com as $value)
                                                <option value="{{$value->company_name}}">{{$value->company_name}}</option>
                                              @endforeach
                                             </select>
                                          </div> 
                                        </div>
                                        <div class="col-md-3">
                                         <label class="col-sm-4 control-label">{{ __('User Account(ID') }}<span class="text-danger">*</span></label>
                                          <div class="col-sm-12">
                                            <input type="text" class="form-control" id="accountID" name="" placeholder="Enter account ID...">
                                          </div> 
                                        </div>
                                        <div class="col-md-3">
                                        <label class="col-sm-4 control-label">{{ __('Account Status') }}<span class="text-danger">*</span></label>
                                         <div class="col-sm-12">
                                           <select class="form-control lang" name="language_id">
                                               <option value="Normal"  >Normal</option>
                                                <option value="Disabled"  >Disabled</option>
                                             </select>
                                          </div> 
                                        </div>
                                        </div>
                                <div class="toggle">
                                  <form class="form-horizontal" action="{{ route('admin.user_query') }}" method="GET">
                                    <div class="row">
                                        <div class="col-md-3">
                                        <label class="col-sm-4 control-label">{{ __('Register date from') }}<span class="text-danger">*</span></label>
                                         <div class="col-sm-12">
                                            <input type="date" name="reg_date_str" class="form-control">
                                          </div> 
                                        </div>
                                        <div class="col-md-3">
                                        <label class="col-sm-4 control-label">{{ __('Register date end') }}<span class="text-danger">*</span></label>
                                         <div class="col-sm-12">
                                            <input type="date" name="reg_date_end" class="form-control">
                                          </div> 
                                        </div>
                                        
                                        
                                        <div class="col-md-3">
                                        <label class="col-sm-4 control-label">{{ __('Bind Date from') }}<span class="text-danger">*</span></label>
                                         <div class="col-sm-12">
                                            <input type="date" name="bind_date_str" class="form-control">
                                          </div> 
                                        </div>
                                        <div class="col-md-3">
                                        <label class="col-sm-4 control-label">{{ __('Bind Date end') }}<span class="text-danger">*</span></label>
                                         <div class="col-sm-12">
                                            <input type="date" name="bind_date_end" class="form-control">
                                          </div> 
                                        </div>
                                       
                                    </div>
                                    <div class="form-group row mr-8" >
                                        <div class="offset-sm-2 col-sm-10" style="margin-left: 0.667%;margin-top: 11px;">
                                            <button type="submit" class="btn btn-primary">{{ __('Search') }}</button>
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
                            <h3 class="card-title mt-1">{{ __('Search Results') }}</h3>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-striped table-bordered data_table">
                                <thead>
                                    <tr>
                                        <th>{{ __('#') }}</th>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Register phone') }}</th>
                                        <th>{{ __('Login Password ') }}</th>
                                        <th>{{ __('Register date') }}</th>
                                        <th>{{ __('Bind Date') }}</th>
                                        <th>{{ __('User Account(ID)') }}</th>
                                        <th>{{ __('Sub Company') }}</th>
                                        <th>{{ __('Account Status') }}</th>
                                        <!--<th>{{ __('Operating') }}</th>-->
                                      
                                    </tr>
                                </thead>
                                <tbody id="myTable">
                                    @foreach($bind_user as $index =>$value)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$value->name}}</td>    
                                        <td>{{$value->phone}}</td>
                                        <td>XXXXXXXX</td>
                                        <td>{{date('Y-m-d', strtotime($value->created_at))}}</td>
                                        <td>{{date('Y-m-d', strtotime($value->bind_date))}}</td>
                                        <td><a class="details" data-toggle="modal" data-target="#myuser_model{{$value->id}}" >{{$value->uniq_id}}</a></td>
                                        <td>{{App\SubCompany::find($value->sub_company)->company_name}}</td>
                                        <td><?php 
                                         if($value->user_status == 0)
                                         {
                                            $status = "<b class='badge badge-warning'>Normal</b>"; 
                                         }else
                                         {
                                             $status = "<b class='badge badge-success'>Disabled</b>";
                                         }
                                         echo $status;?></td>
                                      
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
			name: `user_disable.xlsx`, // fileName you could use any name
			sheet: {
			  name: 'Sheet 1' // sheetName
			}
		  });
		}
	</script>
