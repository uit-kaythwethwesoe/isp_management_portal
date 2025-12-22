<?php
   $lang_code = $currentLang->code;
   $D = json_decode(json_encode(Auth::guard('admin')->user()->get_role()),true);
   $arr = [];
   foreach($D as $v)
   {
     $arr[] = $v['permission_id'];
   }
   ?>
@extends('admin.layout')
<script src="https://telco.mbt.com.mm/assets/front/js/Chart.min.js"></script>
@section('content')
<!-- Content Header (Page header) -->


<?php
   
  $users= Auth()->guard('admin')->user()->id;
   if($users==1) 
   
   { 
    ?>
    


<div class="content-header">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12">
            <h1 class="m-0 text-dark">{{ __('Welcome Back') }} {{ Auth()->guard('admin')->user()->username }} ! </h1>
            <b><?php echo date("l jS \of F Y ");?></b><small style="cursor:pointer;"id="show">{{ __('Click For See Time') }}</small>
            <div class="watch">
               <center>
                  <canvas id="canvas" width="200" height="200"></canvas>
               </center>
            </div>
         </div>
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</div>

<!-- new-->

<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-gradient-info">
               <span class="info-box-icon"><i class="fas fa-user-plus"></i></span>
               <div class="info-box-content">
                  <span class="info-box-text">{{ __('New Signup Today') }}</span>
                  <?php $date= date('Y-m-d').' 00:00:00' ?>
                  <h4 class="info-box-number font-weight-normal"> <?php // $monthtoday = date('d'); ?>
                     <?php echo $subday= Db::table('users')->whereDate('created_at', $date)->count(); ?>
                  </h4>
               </div>
               <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
         </div>
         <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-gradient-success">
               <span class="info-box-icon"><i class="fas fa-users"></i></span>
               <div class="info-box-content">
                  <span class="info-box-text">{{ __('Total Signup User') }}</span>
                  <h4 class="info-box-number font-weight-normal"><?php echo  $subday= DB::table('users')->count(); ?></h4>
               </div>
               <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
         </div>
         <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-gradient-warning">
               <span class="info-box-icon"><i class="fas fa-user-plus"></i></span>
               <div class="info-box-content">
                  <span class="info-box-text">{{ __('New Bind Today') }}</span>
                  <h4 class="info-box-number font-weight-normal"> <?php echo $subday= DB::table('mbt_bind_user')->whereDate('created_at', $date)->count() ?></h4>
               </div>
               <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
         </div>
         <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-gradient-danger">
               <span class="info-box-icon"><i class="fas fa-users"></i></span>
               <div class="info-box-content">
                  <span class="info-box-text">{{ __('Total Bind User') }}</span>
                  <h4 class="info-box-number font-weight-normal"><?php echo  $subday= DB::table('mbt_bind_user')->count(); ?></h4>
               </div>
               <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
         </div>
        
      </div>
      <br>
      <div class="row">
         <div class="col-md-12">
            <div class="card card-primary card-outline" style="border-radius:0px!important;">
               <div class="card-header">
                  <ul style="font-size: 28px;">
                     <li>
                        <h1 class="m-0 text-dark" style="font-size: 36px;">{{ __('Financial Details') }}</h1>
                     </li>
                  </ul>
               </div>
               <div class="card-body">
                  <div class="row">
                     <div class="col-md-4">
                        <?php // $monthtoday = date('d'); ?>
                                          <?php $date= date('Y-m-d').' 00:00:00' ?>

                        <?php $subday= DB::table('payment_new')->whereDate('created_at', $date)->sum('total_amt'); ?>
                        <center>
                           <b class="m-0 text-dark" style="font-size: 18px;">{{ __('Pay Today') }} </b><br>
                           <td> <?php echo $subday;?> Ks</td>
                        </center>
                     </div>
                     <div class="col-md-4">
                        <?php $monthdate = date('m'); 
                           ?>
                        <?php $submonth= Db::table('payment_new')->whereMonth('created_at', $monthdate)->sum('total_amt'); ?>
                        <center>
                           <b class="m-0 text-dark" style="font-size: 18px;">{{ __('Pay Month') }}</b><br>
                           <td><?php echo $submonth;?>Ks</td>
                        </center>
                     </div>
                     <div class="col-md-4">
                        <center>
                           <b class="m-0 text-dark" style="font-size: 18px;">{{__('Pay Year')}}</b><br>
                           <?php $subyear= DB::table('payment_new')->whereYear('created_at', date('Y'))->sum('total_amt'); ?>
                           <?php  $count = DB::table('mbt_bind_user')
                              //                       //->select(DB::raw('count(*) as count'))
                              //                       //->where('read_status', '=', 0)
                              //                       ->sum('balance')
                                                     ?>
                           <td><?php echo $subyear; ?> Ks</td>
                        </center>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
     
      <!--<h1>Dummy graph working</h1>-->
      <div class="container">
         <div class="row">
            <div class="col-12 col-md-8 col-lg-12">
               <ul class="nav nav-pills">
                  <li class="nav-item">
                     <a class="nav-link " data-toggle="pill" href="#ostrich21" role="tab" aria-controls="pills-flamingo" aria-selected="false">2021</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#ostrich22" role="tab" aria-controls="pills-cuckoo" aria-selected="true">2022</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#ostrich23" role="tab" aria-controls="pills-ostrich" aria-selected="false">2023</a>
                  </li>
                  <?php $date=date('Y');  ?>
                 <?php 
                  
                  if($date==2024)
                  { ?>
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="pill" href="#ostrich24" role="tab" aria-controls="pills-tropicbird" aria-selected="false">2024</a>
                  </li>
                  <?php } ?>
                  <?php 
                  if($date==2025)
                      { ?>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#ostrich25" role="tab" aria-controls="pills-tropicbird" aria-selected="false">2025</a>
                  </li>
                  <?php } ?>
                 <?php 
                  if($date==2026)
                      { ?>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#ostrich26" role="tab" aria-controls="pills-tropicbird" aria-selected="false">2026</a>
                  </li>
                  <?php } ?>
                  
                  
               
               </ul>
               <div class="tab-content mt-12">
                  <div class="tab-pane" id="ostrich21" role="tabpanel" aria-labelledby="flamingo-tab">
                     <canvas id="myChart2021" style="height: 500px!important; background: #fff; padding: 20px;"></canvas>
                  </div>
                  <div class="tab-pane" id="ostrich22" role="tabpanel" aria-labelledby="profile-tab">
                     <canvas id="myChart2022" style="height: 500px!important; background: #fff; padding: 20px;"></canvas>
                  </div>
                  <div class="tab-pane" id="ostrich23" role="tabpanel" aria-labelledby="ostrich-tab">
                     <canvas id="myChart2023" style="height: 500px!important; background: #fff; padding: 20px;"></canvas>
                  </div>
                  <div class="tab-pane active" id="ostrich24" role="tabpanel" aria-labelledby="tropicbird-tab">
                     <canvas id="myChart2024" style="height: 500px!important; background: #fff; padding: 20px;"></canvas>
                  </div>
                  <div class="tab-pane" id="ostrich25" role="tabpanel" aria-labelledby="tropicbird-tab">
                     <canvas id="myChart2025" style="height: 500px!important; background: #fff; padding: 20px;"></canvas>
                  </div>
               </div>
            </div>
         </div>
        </div>
     
   </div>
   <!-- /.container-fluid -->
</div> 


 <?php } ?>
 
 
  @if(in_array("56", $arr) &&  in_array("56", $arr) )

