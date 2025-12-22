@extends('admin.layout')
<script src="https://telco.mbt.com.mm/assets/admin/plugins/data-table/cdn/jquery.min.js"></script>
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ __('User Notification') }} </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard', app()->getLocale()) }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item">{{ __('User Notification') }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
             
         <div class="row">
            
        <!--<div class="col-md-12">-->
        <!--        <div class="card card-primary card-outline " style="border-radius:0px!important;">-->
        <!--                <div class="card-header">-->
        <!--                    <h1 class="card-title mt-1">{{ __('Search Conditions') }}</h1>-->
        <!--                 </div>-->
        <!--                <div class="card-body">-->
        <!--                   <div class="row">-->
        <!--                      <div class="col-md-3">-->
        <!--                        <label class="col-sm-4 control-label">{{ __('Sub Company') }}<span class="text-danger">*</span></label>-->
        <!--                         <div class="col-sm-12">-->
        <!--                             <select class="form-control lang shubham" id="myInput_change" name="sub_com_id" >-->
        <!--                               <option value="" selected disabled  >--Select Sub Company--</option>-->
        <!--                               <option value="SMD WebTech"  >SMD WebTech</option>-->
        <!--                               <option value="MBT"  >MBT</option>-->
        <!--                             </select>-->
        <!--                          </div> -->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>    -->
        </div>   
        
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title mt-1">{{ __('Send notification to single customer') }}</h3>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                           <table id="example" class="display nowrap  table-striped table-bordered">
                                <thead>
                                   <tr>
                                            <th>{{__('ID')}}</th>
                                            <th>{{__('Device Detail')}}</th>
                                            <th>{{__('Device OS')}}</th>
                                            <th>{{__('User Info')}}</th>
                                            <th>{{__('Status')}}</th>
                                            <th>{{__('Action')}}</th>
                                        </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                                    <td>1</td>
                                                    <td>
                                                        <strong>Device Type: </strong>
                                                                                                                    Android
                                                                                                                <br>
                                                        <strong>Manufacturer: </strong>Xiaomi
                                                        <br>

                                                        <strong>Device Model: </strong>Redmi 7A
                                                        <br>
                                                        <strong>Register Date: </strong>23/08/2021

                                                    </td>

                                                    <td>10</td>

                                                    <td> </td>

                                                    <td>
                                                                <a href="" class="method-status">
                                                                In Active
                                                            </a>
                                                                                                                &nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;
                                                                                                                    <span class="label label-success">
                                                                Active
                                                            </span>
                                                                                                            </td>
                                                    <td>
                                                        <a data-toggle="modal" style="color:white;cursor:pointer;" data-target="#myModal" data-placement="bottom" title="Send Notification"  class="badge bg-light-blue btn btn-primary">Send</a>
                                                    </td>
                                                </tr>
                                                 <tr>
                                                    <td>2</td>
                                                    <td>
                                                        <strong>Device Type: </strong>
                                                                                                                    Android
                                                                                                                <br>
                                                        <strong>Manufacturer: </strong>samsung
                                                        <br>

                                                        <strong>Device Model: </strong>SM-M205F
                                                        <br>
                                                        <strong>Register Date: </strong>23/08/2021

                                                    </td>

                                                    <td>10</td>

                                                    <td>agent nang</td>

                                                    <td>
                                                                                <a href="" class="method-status">
                                                                In Active
                                                            </a>
                                                                                                                &nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;
                                                                                                                    <span class="label label-success">
                                                                Active
                                                            </span>
                                                                                                            </td>
                                                    <td>
                                                        <a data-toggle="modal" style="color:white;cursor:pointer;" data-target="#myModal" data-placement="bottom" title="Send Notification"  class="badge bg-light-blue btn btn-primary">Send</a>
                                                    </td>
                                                </tr>
                                                                                            <tr>
                                                    <td>3</td>
                                                    <td>
                                                        <strong>Device Type: </strong>
                                                                                                                    Android
                                                                                                                <br>
                                                        <strong>Manufacturer: </strong>Xiaomi
                                                        <br>

                                                        <strong>Device Model: </strong>Redmi 7
                                                        <br>
                                                        <strong>Register Date: </strong>23/08/2021

                                                    </td>

                                                    <td>9</td>

                                                    <td>nang1 miss</td>

                                                    <td>
                                                                                                                    <a href="" class="method-status">
                                                                In Active
                                                            </a>
                                                                                                                &nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;
                                                                                                                    <span class="label label-success">
                                                                Active
                                                            </span>
                                                                                                            </td>
                                                    <td>
                                                        <a  data-toggle="modal" style="color:white;cursor:pointer;" data-target="#myModal"  data-placement="bottom" title="Send Notification"  class="badge bg-light-blue btn btn-primary">Send</a>
                                                    </td>
                                                </tr>
                                                <div class="modal" id="myModal">
                                          <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                        
                                              <!-- Modal Header -->
                                              <div class="modal-header">
                                                <h4 class="modal-title">Send Notification</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                              </div>
                                        
                                              <!-- Modal body -->
                                              <div class="modal-body">
                                            <form action="" method="post" enctype="multipart/form-data" >
                                                @csrf
                                               <div class="row">
                                                <div class="col-md-6">
                                                <label class="col-sm-4 control-label">{{ __('Username') }}<span class="text-danger">*</span></label>
                                                 <div class="col-sm-12">
                                                     <input type="text" name="edit_banner_title"  value="Nirbhay" required placeholder="Enter Notification Title" value="" class="form-control" >
                                                  </div> 
                                                </div>
                                                <div class="col-md-6">
                                                <label class="col-sm-4 control-label">{{ __('Title') }}<span class="text-danger">*</span></label>
                                                 <div class="col-sm-12">
                                                     <input type="text" name="edit_banner_title"  required placeholder="Enter Notification Title" value="" class="form-control" >
                                                  </div> 
                                                </div>
                                                  <div class="col-md-6">
                                                <label class="col-sm-4 control-label">{{ __('Message') }}<span class="text-danger">*</span></label>
                                                 <div class="col-sm-12">
                                                    <textarea class="form-control" rows="3" name="" placeholder="Enter Notification Message" ></textarea>
                                                  </div> 
                                                </div>
                                                 <div class="col-md-6">
                                                <label class="col-sm-4 control-label">{{ __('image') }}<span class="text-danger">*</span></label>
                                                <div class="col-sm-12">
                                                     <input type="file" name="edit_upload_banner"  class="form-control" >
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

  