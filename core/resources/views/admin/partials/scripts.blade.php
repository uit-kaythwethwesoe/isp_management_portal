<!-- jQuery 3 -->
<script src="{{ asset('assets/admin/js/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Overlay Scrollbars js -->
<script src="{{ asset('assets/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- Sweetalert2 js -->
<script src="{{ asset('assets/admin/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- Bootstrap Colorpicker js -->
<script src="{{ asset('assets/admin/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<!-- Moment js -->
<script src="{{ asset('assets/admin/plugins/moment/moment.min.js') }}"></script>
<!-- Bootstrap Tagsinput js -->
<script src="{{ asset('assets/admin/plugins/bootstrap-taginput/bootstrap-tagsinput.min.js') }}"></script>
<!-- Bs-custom-file-input js -->
<script src="{{ asset('assets/admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<!-- Bootstrap-datepicker js -->
<script src="{{ asset('assets/admin/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<!-- Bootstrap-Iconpicker js -->
<script src="{{ asset('assets/admin/plugins/bootstrap-iconpicker/bootstrap-iconpicker.bundle.min.js') }}"></script>
<!-- Bootstrap-Switch js -->
<script src="{{ asset('assets/admin/plugins/bootstrap-switch/bootstrap-switch.min.js') }}"></script>
<!-- Select2 js -->
<script src="{{ asset('assets/admin/plugins/select2/select2.full.min.js') }}"></script>
<!-- Summernote js -->
<script src="{{ asset('assets/admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- DataTable js -->
<!--<script src="{{ asset('assets/admin/plugins/data-table/jquery.dataTables.min.js') }}"></script>-->
<!--<script src="{{ asset('assets/admin/plugins/data-table/dataTables.bootstrap4.min.js') }}"></script>-->
<!--<script src="{{ asset('assets/admin/plugins/data-table/dataTables.responsive.min.js') }}"></script>-->
<!--<script src="{{ asset('assets/admin/plugins/data-table/responsive.bootstrap4.min.js') }}"></script>-->
<!--<script src="{{ asset('assets/admin/plugins/data-table/dataTables.buttons.min.js') }}"></script>-->
<!--<script src="{{ asset('assets/admin/plugins/data-table/buttons.bootstrap4.min.js') }}"></script>-->



 <link rel="stylesheet" href="https://telco.mbt.com.mm/assets/admin/plugins/data-table/cdn/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://telco.mbt.com.mm/assets/admin/plugins/data-table/cdn/buttons.dataTables.min.css">
    
<!--<script src="https://code.jquery.com/jquery-3.5.1.js"></script>-->

 
    <script src="https://telco.mbt.com.mm/assets/admin/plugins/data-table/cdn/dataTables.bootstrap4.min.js"></script>
    <script src="https://telco.mbt.com.mm/assets/admin/plugins/data-table/cdn/jquery.dataTables.min.js
    "></script>
    <script src="https://telco.mbt.com.mm/assets/admin/plugins/data-table/cdn/dataTables.buttons.min.js
    "></script>
    <script src="https://telco.mbt.com.mm/assets/admin/plugins/data-table/cdn/jszip.min.js
    "></script>
    <script src="https://telco.mbt.com.mm/assets/admin/plugins/data-table/cdn/pdfmake.min.js
    "></script>
    <script src="https://telco.mbt.com.mm/assets/admin/plugins/data-table/cdn/buttons.print.min.js
    "></script>
    <script src="https://telco.mbt.com.mm/assets/admin/plugins/data-table/cdn/vfs_fonts.js
    "></script><script src="https://telco.mbt.com.mm/assets/admin/plugins/data-table/cdn/buttons.html5.min.js"></script>



<script>
 	$('.alert').fadeIn().delay(3000).fadeOut();
 	</script>
 
 <style>
 	    .card-body {
                    -ms-flex: 1 1 auto;
                    flex: 1 1 auto;
                    padding: 1.25rem;
                    width: 100%;
                    overflow: scroll;
                }
 	</style>
@yield('script')

