@extends('admin.layout')
<script src="https://telco.mbt.com.mm/assets/admin/plugins/data-table/cdn/jquery.min.js"></script>
<!--<script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>-->

@section('content')
 <style>
           #user_query_filter, #user_query_info, #user_query_paginate,.buttons-excel{
            display: none !important;
         }
         .card-back{
             float:right;
         }
        
    </style>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ __('User Payment Record') }} </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard',app()->getLocale()) }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
                        <!--<li class="breadcrumb-item"><a href="{{ route('admin.get_bind_payment_user',app()->getLocale()) }}">{{ __('Payment User') }}</a></li>-->
                        <li class="breadcrumb-item">{{ __('Payment Query') }}</li>
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
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title mt-1">{{ __('Payment Query Lists') }}</h3>
                           <div class="card-back" >
                                <a href="{{ route('admin.export_payment_query_excel',app()->getLocale()) }}">
                             <button class="btn btn-success">Excel</button>
                           </a>
                           <a class="btn btn-danger"  href="{{ route('admin.payment_query',app()->getLocale()) }}" role="button">Back</a>

                        </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <div id="demo" class="display">
                           <table id="example" class="display nowrap  table-striped table-bordered ">
                                <thead>
                                    <tr>
                                        <th>{{ __('#') }}</th>
                                        <th>{{ __('Register phone') }}</th>
                                        <th>{{ __('User Account ID') }}</th>
                                        <th>{{ __('Sub Company') }}</th>
                                        <!--<th>{{ __('Expiry Date') }}</th>-->
                                        <th>{{ __('Pay date') }}</th>
                                        <th>{{ __('Pay amount') }}</th>
                                        <th>{{ __('Install Fee') }}</th>
                                        <th>{{ __('Invoice-number') }}</th>
                                        <th>{{ __('Order-number') }}</th>
                                        <th>{{ __('Begin-date') }}</th>
                                        <th>{{ __('Expire-time') }}</th>
                                        <th>{{ __('Pay-Method') }}</th>
                                        <th>{{ __('Pay Result') }}</th>
                                    </tr>
                                </thead>
                                <tbody id="myTable"> @php $i = 1 ; @endphp
                                    @foreach($payment as $index=>$value)
                                    
                                    @php 
                                        if($value->payment_method==1)
                                        { 
                                        echo "";
                                        @endphp
                                        @php 
                                        }
                                        else
                                        { 
                                        @endphp
                                         <tr>
                                        <td><?php  echo $i;?></td>
                                        <td>{{$value->phone??'Not Updated'}}</td>
                                        <td><a class="details" href="{{route('admin.payment_user_detail',[app()->getLocale(),$value->user_id])}}">{{$value->payment_user_name}}</a></td> 
                                        <td>{{App\SubCompany::find($value->sub_com_id)->company_name??''}}</td>
                                        <!--<td>{{$value->pack_expiery_date}}??''</td>-->
                                        <td>{{$value->trans_date}}</td>
                                        <td>{{$value->total_amt??'NA'}} Ks</td>
                                        <td style="text-transform: uppercase;">
                                            <?php 
                                                $user_name    = $value->payment_user_name;
                                                $data         = "access_token={$access_token}&user_name={$user_name}";
                                                $url          = "api/v1/user/view?".$data;; 
                                                
                                                $mainUrl = $base_url.$url;
                                                $headerArray =array("Content-type:application/json","Accept:application/json");
                                                $ch = curl_init();
                                                curl_setopt($ch, CURLOPT_URL, $mainUrl);
                                                curl_setopt($ch, CURLOPT_POST, 0); 
                                                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
                                                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
                                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                                curl_setopt($ch,CURLOPT_HTTPHEADER,$headerArray);
                                                curl_setopt($ch, CURLOPT_TIMEOUT, 1000);
                                                $output = curl_exec($ch);
                                                curl_close($ch);
                                                $decode       = json_decode($output,true);
                                                if(!empty($decode['data']['Installation_cost'])){
                                                    $installation_cost = $decode['data']['Installation_cost'];
                                                }else{
                                                    $installation_cost = 'N/A';
                                                }
                                                
                                                echo $installation_cost;
                                            ?>
                                        </td>
                                        <td>{{$value->invoice_no??'NA'}} </ td>
                                        <td>{{$value->order_id??'NA'}}</ td>
                                        <td>{{$value->begin_date??'NA'}}</ td>
                                        <td>
                                            @if($value->expire_date == 'NaN-NaN-NaN 23:00:00')
                                                <?php 
                                                    $user_name    = $value->payment_user_name;
                                                    $data         = "access_token={$access_token}&user_name={$user_name}";
                                                    $url          = "api/v1/package/users-packages?".$data; 
                                                    
                                                    $mainUrl = $base_url.$url;
                                                    $headerArray =array("Content-type:application/json","Accept:application/json");
                                                    $ch = curl_init();
                                                    curl_setopt($ch, CURLOPT_URL, $mainUrl);
                                                    curl_setopt($ch, CURLOPT_POST, 0); 
                                                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
                                                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
                                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                                    curl_setopt($ch,CURLOPT_HTTPHEADER,$headerArray);
                                                    curl_setopt($ch, CURLOPT_TIMEOUT, 1000);
                                                    $output = curl_exec($ch);
                                                    curl_close($ch);
                                                    $decode       = json_decode($output,true);
                                                    if(!empty($decode['data'][0]['package'])){
                                                        $total_pack = count($decode['data'][0]['package']);
                                                        $exp_num = $total_pack-1;
                                                        $exp_time = $decode['data'][0]['package'][$exp_num]['valid_day'];
                                                    }else{
                                                        $exp_time = '0';
                                                    }
                                                    
                                                    $exp_date = date('Y-m-d h:i:s', strtotime($value->begin_date. ' + '.$exp_time.' days'));
                                                ?>
                                                {{$exp_date}}
                                            @else
                                                {{$value->expire_date??''}}
                                            @endif
                                        </td>
                                        <td>{{App\PaymentGatewey::whereIn('id', [8,9,10,11])->find($value->payment_method)->title??'NA'}}</td>
                                        <td>@php if($value->admin_status==1) { echo "Success"; } elseif($value->admin_status==2) {echo "Fail"; } elseif($value->admin_status==3) { echo "Cancel";} elseif($value->admin_status==4) { echo "Pending";}@endphp  </td>
                                       
                                        @php
                                        }
                                        @endphp
                                        </tr>
                                       
                                        
                                        <div class="modal" id="myModal">
                                          <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                        
                                              <!-- Modal Header -->
                                              <div class="modal-header">
                                                <h4 class="modal-title">Query From {{$value->payment_user_name}}</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                              </div>
                                        
                                              <!-- Modal body -->
                                              <div class="modal-body">
                                            <form action="{{route('admin.update_payment_query',app()->getLocale())}}" method="post" >
                                                @csrf
                                                <input type="hidden" name="query_id" value="{{$value->id}}">
                                               <div class="row">
                                                <div class="col-md-6">
                                                <label class="col-sm-4 control-label">{{ __('Username') }}<span class="text-danger">*</span></label>
                                                 <div class="col-sm-12">
                                                     <input type="text" name="username" readonly value="{{$value->payment_user_name}}" class="form-control" >
                                                    
                                                  </div> 
                                                </div>
                                                <div class="col-md-6">
                                                <label class="col-sm-4 control-label">{{ __('Sub Company') }}<span class="text-danger">*</span></label>
                                                 <div class="col-sm-12"> 
                                                      <input type="text" name="sub_com_id" readonly value="{{App\SubCompany::find($value->sub_com_id)->company_name??''}}" class="form-control" >
                                                  </div> 
                                                </div>
                                                 <div class="col-md-6">
                                                <label class="col-sm-4 control-label">{{ __('Pay Method ') }}<span class="text-danger">*</span></label>
                                                 <div class="col-sm-12">
                                                    <input type="text" name="pay_method" readonly value="{{$value->payment_method}}" class="form-control" >
                                                  </div> 
                                                </div>
                                                <div class="col-md-6">
                                                <label class="col-sm-4 control-label">{{ __('Invoice-number') }}<span class="text-danger">*</span></label>
                                                 <div class="col-sm-12">
                                                     <input type="text" name="invoice_number" readonly value="{{$value->invoice_no}}" class="form-control" >
                                                  </div> 
                                                </div>
                                                <div class="col-md-6">
                                                <label class="col-sm-4 control-label">{{ __('Transaction ID') }}<span class="text-danger">*</span></label>
                                                 <div class="col-sm-12">
                                                     <input type="text" name="transaction_id" readonly value="{{$value->transaction_id}}" class="form-control" >
                                                  </div> 
                                                </div>
                                                 <div class="col-md-6">
                                                <label class="col-sm-4 control-label">{{ __('Total Amount') }}<span class="text-danger">*</span></label>
                                                 <div class="col-sm-12">
                                                     <input type="text" name="amount" readonly value="{{$value->total_amt}} Ks" class="form-control" >
                                                  </div> 
                                                </div>
                                                <div class="col-md-6">
                                                <label class="col-sm-4 control-label">{{ __('Payment Date') }}<span class="text-danger">*</span></label>
                                                 <div class="col-sm-12">
                                                     <input type="text" name="pay_date" readonly value="{{$value->trans_date}}" class="form-control" >
                                                  </div> 
                                                </div>
                                                <div class="col-md-6">
                                                <label class="col-sm-4 control-label">{{ __('Payment Status') }}<span class="text-danger">*</span></label>
                                                 <div class="col-sm-12">
                                                   
                                                   
                                                  </div> 
                                                </div>
                                                </div>
                                              </div>
                                            <!-- Modal footer -->
                                              <div class="modal-footer">
                                                <button type="submit" class="btn btn-success" value="Submit" name="Submit">Submit</button>
                                              </div>
                                          </form>
                                            </div>
                                          </div>
                                        </div>
                                    </tr>
                                     <?php 
                                     
                                     $i++; ?>
                                    @endforeach
                              </tbody>
                            </table>
                            <h4>Total : {{ $total_pay }} Ks</h4>
                                                        {{  $payment->appends($_GET)->links()  }}

                             </div>
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
		$(".toggle").slideToggle('slow');
	   });
	 });
  </script>
