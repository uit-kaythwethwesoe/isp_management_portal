<?php

namespace App\Http\Controllers\Payment\Paybill;

use App\Billpaid;
use App\Classes\GeniusMailer;
use App\Helpers\Helper;
use App\Models\UserSubscription;
use Carbon\Carbon;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade as PDF;
use App\Emailsetting;
use App\Http\Controllers\Controller;
use App\Package;
use App\PaymentGatewey;
use App\Models\Setting;
use App\Packageorder;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class StripeController extends Controller
{

    public function __construct()
    {
        $data = PaymentGatewey::whereKeyword('stripe')->first();
        $paydata = $data->convertAutoData();
        Config::set('services.stripe.key',  $paydata['key']);
        Config::set('services.stripe.secret', $paydata['secret']);
    }


    public function store(Request $request){

          
            $request->validate([
                'card_number' => 'required',
                'fullname' => 'required',
                'cvc' => 'required',
                'month' => 'required',
                'year' => 'required',
            ]);

            
            $stripe = Stripe::make(Config::get('services.stripe.secret'));
            

            try{
              
                $token = $stripe->tokens()->create([
                    'card' =>[
                        'name' => $request->fullname,
                        'number' => $request->card_number,
                        'exp_month' => $request->month,
                        'exp_year' => $request->year,
                        'cvc' => $request->cvc,
                    ],
                ]);

                if (!isset($token['id'])) {
                    $notification = array(
                        'messege' => 'Token Problem With Your Token.',
                        'alert' => 'error'
                    );
                    return redirect()->back()->with('notification', $notification);
                }
        
                $charge = $stripe->charges()->create([
                    'card' => $token['id'],
                    'currency' => Helper::showCurrencyCode(),
                    'amount' =>  $request->packageprice,
                    'description' => \Carbon\Carbon::now()->format('M Y').", This month bill paid. Package name: ".$request->packagename,
                ]);

               
                if ($charge['status'] == 'succeeded') {

                    
                    $order  = new Billpaid();

                    $order['package_cost'] =  $request->packageprice;
                    $order['currency_code'] = 'USD';
                    $order['currency_sign'] = "$";
                    $order['attendance_id'] = Str::random(4).time();
                    $order['payment_status'] = "Completed";
                    $order['txn_id'] = $charge['balance_transaction'];
                    $order['user_id'] = Auth::user()->id;
                    $order['package_id'] = $request->packageid;
                    $order['yearmonth'] = \Carbon\Carbon::now()->format('m-Y');
                    $order['fulldate'] = \Carbon\Carbon::now()->format('M d, Y');
                    $order['method'] = 'Stripe';
                    $order['status'] = 0;
                    $order->save();
                    $order_id = $order->id;

                    $package_id = $order->package_id;
                    $package = Package::find($package_id);
        
                    // sending datas to view to make invoice PDF
                    $fileName = Str::random(4) . time() . '.pdf';
                    $path = 'assets/front/invoices/bill/' . $fileName;
                    $data['bill'] = $order;
                    $data['package'] = $package;
                    $data['user'] = Auth::user();
                    PDF::loadView('pdf.bill', $data)->save($path);

                    Billpaid::where('id', $order_id)->update([
                        'invoice_number' => $fileName
                    ]);
        
                        // Send Mail to Buyer
                    $mail = new PHPMailer(true);
                    $user = Auth::user();
        
                    $em = Emailsetting::first();
        
                    if ($em->is_smtp == 1) {
                        try {
                            $mail->isSMTP();
                            $mail->Host       = $em->smtp_host;
                            $mail->SMTPAuth   = true;
                            $mail->Username   = $em->smtp_user;
                            $mail->Password   = $em->smtp_pass;
                            $mail->SMTPSecure = $em->email_encryption;
                            $mail->Port       = $em->smtp_port;
        
                            //Recipients
                            $mail->setFrom($em->from_email, $em->from_name);
                            $mail->addAddress($user->email, $user->name);
        
                            // Attachments
                            $mail->addAttachment('assets/front/invoices/bill/' . $fileName);
        
                            // Content
                            $mail->isHTML(true);
                            $mail->Subject = "Bill Paid";
                            $mail->Body    = 'Hello <strong>' . $user->name . '</strong>,<br/>Your bill was paid successfully. We have attached an invoice in this mail.<br/>Thank you.';
        
                            $mail->send();
                        } catch (Exception $e) {
                            // die($e->getMessage());
                        }
                    } else {
                        try {
                            //Recipients
                            $mail->setFrom($em->from_mail, $em->from_name);
                            $mail->addAddress($user->email, $user->name);
        
                            // Attachments
                            $mail->addAttachment('assets/front/invoices/bill/' . $fileName);
        
                            // Content
                            $mail->isHTML(true);
                            $mail->Subject = "Bill Paid";
                            $mail->Body    = 'Hello <strong>' . $user->name . '</strong>,<br/>Your bill was paid successfully. We have attached an invoice in this mail.<br/>Thank you.';
        
                            $mail->send();
                        } catch (Exception $e) {
                            // die($e->getMessage());
                        }
                    }

                    return view('front.success.package');
                }

            }catch (Exception $e){
                $notification = array(
                    'messege' => $e->getMessage(),
                    'alert' => 'warning'
                );
                return redirect()->back()->with('notification', $notification);
            }catch (\Cartalyst\Stripe\Exception\CardErrorException $e){
                $notification = array(
                    'messege' => $e->getMessage(),
                    'alert' => 'warning'
                );
                return redirect()->back()->with('notification', $notification);
            }catch (\Cartalyst\Stripe\Exception\MissingParameterException $e){
                $notification = array(
                    'messege' => $e->getMessage(),
                    'alert' => 'warning'
                );
                return redirect()->back()->with('notification', $notification);
            }
        $notification = array(
            'messege' => 'Please Enter Valid Credit Card Informations.',
            'alert' => 'warning'
        );
        return redirect()->back()->with('notification', $notification);
    }


    public function payreturn(){
        return view('front.success.package');
     }


}