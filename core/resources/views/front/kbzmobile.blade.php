@extends('front.layout')

@section('meta-keywords', "$setting->meta_keywords")
@section('meta-description', "$setting->meta_description")
@section('content')


<section class="about-section">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<form action="{{ route('kbzmobile_pay') }}" method="post">
				  @csrf()
                  <div class="form-group">
                    <label>fldClientCode</label>
                    <input type="text" name="fldClientCode" class="form-control" value="101" placeholder="fldClientCode">
                  </div>
                  
                  <div class="form-group">
                    <label>fldMerchCode</label>
                    <input type="text" name="fldMerchCode" class="form-control" value="EPI0008" placeholder="fldMerchCode">
                  </div>
                  
                  <div class="form-group">
                    <label>fldTxnCurr</label>
                    <input type="text" name="fldTxnCurr" class="form-control" value="USD" placeholder="fldTxnCurr">
                  </div>
                  
                  <div class="form-group">
                    <label>fldTxnAmt</label>
                    <input type="text" name="fldTxnAmt" class="form-control" value="50" placeholder="fldTxnAmt">
                  </div>
                  
                  <div class="form-group">
                    <label>fldTxnScAmt</label>
                    <input type="text" name="fldTxnScAmt" class="form-control" value="1" placeholder="fldTxnScAmt">
                  </div>
                  
                  <div class="form-group">
                    <label>fldMerchRefNbr</label>
                    <input type="text" name="fldMerchRefNbr" class="form-control" value="ABC00123" placeholder="fldMerchRefNbr">
                  </div>
                  
                  <div class="form-group">
                    <label>fldSucStatFlg</label>
                    <input type="text" name="fldSucStatFlg" class="form-control" value="N" placeholder="fldSucStatFlg">
                  </div>
                  
                  <div class="form-group">
                    <label>fldFailStatFlg</label>
                    <input type="text" name="fldFailStatFlg" class="form-control" value="N" placeholder="fldFailStatFlg">
                  </div>
                  
                  <?php
                      date_default_timezone_set("Asia/Yangon");
                      $date = date("Y-m-d H:i:s", strtotime('+0 hours'));
                  ?>
                  
                  <div class="form-group">
                    <label>fldDatTimeTxn</label>
                    <input type="text" name="fldDatTimeTxn" class="form-control" value="{{ $date }}" placeholder="fldDatTimeTxn">
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
			</div>
		</div>
	</div>
</section>


@endsection