<script>
	 function exportReportToExcel() {
		  let table = document.getElementsByTagName("table"); // you can use document.getElementById('tableId') as well by providing id to the table tag
		  TableToExcel.convert(table[0], { // html code may contain multiple tables so here we are refering to 1st table tag
			name: `payment_query.xlsx`, // fileName you could use any name
			sheet: {
			  name: 'Sheet 1' // sheetName
			}
		  });
		}
	</script>
    <script>
    $(document).ready(function(){
       $(".shubham").on("change", function() {
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
          $("#shubham").on("keyup", function() {
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
        

  
  
<!--<script>-->
<!--	 function exportReportToExcel() {-->
<!--		  let table = document.getElementsByTagName("table"); // you can use document.getElementById('tableId') as well by providing id to the table tag-->
<!--		  TableToExcel.convert(table[1], { // html code may contain multiple tables so here we are refering to 1st table tag-->
<!--			name: `payment_query.xlsx`, // fileName you could use any name-->
<!--			sheet: {-->
<!--			  name: 'Sheet 1' // sheetName-->
<!--			}-->
<!--		  });-->
<!--		}-->
<!--</script>-->
  <script>
	 $(document).ready(function(){
	  $('.toggle').hide();
	   $(".collapsed").click(function(){
		$(".toggle").slideToggle('slow');
	   });
	 });
  </script>