<div class="content-header">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12">
            <h1 class="m-0 text-dark">{{ __('Welcome Back') }} {{ Auth()->guard('admin')->user()->username }} ! </h1>
            <b><?php echo date("l jS \of F Y ");?></b><small style="cursor:pointer;"id="show">{{ __('Click For See Time') }}</small>
            <div class="watch">
               <center>
                  <canvas id="canvas" width="200" height="200"></canvas>
               </center>
            </div>
         </div>
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</div>
@endif

<!-- /.content-header -->
<!-- Main content -->
<div class="content">
   <div class="container-fluid">
       @if(in_array("56", $arr))
      <div class="row">
         <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-gradient-info">
               <span class="info-box-icon"><i class="fas fa-user-plus"></i></span>
               <div class="info-box-content">
                  <span class="info-box-text">{{ __('New Signup Today') }}</span>
                  <?php $date= date('Y-m-d').' 00:00:00' ?>
                  <h4 class="info-box-number font-weight-normal"> <?php // $monthtoday = date('d'); ?>
                     <?php echo $subday= Db::table('users')->whereDate('created_at', $date)->count(); ?>
                  </h4>
               </div>
               <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
         </div>
         <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-gradient-success">
               <span class="info-box-icon"><i class="fas fa-users"></i></span>
               <div class="info-box-content">
                  <span class="info-box-text">{{ __('Total Signup User') }}</span>
                  <h4 class="info-box-number font-weight-normal"><?php echo  $subday= DB::table('users')->count(); ?></h4>
               </div>
               <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
         </div>
         <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-gradient-warning">
               <span class="info-box-icon"><i class="fas fa-user-plus"></i></span>
               <div class="info-box-content">
                  <span class="info-box-text">{{ __('New Bind Today') }}</span>
                  <h4 class="info-box-number font-weight-normal"> <?php echo $subday= DB::table('mbt_bind_user')->whereDate('created_at', $date)->count() ?></h4>
               </div>
               <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
         </div>
         <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-gradient-danger">
               <span class="info-box-icon"><i class="fas fa-users"></i></span>
               <div class="info-box-content">
                  <span class="info-box-text">{{ __('Total Bind User') }}</span>
                  <h4 class="info-box-number font-weight-normal"><?php echo  $subday= DB::table('mbt_bind_user')->count(); ?></h4>
               </div>
               <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
         </div>
         
      </div>
       @endif
      <br>
       @if(in_array("57", $arr))
      <div class="row">
         <div class="col-md-12">
            <div class="card card-primary card-outline" style="border-radius:0px!important;">
               <div class="card-header">
                  <ul style="font-size: 28px;">
                     <li>
                        <h1 class="m-0 text-dark" style="font-size: 36px;">{{ __('Financial Details') }}</h1>
                     </li>
                  </ul>
               </div>
               <div class="card-body">
                  <div class="row">
                     <div class="col-md-4">
                        <?php // $monthtoday = date('d'); ?>
                                          <?php $date= date('Y-m-d').' 00:00:00' ?>

                        <?php $subday= DB::table('payment_new')->whereDate('created_at', $date)->sum('total_amt'); ?>
                        <center>
                           <b class="m-0 text-dark" style="font-size: 18px;">{{ __('Pay Today') }} </b><br>
                           <td> <?php echo $subday;?> Ks</td>
                        </center>
                     </div>
                     <div class="col-md-4">
                        <?php $monthdate = date('m'); 
                           ?>
                        <?php $submonth= Db::table('payment_new')->whereMonth('created_at', $monthdate)->sum('total_amt'); ?>
                        <center>
                           <b class="m-0 text-dark" style="font-size: 18px;">{{ __('Pay Month') }}</b><br>
                           <td><?php echo $submonth;?>Ks</td>
                        </center>
                     </div>
                     <div class="col-md-4">
                        <center>
                           <b class="m-0 text-dark" style="font-size: 18px;">{{__('Pay Year')}}</b><br>
                           <?php $subyear= DB::table('payment_new')->whereYear('created_at', date('Y'))->sum('total_amt'); ?>
                           <?php  $count = DB::table('mbt_bind_user')
                              //                       //->select(DB::raw('count(*) as count'))
                              //                       //->where('read_status', '=', 0)
                              //                       ->sum('balance')
                                                     ?>
                           <td><?php echo $subyear; ?> Ks</td>
                        </center>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
     
      <!--<h1>Dummy  working</h1>-->
      <!--<div class="container">-->
      <!--   <div class="row">-->
      <!--      <div class="col-12 col-md-8 col-lg-12">-->
      <!--         <ul class="nav nav-pills">-->
      <!--            <li class="nav-item">-->
      <!--               <a class="nav-link" data-toggle="pill" href="#ostrich21" role="tab" aria-controls="pills-flamingo" aria-selected="true">2021</a>-->
      <!--            </li>-->
      <!--            <li class="nav-item">-->
      <!--              <a class="nav-link" data-toggle="pill" href="#ostrich22" role="tab" aria-controls="pills-cuckoo" aria-selected="false">2022</a>-->
      <!--            </li>-->
                 
                  
      <!--         </ul>-->
      <!--         <div class="tab-content mt-12">-->
      <!--            <div class="tab-pane " id="ostrich21" role="tabpanel" aria-labelledby="flamingo-tab">-->
      <!--               <canvas id="myChart2021" style="height: 500px!important; background: #fff; padding: 20px;"></canvas>-->
      <!--            </div>-->
      <!--            <div class="tab-pane" id="ostrich22" role="tabpanel" aria-labelledby="profile-tab">-->
      <!--               <canvas id="myChart2022" style="height: 500px!important; background: #fff; padding: 20px;"></canvas>-->
      <!--            </div>-->
      <!--            <div class="tab-pane" id="ostrich23" role="tabpanel" aria-labelledby="ostrich-tab">-->
      <!--               <canvas id="myChart2023" style="height: 500px!important; background: #fff; padding: 20px;"></canvas>-->
      <!--            </div>-->
      <!--            <div class="tab-pane active" id="ostrich24" role="tabpanel" aria-labelledby="tropicbird-tab">-->
      <!--               <canvas id="myChart2024" style="height: 500px!important; background: #fff; padding: 20px;"></canvas>-->
      <!--            </div>-->
      <!--            <div class="tab-pane" id="ostrich25" role="tabpanel" aria-labelledby="tropicbird-tab">-->
      <!--               <canvas id="myChart2025" style="height: 500px!important; background: #fff; padding: 20px;"></canvas>-->
      <!--            </div>-->
      <!--         </div>-->
      <!--      </div>-->
      <!--   </div>-->
      <!--  </div>-->
      @endif
   </div>
   <!-- /.container-fluid -->
