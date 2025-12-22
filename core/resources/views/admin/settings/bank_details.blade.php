@extends('admin.layout')

@section('content')

<style>
    .side-menu{
        background: #fff;
        padding: 10px;
        font-weight: bold;
        border-bottom: 2px solid #9e9e9e;
    }
    
    .side-menu a{
        color: #000 !important;
    }
    
    .active{
        background: #9e9e9e;
        padding: 10px;
        font-weight: bold;
    }
    
    .active a{
        color: #fff !important;
    }
</style>

<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{ __('Bank Settings') }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard',app()->getLocale()) }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
                    <li class="breadcrumb-item">{{ __('Bank Settings') }}</li>
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
                        <h3 class="card-title">{{ __('Update Bank Settings') }} </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="side-menu">
                                    <a href="#section-cbpay">CP Pay</a>
                                </div>
                                <div class="side-menu">
                                    <a href="#section-kbz">KBZ Pay</a>
                                </div>
                                <div class="side-menu">
                                    <a href="#section-aya">Aya Pay</a>
                                </div>
                                <div class="side-menu">
                                    <a href="#section-direct">KBZ Banking</a>
                                </div>
                                <div class="side-menu">
                                    <a href="#section-wavepay">Wave Pay</a>
                                </div>
                            </div>
                            
                            <div class="col-md-9">
                                <form class="form-horizontal" action="{{route('admin.bank.settings.store',app()->getLocale())}}" method="POST"  enctype="multipart/form-data">
                                    @csrf
                                    
                                    <div id="section-cbpay" class="tab-content">
                                        <div class="form-group row">
                                            <label for="type" class="col-sm-2 control-label">{{ __('Payment Type') }} 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="type" value="{{ $bank_details->type }}" placeholder="{{ __('Type') }}">
                                                @if ($errors->has('type'))
                                                <p class="text-danger"> {{ $errors->first('type') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="api_url" class="col-sm-2 control-label">{{ __('Base Url') }} 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="api_url" value="{{ $bank_details->api_url }}" placeholder="{{ __('Base Url') }}">
                                                @if ($errors->has('api_url'))
                                                <p class="text-danger"> {{ $errors->first('api_url') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="auth_token" class="col-sm-2 control-label">{{ __('Token') }} 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="auth_token" value="{{ $bank_details->auth_token }}" placeholder="{{ __('Token') }}">
                                                @if ($errors->has('auth_token'))
                                                <p class="text-danger"> {{ $errors->first('auth_token') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="ecommerce_id" class="col-sm-2 control-label">{{ __('Ecommerce Id') }} 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="ecommerce_id" value="{{ $bank_details->ecommerce_id }}" placeholder="{{ __('Ecommerce Id') }}">
                                                @if ($errors->has('ecommerce_id'))
                                                <p class="text-danger"> {{ $errors->first('ecommerce_id') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="mer_id" class="col-sm-2 control-label">{{ __('Merchant Id') }} 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="mer_id" value="{{ $bank_details->mer_id }}" placeholder="{{ __('Merchant Id') }}">
                                                @if ($errors->has('mer_id'))
                                                <p class="text-danger"> {{ $errors->first('mer_id') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="sub_mer_id" class="col-sm-2 control-label">{{ __('Sub Merchant Id') }} 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="sub_mer_id" value="{{ $bank_details->sub_mer_id }}" placeholder="{{ __('Sub Merchant Id') }}">
                                                @if ($errors->has('sub_mer_id'))
                                                <p class="text-danger"> {{ $errors->first('sub_mer_id') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="transaction_type" class="col-sm-2 control-label">{{ __('Transaction Type') }} 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="transaction_type" value="{{ $bank_details->transaction_type }}" placeholder="{{ __('Transaction Type') }}">
                                                @if ($errors->has('transaction_type'))
                                                <p class="text-danger"> {{ $errors->first('transaction_type') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="notifyurl" class="col-sm-2 control-label">{{ __('Notify URL') }} 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="notifyurl" value="{{ $bank_details->notifyurl }}" placeholder="{{ __('Notify URL') }}">
                                                @if ($errors->has('notifyurl'))
                                                <p class="text-danger"> {{ $errors->first('notifyurl') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="cb_redirect" class="col-sm-2 control-label">{{ __('Redirect URL') }} 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="cb_redirect" value="{{ $bank_details->cb_redirect }}" placeholder="{{ __('Redirect URL') }}">
                                                @if ($errors->has('cb_redirect'))
                                                <p class="text-danger"> {{ $errors->first('cb_redirect') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="cb_status" class="col-sm-2 control-label">{{ __('Status') }} 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="cb_status">
                                                    <option value="1" <?php if($bank_details->cb_status == 1){ echo 'selected'; } ?>>Sandbox</option>
                                                    <option value="2" <?php if($bank_details->cb_status == 2){ echo 'selected'; } ?>>Production</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="kbz_status" class="col-sm-2 control-label">{{ __('Payment Status') }} 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="cb_pay_status">
                                                    <option value="0" <?php if($cb_id->status == 0){ echo 'selected'; } ?>>Disabled</option>
                                                    <option value="1" <?php if($cb_id->status == 1){ echo 'selected'; } ?>>Enabled</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div id="section-kbz" class="tab-content">
                                        <div class="form-group row">
                                            <label for="kbz_type" class="col-sm-2 control-label">{{ __('Payment Type') }} 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="kbz_type" value="{{ $bank_details->kbz_type }}" placeholder="{{ __('Type') }}">
                                                @if ($errors->has('kbz_type'))
                                                <p class="text-danger"> {{ $errors->first('kbz_type') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="kbz_api_url" class="col-sm-2 control-label">{{ __('Base Url') }} 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="kbz_api_url" value="{{ $bank_details->kbz_api_url }}" placeholder="{{ __('Base Url') }}">
                                                @if ($errors->has('kbz_api_url'))
                                                <p class="text-danger"> {{ $errors->first('kbz_api_url') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="kbz_m_code" class="col-sm-2 control-label">{{ __('Merchant Id') }} 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="kbz_m_code" value="{{ $bank_details->kbz_m_code }}" placeholder="{{ __('Merchant Id') }}">
                                                @if ($errors->has('kbz_m_code'))
                                                <p class="text-danger"> {{ $errors->first('kbz_m_code') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="kbz_appid" class="col-sm-2 control-label">{{ __('App Id') }} 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="kbz_appid" value="{{ $bank_details->kbz_appid }}" placeholder="{{ __('App Id') }}">
                                                @if ($errors->has('kbz_appid'))
                                                <p class="text-danger"> {{ $errors->first('kbz_appid') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="kbz_key" class="col-sm-2 control-label">{{ __('Key') }} 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="kbz_key" value="{{ $bank_details->kbz_key }}" placeholder="{{ __('Key') }}">
                                                @if ($errors->has('kbz_key'))
                                                <p class="text-danger"> {{ $errors->first('kbz_key') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="kbz_trade_type" class="col-sm-2 control-label">{{ __('Trade Type') }} 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="kbz_trade_type" value="{{ $bank_details->kbz_trade_type }}" placeholder="{{ __('Trade Type') }}">
                                                @if ($errors->has('kbz_trade_type'))
                                                <p class="text-danger"> {{ $errors->first('kbz_trade_type') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="kbz_notifyurl" class="col-sm-2 control-label">{{ __('Notify URL') }} 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="kbz_notifyurl" value="{{ $bank_details->kbz_notifyurl }}" placeholder="{{ __('Notify URL') }}">
                                                @if ($errors->has('kbz_notifyurl'))
                                                <p class="text-danger"> {{ $errors->first('kbz_notifyurl') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="kbz_redirecct" class="col-sm-2 control-label">{{ __('Redirect URL') }} 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="kbz_redirecct" value="{{ $bank_details->kbz_redirecct }}" placeholder="{{ __('Redirect URL') }}">
                                                @if ($errors->has('kbz_redirecct'))
                                                <p class="text-danger"> {{ $errors->first('kbz_redirecct') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="kbz_version" class="col-sm-2 control-label">{{ __('Version') }} 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="kbz_version" value="{{ $bank_details->kbz_version }}" placeholder="{{ __('Version') }}">
                                                @if ($errors->has('kbz_version'))
                                                <p class="text-danger"> {{ $errors->first('kbz_version') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="kbz_status" class="col-sm-2 control-label">{{ __('Status') }} 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="kbz_status">
                                                    <option value="1" <?php if($bank_details->kbz_status == 1){ echo 'selected'; } ?>>Sandbox</option>
                                                    <option value="2" <?php if($bank_details->kbz_status == 2){ echo 'selected'; } ?>>Production</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="kbz_status" class="col-sm-2 control-label">{{ __('Payment Status') }} 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="kbz_pay_status">
                                                    <option value="0" <?php if($kbz_id->status == 0){ echo 'selected'; } ?>>Disabled</option>
                                                    <option value="1" <?php if($kbz_id->status == 1){ echo 'selected'; } ?>>Enabled</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div id="section-aya" class="tab-content">
                                        <div class="form-group row">
                                            <label for="aya_paytype" class="col-sm-2 control-label">{{ __('Payment Type') }} 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="aya_paytype" value="{{ $bank_details->aya_paytype }}" placeholder="{{ __('Type') }}">
                                                @if ($errors->has('aya_paytype'))
                                                <p class="text-danger"> {{ $errors->first('aya_paytype') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="aya_api_tokenurl" class="col-sm-2 control-label">{{ __('Token Url') }} 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="aya_api_tokenurl" value="{{ $bank_details->aya_api_tokenurl }}" placeholder="{{ __('Token Url') }}">
                                                @if ($errors->has('aya_api_tokenurl'))
                                                <p class="text-danger"> {{ $errors->first('aya_api_tokenurl') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="aya_consumer_key" class="col-sm-2 control-label">{{ __('Consumer Key') }} 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="aya_consumer_key" value="{{ $bank_details->aya_consumer_key }}" placeholder="{{ __('Consumer Key') }}">
                                                @if ($errors->has('aya_consumer_key'))
                                                <p class="text-danger"> {{ $errors->first('aya_consumer_key') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="aya_consumer_secret" class="col-sm-2 control-label">{{ __('Consumer Secret') }} 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="aya_consumer_secret" value="{{ $bank_details->aya_consumer_secret }}" placeholder="{{ __('Consumer Secret') }}">
                                                @if ($errors->has('aya_consumer_secret'))
                                                <p class="text-danger"> {{ $errors->first('aya_consumer_secret') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="aya_grant_type" class="col-sm-2 control-label">{{ __('Grant Type') }} 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="aya_grant_type" value="{{ $bank_details->aya_grant_type }}" placeholder="{{ __('Grant Type') }}">
                                                @if ($errors->has('aya_grant_type'))
                                                <p class="text-danger"> {{ $errors->first('aya_grant_type') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="aya_api_baseurl" class="col-sm-2 control-label">{{ __('Base Url') }} 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="aya_api_baseurl" value="{{ $bank_details->aya_api_baseurl }}" placeholder="{{ __('Base Url') }}">
                                                @if ($errors->has('aya_api_baseurl'))
                                                <p class="text-danger"> {{ $errors->first('aya_api_baseurl') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="aya_phone" class="col-sm-2 control-label">{{ __('Phone') }} 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="aya_phone" value="{{ $bank_details->aya_phone }}" placeholder="{{ __('Phone') }}">
                                                @if ($errors->has('aya_phone'))
                                                <p class="text-danger"> {{ $errors->first('aya_phone') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="aya_password" class="col-sm-2 control-label">{{ __('Password') }} 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" name="aya_password" value="{{ $bank_details->aya_password }}" placeholder="{{ __('Password') }}">
                                                @if ($errors->has('aya_password'))
                                                <p class="text-danger"> {{ $errors->first('aya_password') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="aya_enc_key" class="col-sm-2 control-label">{{ __('Encryption Key') }} 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="aya_enc_key" value="{{ $bank_details->aya_enc_key }}" placeholder="{{ __('Encryption Key') }}">
                                                @if ($errors->has('aya_enc_key'))
                                                <p class="text-danger"> {{ $errors->first('aya_enc_key') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="aya_status" class="col-sm-2 control-label">{{ __('Status') }} 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="aya_status">
                                                    <option value="1" <?php if($bank_details->aya_status == 1){ echo 'selected'; } ?>>Sandbox</option>
                                                    <option value="2" <?php if($bank_details->aya_status == 2){ echo 'selected'; } ?>>Production</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="kbz_status" class="col-sm-2 control-label">{{ __('Payment Status') }} 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="aya_pay_status">
                                                    <option value="0" <?php if($aya_id->status == 0){ echo 'selected'; } ?>>Disabled</option>
                                                    <option value="1" <?php if($aya_id->status == 1){ echo 'selected'; } ?>>Enabled</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div id="section-direct" class="tab-content">
                                        <div class="form-group row">
                                            <label for="direct_type" class="col-sm-2 control-label">{{ __('Payment Type') }} 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="direct_type" value="{{ $bank_details->direct_type }}" placeholder="{{ __('Type') }}">
                                                @if ($errors->has('direct_type'))
                                                <p class="text-danger"> {{ $errors->first('direct_type') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="direct_apiurl" class="col-sm-2 control-label">{{ __('Base Url') }} 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="direct_apiurl" value="{{ $bank_details->direct_apiurl }}" placeholder="{{ __('Base Url') }}">
                                                @if ($errors->has('direct_apiurl'))
                                                <p class="text-danger"> {{ $errors->first('direct_apiurl') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="direct_mcode" class="col-sm-2 control-label">{{ __('Merchant Id') }} 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="direct_mcode" value="{{ $bank_details->direct_mcode }}" placeholder="{{ __('Merchant Id') }}">
                                                @if ($errors->has('direct_mcode'))
                                                <p class="text-danger"> {{ $errors->first('direct_mcode') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="direct_key" class="col-sm-2 control-label">{{ __('Encryption Key') }} 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="direct_key" value="{{ $bank_details->direct_key }}" placeholder="{{ __('Encryption Key') }}">
                                                @if ($errors->has('direct_key'))
                                                <p class="text-danger"> {{ $errors->first('direct_key') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="direct_status" class="col-sm-2 control-label">{{ __('Status') }} 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="direct_status">
                                                    <option value="1" <?php if($bank_details->direct_status == 1){ echo 'selected'; } ?>>Sandbox</option>
                                                    <option value="2" <?php if($bank_details->direct_status == 2){ echo 'selected'; } ?>>Production</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="kbz_status" class="col-sm-2 control-label">{{ __('Payment Status') }} 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="direct_pay_status">
                                                    <option value="0" <?php if($direct_id->status == 0){ echo 'selected'; } ?>>Disabled</option>
                                                    <option value="1" <?php if($direct_id->status == 1){ echo 'selected'; } ?>>Enabled</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div id="section-wavepay" class="tab-content">
                                        <div class="form-group row">
                                            <label for="direct_key" class="col-sm-2 control-label">{{ __('Live in Seconds') }} 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="wave_live_seconds" value="{{ $bank_details->wave_live_seconds }}" placeholder="{{ __('Wave Live Seconds') }}">
                                                @if ($errors->has('wave_live_seconds'))
                                                <p class="text-danger"> {{ $errors->first('wave_live_seconds') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="direct_key" class="col-sm-2 control-label">{{ __('Merchnt ID') }} 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="wave_merchnt_id" value="{{ $bank_details->wave_merchnt_id }}" placeholder="{{ __('Merchnt ID') }}">
                                                @if ($errors->has('wave_merchnt_id'))
                                                <p class="text-danger"> {{ $errors->first('wave_merchnt_id') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="direct_key" class="col-sm-2 control-label">{{ __('Callback URL') }} 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="wave_callback_url" value="{{ $bank_details->wave_callback_url }}" placeholder="{{ __('Callback URL') }}">
                                                @if ($errors->has('wave_callback_url'))
                                                <p class="text-danger"> {{ $errors->first('wave_callback_url') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="direct_key" class="col-sm-2 control-label">{{ __('Secret Key') }} 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="wave_secret_key" value="{{ $bank_details->wave_secret_key }}" placeholder="{{ __('Secret Key') }}">
                                                @if ($errors->has('wave_secret_key'))
                                                <p class="text-danger"> {{ $errors->first('wave_secret_key') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="direct_key" class="col-sm-2 control-label">{{ __('Base URL') }} 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="wave_base_url" value="{{ $bank_details->wave_base_url }}" placeholder="{{ __('Base URL') }}">
                                                @if ($errors->has('wave_base_url'))
                                                <p class="text-danger"> {{ $errors->first('wave_base_url') }} </p>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="direct_status" class="col-sm-2 control-label">{{ __('Status') }} 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="wave_status">
                                                    <option value="1" <?php if($bank_details->wave_status == 1){ echo 'selected'; } ?>>Sandbox</option>
                                                    <option value="2" <?php if($bank_details->wave_status == 2){ echo 'selected'; } ?>>Production</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="kbz_status" class="col-sm-2 control-label">{{ __('Payment Status') }} 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="wave_pay_status">
                                                    <option value="0" <?php if($wave_id->status == 0){ echo 'selected'; } ?>>Disabled</option>
                                                    <option value="1" <?php if($wave_id->status == 1){ echo 'selected'; } ?>>Enabled</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('.col-md-3 .side-menu:first').addClass('active');
        $('.tab-content:not(:first)').hide();
        $('.col-md-3 .side-menu a').click(function (event) {
            event.preventDefault();
            var content = $(this).attr('href');
            $(this).parent().addClass('active');
            $(this).parent().siblings().removeClass('active');
            $(content).show();
            $(content).siblings('.tab-content').hide();
        });
    });
</script>

@endsection