<style>
    .dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
    color: #fff !important;
    border: 1px solid #979797;
    background-color: white;
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, white), color-stop(100%, #dcdcdc));
    background: -webkit-linear-gradient(top, white 0%, #dcdcdc 100%);
   background: linear-gradient(to bottom, #007bff 0%, #007bff 100%)!important;  
</style>

<style>
   .buttons-html5{
        position: relative !important;
        float: left !important;
        background-color: #28a745 !important;
        border-color: #28a745 !important;
        box-shadow: none !important;
        color: white!important;
}
</style>
    
 <script type="text/javascript">
$(document).ready(function() {
var today = new Date();
var datetime= moment().format("DD/MM/YYYY");
var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
var dateTime = datetime+' '+time;

    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: "" + dateTime + "-User Query  Payment Record"
            },
            {
                extend: 'pdfHtml5',
                title: "" + dateTime + "-User Query Payment Record"
            }
        ]
    } );
} );
</script>

 <script type="text/javascript">
$(document).ready(function() {
var today = new Date();
var datetime= moment().format("DD/MM/YYYY");

var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
var dateTime = datetime+' '+time;

    $('#faultquery').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: "" + dateTime + "-User Fault Report"
            },
            {
                extend: 'pdfHtml5',
                title: "" + dateTime + "-User Fault Report"
            }
        ]
    } );
} );
</script>

<script type="text/javascript">
$(document).ready(function() {
var today = new Date();
var datetime= moment().format("DD/MM/YYYY");

var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
var dateTime = datetime+' '+time;

    $('#installquery').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: "" + dateTime + "-Apply Install Record"
            },
            {
                extend: 'pdfHtml5',
                title: "" + dateTime + "-Apply Install Record"
            }
        ]
    } );
} );
</script>

<script type="text/javascript">
$(document).ready(function() {
var today = new Date();
var datetime= moment().format("DD/MM/YYYY");

var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
var dateTime = datetime+' '+time;

    $('#Marketing_Information').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: "" + dateTime + "-Marketing Information"
            },
            {
                extend: 'pdfHtml5',
                title: "" + dateTime + "-Marketing Information"
            }
        ]
    } );
} );
</script>


<script type="text/javascript">
$(document).ready(function() {
var today = new Date();
var datetime= moment().format("DD/MM/YYYY");

var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
var dateTime = datetime+' '+time;

    $('#user_notificatio').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: "" + dateTime + "-User Notification"
            },
            {
                extend: 'pdfHtml5',
                title: "" + dateTime + "-User Notification"
            }
        ]
    } );
} );
</script>

<script type="text/javascript">
$(document).ready(function() {
var today = new Date();
var datetime= moment().format("DD/MM/YYYY");

var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
var dateTime = datetime+' '+time;

    $('#user_query').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: "" + dateTime + "-User Query"
            },
            {
                extend: 'pdfHtml5',
                title: "" + dateTime + "-User Query"
            }
        ]
    } );
} );
</script>

<script type="text/javascript">
$(document).ready(function() {
var today = new Date();
var datetime= moment().format("DD/MM/YYYY");

var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
var dateTime = datetime+' '+time;

    $('#bind_user_query').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: "" + dateTime + "-Bind User Query"
            },
            {
                extend: 'pdfHtml5',
                title: "" + dateTime + "-Bind User Query"
            }
        ]
    } );
} );
</script>

<script type="text/javascript">
$(document).ready(function() {
var today = new Date();
var datetime= moment().format("DD/MM/YYYY");

var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
var dateTime = datetime+' '+time;

    $('#updateusers').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: "" + dateTime + "-User Update"
            },
            {
                extend: 'pdfHtml5',
                title: "" + dateTime + "-User Update"
            }
        ]
    } );
} );
</script>


<script type="text/javascript">
$(document).ready(function() {
var today = new Date();
var datetime= moment().format("DD/MM/YYYY");

var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
var dateTime = datetime+' '+time;

    $('#language_file').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: "" + dateTime + "-Language"
            },
            {
                extend: 'pdfHtml5',
                title: "" + dateTime + "-Language"
            }
        ]
    } );
} );
</script>


<script type="text/javascript">
$(document).ready(function() {
var today = new Date();
var datetime= moment().format("DD/MM/YYYY");

var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
var dateTime = datetime+' '+time;

    $('#search_bind_user').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: "" + dateTime + "-Bind User"
            },
            {
                extend: 'pdfHtml5',
                title: "" + dateTime + "Bind User"
            }
        ]
    } );
} );
</script>

    
<!-- AdminLTE App -->
<script src="{{ asset('assets/admin/js/adminlte.min.js') }}"></script>
<!-- Custom js -->
<script src="{{ asset('assets/admin/js/custom.js') }}"></script>