</div> 


<!-- /.content -->
<script>
   window.onload = function () {
       //alert('sffds');  perspectiveUpIn
   $('#overlay').show();
   };
</script>
<script>
   var xValues = ["Jan", "Feb", "Mar", "Apr", "May","Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"];
   var yValues = [{{$current_data[0]}}, {{$current_data[1]}}, {{$current_data[2]}},{{$current_data[3]}},{{$current_data[4]}},{{$current_data[5]}},{{$current_data[6]}},{{$current_data[7]}},{{$current_data[8]}},{{$current_data[9]}},{{$current_data[10]}},{{$current_data[11]}}];
   var barColors = ["blue"];
   
   new Chart("myChart2021", {
     type: "bar",
     data: {
       labels: xValues,
       datasets: [{
         backgroundColor: 'blue',
         data: yValues
       }]
     },
     options: {
       legend: {display: false},
       title: {
         display: true,
         text: "Monthly income statistics"
       }
     }
   });
</script>
<!--2022-->
<script>
   var xValues = ["Jan", "Feb", "Mar", "Apr", "May","Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"];
   var yValues = [{{$current_next_year[0]}}, {{$current_next_year[1]}}, {{$current_next_year[2]}},{{$current_next_year[3]}},{{$current_next_year[4]}},{{$current_next_year[5]}},{{$current_next_year[6]}},{{$current_next_year[7]}},{{$current_next_year[8]}},{{$current_next_year[9]}},{{$current_next_year[10]}},{{$current_next_year[11]}}];
   var barColors = ["blue"];
   
   new Chart("myChart2022", {
     type: "bar",
     data: {
       labels: xValues,
       datasets: [{
         backgroundColor: barColors,
         data: yValues
       }]
     },
     options: {
       legend: {display: false},
       title: {
         display: true,
         text: "Monthly income statistics"
       }
     }
   });
