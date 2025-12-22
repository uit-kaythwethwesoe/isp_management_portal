<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ $setting->website_title }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- Favicon -->
	<link rel="shortcut icon" href="{{  asset('assets/front/img/'.$setting->fav_icon) }}" type="image/png">
  @includeif('admin.partials.styles')
  <script src="https://telco.mbt.com.mm/assets/front/js/jquery.min.js"></script>
  
  <link rel="stylesheet" href="https://telco.mbt.com.mm/assets/front/css/font-awesome.min.css">

 
<style>
#pageloader
{
  background: rgba( 255, 255, 255, 0.8 );
  display:none;
  height: 100%;
  position: fixed;
  width: 100%;
  z-index: 9999;
}

.modal-content{
    border: 6px solid #003e80!important;
}

#pageloader img
{
    left: 15%;
    margin-left: -32px;
    margin-top: -32px;
    position: absolute;
}

/*body {*/
/*  margin: 2rem 0rem;  */
/*}*/

.alert { margin-left: 1.2%;}

.fas fa-bell{
    height: 0px;
    border-radius: 68%;
    border: 3px solid #2c3e50;
    background: #2c3e50;
    padding: 6px 7px 23px;
    border-color: yellow;
}

.fa-bell:before {
    content: "\f0f3";
    color: white;
}
</style>
</head>

<body>
  
<div class="wrapper">

    @include('admin.partials.top-navbar')
    
    @include('admin.partials.side-navbar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!--<div id="pageloader">-->
      <!--     <img src="https://telco.mbt.com.mm/assets/loader.gif" alt="processing..." />-->
      <!--  </div>-->
      @yield('content')
  </div>
  <!-- /.content-wrapper -->

  @include('admin.partials.footer')

</div>
<!-- ./wrapper -->
<input type="hidden" id="main_url" value="{{ route('front.index') }}">
@includeif('admin.partials.scripts')

</body>
</html>
