<?php

/*
|--------------------------------------------------------------------------
| LEGACY API Routes (Deprecated)
|--------------------------------------------------------------------------
|
| WARNING: These routes are kept for backward compatibility only.
| New mobile apps should use /api/v1/* routes with proper authentication.
|
| SECURITY: Removed hardcoded CORS headers - use config/cors.php instead
|
*/

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|----------------------------get-banner----------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
   // return $request->user();
});
Route::group(['namespace' => 'API'], function ()
{
    // Mbt Api
  Route::get('get-access-token','MbtController@gettoken');
  Route::get('store-user','MbtController@StoreUser');
  Route::get('view-user','MbtController@viewUser');
  Route::get('bound-device','MbtController@boundDevices');
  //Route::get('payment-records','MbtController@paymentRecords');
  Route::get('install-broadband-bind-mobile-number','MbtController@bindMobileNumber');
  Route::get('query-ordersed-product','MbtController@QueryOrderProduct');
  Route::get('send-notification','MbtController@SendNotification');
  Route::get('product-operators','MbtController@ProductOperators');
  Route::get('add-group','MbtController@AddGroup');
  Route::get('view-all-groups','MbtController@ViewAllGroups');
  Route::get('add-billing','MbtController@AddBilling');
  Route::get('create-control','MbtController@CreateControl');
  
  //Our server Api
  Route::post("check-validation","LoginController@CheckMobileNumber");
  Route::post("register","LoginController@register");
  Route::post("login","LoginController@login");
  Route::post("forgot-password","LoginController@forgot_password");
  Route::post("apply-install-broadband","LoginController@ApplyInstallBroadband");
  Route::post("get-payment-record","MbtController@paymentRecords");
 // Route::post("get-payment-record","LoginController@GetPaymentRecord");
  Route::get("get-package-information","MbtController@GetPackageInformation");
  Route::get("user-super-search","MbtController@UserSuperSearch");
  
  Route::get("get-notification","MbtController@GetMessage");
  
  Route::post("update-notification","MbtController@updatenoti");
  Route::post("language-id","MbtController@get_language");
  
  Route::post("get-payment-failed-record","MbtController@paymentfailedRecords");
  
  Route::post("user-message","MbtController@user_message");

  Route::post("get-package-message","MbtController@getpackage_language");
  
  Route::post("user-device","MbtController@userdevice");
  
  // CB Payment
  
  Route::post("mbt-cb-pay","MbtController@mbtcbpay");
  Route::post("mbt-cb-pay-status","MbtController@mbtcbpaystatus");
  Route::match(array('GET','POST'),'notify', 'MbtController@notify');
  Route::get('mbt-referer', 'MbtController@referer_url')->name('referer_url');
  
   Route::post('kbz-callback-url', 'MbtController@kbz_callback_url')->name('kbz_callback_url');


  Route::get('mbt-return', 'MbtController@return_url')->name('return_url');
  Route::get('wave-mbt-return', 'MbtController@wave_return_url')->name('wave.return.url');

  
    Route::match(array('GET','POST'),'callback', 'MbtController@callback_url')->name('callback_url');



  Route::post('cb-redirect', 'MbtController@cbredirect')->name('cbredirect');
  Route::match(array('GET','POST'),'aya-callback', 'MbtController@ayacallback');
  
  // KBZ Payment
  
  Route::post("mbt-kbz-pay","MbtController@mbtkbzpay");
  Route::post("mbt-kbz-pay-status","MbtController@mbtkbzpaystatus");
  Route::post('kbz-redirect', 'MbtController@kbzredirect')->name('kbzredirect');
  Route::post("mbt-kbz-refund-status","MbtController@mbtkbzrefundstatus");
  Route::post("mbt-kbz-close","MbtController@mbtkbzclose");
  Route::post("mbt-kbz-refund","MbtController@mbtkbzrefund");
  Route::post("check-payment","MbtController@check_payment");
  
  Route::post("mbt-kbz-pay-check","MbtController@mbtkbzpaycheck");
  
  // KBZ Mobile Banking
  
  Route::post('kbz-mobile-success', 'MbtController@mbtmobilesuccess')->name('mbtmobilesuccess');
  
  Route::match(array('GET','POST'),'kbz-mobile-failure', 'MbtController@mbtmobilefailure')->name('mbtmobilefailure');
  
  // Route::post('kbz-mobile-payment', 'NirbhayController@kbz_mobile_payment')->name('kbzmobilepayment'); // Controller doesn't exist
  Route::post('kbz-mobile-decrypt', 'MbtController@decrypt')->name('kbzmobiledecrypt');
  
  // Route::post('kbz-mobile', 'KbzmobileController@encrypt'); // Controller doesn't exist
  
  // AyaPay
  
  Route::post('aya-access-token', 'MbtController@aya_access_token')->name('aya_access_token');
  Route::post('aya-merchant-login', 'MbtController@aya_merchant_login')->name('aya_merchant_login');
  Route::post('aya-request-payment', 'MbtController@aya_request_payment')->name('aya_request_payment');
  Route::post('aya-payment-status', 'MbtController@aya_payment_status')->name('aya_payment_status');
  
  Route::post('kbz-payment-status', 'MbtController@kbz_payment_status')->name('kbz_payment_status');
  
  // WavePay
  
  Route::post('wave-hash-token', 'MbtController@wave_hash_token')->name('wave_hash_token');
  Route::post('wave-request-payment', 'MbtController@wave_request_payment')->name('wave_request_payment');
  Route::post('wave-authenticate-payment', 'MbtController@wave_authenticate_payment')->name('wave_authenticate_payment');
  Route::match(array('GET','POST'),'wave-callback-payment', 'MbtController@wave_callback_payment')->name('wave_callback_payment');
  Route::match(array('GET','POST'),'wave-payment-status', 'MbtController@wavepay_payment_status')->name('wavepay_payment_status');
  
  
  Route::post('check-user', 'MbtController@check_user')->name('check_user');

  Route::post("store-failure-reports","MbtController@StoreFailureReports");
  Route::get("get-failure-reports","MbtController@GetFailureReports");
  Route::get("get-banner","MbtController@GetBanner"); 
  Route::get("get-Preferential-activities","LoginController@Preferential_activities"); 
  Route::post("get-self-profile","MbtController@GetMySelf"); 
  Route::post("get-language","MbtController@GetLanguage"); 
  Route::post("bind-user","MbtController@BindUser"); 
  Route::post("change-number","LoginController@change_number"); 
  Route::post("change-password","LoginController@change_Password"); 
  Route::post("forgot-password","LoginController@forgotPassword"); 
  Route::post("profile-image","LoginController@profileimage");
  Route::get("get-error-code","LoginController@error_code");
  Route::post("about-page-content","LoginController@aboutmessage");

  //Chat api//
  Route::Post("insert-message","LoginController@insertmessage");
  Route::Post("get-message","LoginController@get_message");
  Route::Post("get-apply-query","LoginController@GetApplyQuery");
  Route::Post("update-apply-query","LoginController@UpdateApplyQuery");
  Route::get("get-package","MbtController@GetPackage");
  Route::post("unbind-user","MbtController@UnbindUser");
  Route::post("store-payment","MbtController@StorePayment");
  Route::post("payment-method","LoginController@paymentmethod");
  Route::post("bindcheck","LoginController@second_login");
  Route::post("loginotp","LoginController@loginotp");
  Route::post("signupotp","LoginController@signupot");
  
  Route::get("mbtprofile","MbtController@logo_image");
  Route::post("update-payment","MbtController@UpdatePayment");
  Route::post("check-app-version","MbtController@checkAppUpdate");
  
  Route::post("remove-user","MbtController@removeUser");
  
  Route::post("check-new-user","MbtController@checknewuser");
  Route::post("check-expire-time","MbtController@checkexpiretime");
  Route::get("get-new-package","MbtController@GetNewPackage");
  Route::post("get-new-package-message","MbtController@getnewpackage_language");
  Route::get("get-new-package-information","MbtController@GetNewPackageInformation");
  Route::post("store-new-payment","MbtController@StoreNewPayment");
  Route::post("print-invoice","MbtController@printinvoice");
  
  Route::get("check-maintenance","MbtController@check_maintenance");

});