</script>
<!--2022-->
<!--2023-->
<script>
   var xValues = ["Jan", "Feb", "Mar", "Apr", "May","Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"];
   var yValues = [{{$current_next_year23[0]}}, {{$current_next_year23[1]}}, {{$current_next_year23[2]}},{{$current_next_year23[3]}},{{$current_next_year23[4]}},{{$current_next_year23[5]}},{{$current_next_year23[6]}},{{$current_next_year23[7]}},{{$current_next_year23[8]}},{{$current_next_year23[9]}},{{$current_next_year23[10]}},{{$current_next_year23[11]}}];
   var barColors = ["blue"];
   
   new Chart("myChart2023", {
     type: "bar",
     data: {
       labels: xValues,
       datasets: [{
         backgroundColor: barColors,
         data: yValues
       }]
     },
     options: {
       legend: {display: false},
       title: {
         display: true,
         text: "Monthly income statistics"
       }
     }
   });
</script>
<!--2023-->
<!--2024-->
<script>
   var xValues = ["Jan", "Feb", "Mar", "Apr", "May","Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"];
   var yValues = [{{$current_next_year24[0]}}, {{$current_next_year24[1]}}, {{$current_next_year24[2]}},{{$current_next_year24[3]}},{{$current_next_year24[4]}},{{$current_next_year24[5]}},{{$current_next_year24[6]}},{{$current_next_year24[7]}},{{$current_next_year24[8]}},{{$current_next_year24[9]}},{{$current_next_year24[10]}},{{$current_next_year24[11]}}];
   var barColors = ["blue"];
   
   new Chart("myChart2024", {
     type: "bar",
     data: {
       labels: xValues,
       datasets: [{
         backgroundColor: barColors,
         data: yValues
       }]
     },
     options: {
       legend: {display: false},
       title: {
         display: true,
         text: "Monthly income statistics"
       }
     }
   });
</script>
<!--2024-->
<!--2025-->
<script>
   var xValues = ["Jan", "Feb", "Mar", "Apr", "May","Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"];
   var yValues = [{{$current_next_year25[0]}}, {{$current_next_year25[1]}}, {{$current_next_year25[2]}},{{$current_next_year25[3]}},{{$current_next_year25[4]}},{{$current_next_year25[5]}},{{$current_next_year25[6]}},{{$current_next_year25[7]}},{{$current_next_year25[8]}},{{$current_next_year25[9]}},{{$current_next_year25[10]}},{{$current_next_year25[11]}}];
   var barColors = ["blue"];
   
   new Chart("myChart2025", {
     type: "bar",
     data: {
       labels: xValues,
       datasets: [{
         backgroundColor: barColors,
         data: yValues
       }]
     },
     options: {
       legend: {display: false},
       title: {
         display: true,
         text: "Monthly income statistics"
       }
     }
   });
</script>
<!--2025-->
<script>
   $('#show').click('on',function(){
       $('.watch').slideToggle();
   });
   $('.watch').hide();
   var canvas = document.getElementById("canvas");
   var ctx = canvas.getContext("2d");
   var radius = canvas.height / 2;
   ctx.translate(radius, radius);
   radius = radius * 0.90
   setInterval(drawClock, 1000);
   
   function drawClock() {
     drawFace(ctx, radius);
     drawNumbers(ctx, radius);
     drawTime(ctx, radius);
   }
   
   function drawFace(ctx, radius) {
     var grad;
     ctx.beginPath();
     ctx.arc(0, 0, radius, 0, 2*Math.PI);
     ctx.fillStyle = 'white';
     ctx.fill();
     grad = ctx.createRadialGradient(0,0,radius*0.95, 0,0,radius*1.05);
     grad.addColorStop(0, '#333');
     grad.addColorStop(0.5, 'white');
     grad.addColorStop(1, '#333');
     ctx.strokeStyle = grad;
     ctx.lineWidth = radius*0.1;
     ctx.stroke();
     ctx.beginPath();
     ctx.arc(0, 0, radius*0.1, 0, 2*Math.PI);
     ctx.fillStyle = '#333';
     ctx.fill();
   }
   
   function drawNumbers(ctx, radius) {
     var ang;
     var num;
     ctx.font = radius*0.15 + "px arial";
     ctx.textBaseline="middle";
     ctx.textAlign="center";
     for(num = 1; num < 13; num++){
       ang = num * Math.PI / 6;
       ctx.rotate(ang);
       ctx.translate(0, -radius*0.85);
       ctx.rotate(-ang);
       ctx.fillText(num.toString(), 0, 0);
       ctx.rotate(ang);
       ctx.translate(0, radius*0.85);
       ctx.rotate(-ang);
     }
   }
   
   function drawTime(ctx, radius){
       var now = new Date();
       var hour = now.getHours();
       var minute = now.getMinutes();
       var second = now.getSeconds();
       //hour
       hour=hour%12;
       hour=(hour*Math.PI/6)+
       (minute*Math.PI/(6*60))+
       (second*Math.PI/(360*60));
       drawHand(ctx, hour, radius*0.5, radius*0.07);
       //minute
       minute=(minute*Math.PI/30)+(second*Math.PI/(30*60));
       drawHand(ctx, minute, radius*0.8, radius*0.07);
       // second
       second=(second*Math.PI/30);
       drawHand(ctx, second, radius*0.9, radius*0.02);
   }
   
   function drawHand(ctx, pos, length, width) {
       ctx.beginPath();
       ctx.lineWidth = width;
       ctx.lineCap = "round";
       ctx.moveTo(0,0);
       ctx.rotate(pos);
       ctx.lineTo(0, -length);
       ctx.stroke();
       ctx.rotate(-pos);
   }
</script>
@endsection