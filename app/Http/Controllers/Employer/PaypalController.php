<?php
namespace App\Http\Controllers\Employer;


use Auth;
use App\User;
use App\ContactPack;
use App\Transection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaypalController extends Controller
{

	public function notify(Request $request){


        \Storage::disk('local')->put('NotifyUrl.txt', json_encode($request->all()));

        $data =  $request->all();


        parse_str(str_replace("|", "&", $request->get('custom')),$custom);

        $pack = ContactPack::findOrFail($custom['pack_id']);


        $transection = new Transection;
        $transection->payment_type = "paypal";
        $transection->amount = $data['mc_gross'];
        $transection->user_id = $custom['user_id'];
        $transection->postdata = $request->all();

       

        $user = User::find($custom['user_id']);
        $user->details()->update(["credit" => \DB::raw("credit + {$pack->credit}")]);

        $transection->save();

       // txn_type=subscr_payment
        //if($data["txn_type"] != 'subscr_cancel'){
        try {


            //if($request->has('txn_type')){
               
            //   $signup = [];

            //   if($request->get('txn_type') == "subscr_signup")
               /*
                    [txn_type] => subscr_signup
                    [subscr_id] => I-FCJ58W02SCU3
                    [last_name] => Sing
                    [residence_country] => IN
                    [mc_currency] => USD
                    [item_name] => donations
                    [business] => jitendraqwq@techsparksit.com
                    [amount3] => 250.00
                    [recurring] => 1
                    [address_street] => Flat no. 507 Wing A Raheja Residency
                    Film City Road, Goregaon East
                    [verify_sign] => Am82Np6AEAAE8c8ZFN8ZSYXcXhsZAiv6Z5vBSY6tW-Ynk7r28XG2iaWo
                    [payer_status] => verified
                    [test_ipn] => 1
                    [payer_email] => gurinder@techsparksit.com
                    [address_status] => unconfirmed
                    [first_name] => Gurinder
                    [receiver_email] => jitendraqwq@techsparksit.com
                    [address_country_code] => IN
                    [payer_id] => KDKTARE3FHJUQ
                    [address_city] => Mumbai
                    [reattempt] => 1
                    [address_state] => Maharashtra
                    [subscr_date] => 06:08:04 Oct 06, 2016 PDT
                    [address_zip] => 400097
                    [custom] => model_id=3
                    [model] => [object Object]
                    [is_recurring] => m
                    [user_id] => 4
                    [charset] => windows-1252
                    [notify_version] => 3.8
                    [period3] => 1 D
                    [address_country] => India
                    [mc_amount3] => 250.00
                    [address_name] => Gurinder Sing
                    [ipn_track_id] => 28e4077687517

               */
            //    if($request->get('txn_type') == "subscr_payment"){

                    /*
                        [mc_gross] => 250.00
                        [protection_eligibility] => Eligible
                        [address_status] => unconfirmed
                        [payer_id] => KDKTARE3FHJUQ
                        [address_street] => Flat no. 507 Wing A Raheja Residency
                        Film City Road, Goregaon East
                        [payment_date] => 06:08:12 Oct 06, 2016 PDT
                        [payment_status] => Completed
                        [charset] => windows-1252
                        [address_zip] => 400097
                        [first_name] => Gurinder
                        [mc_fee] => 10.05
                        [address_country_code] => IN
                        [address_name] => Gurinder Sing
                        [notify_version] => 3.8
                        [subscr_id] => I-FCJ58W02SCU3
                        [custom] => model_id=3
                        [model] => [object Object]
                        [is_recurring] => m
                        [user_id] => 4
                        [payer_status] => verified
                        [business] => jitendraqwq@techsparksit.com
                        [address_country] => India
                        [address_city] => Mumbai
                        [verify_sign] => AXLWdOJhkP90eNoOtLfDZnBCdJ9VAqSe-.17mH.bQkJ4RzLFzNIT4el8
                        [payer_email] => gurinder@techsparksit.com
                        [txn_id] => 71Y06568T2296053D
                        [payment_type] => instant
                        [last_name] => Sing
                        [address_state] => Maharashtra
                        [receiver_email] => jitendraqwq@techsparksit.com
                        [payment_fee] => 10.05
                        [receiver_id] => 277D594F7CKKS
                        [txn_type] => subscr_payment
                        [item_name] => donations
                        [mc_currency] => USD
                        [residence_country] => IN
                        [test_ipn] => 1
                        [transaction_subject] => donations
                        [payment_gross] => 250.00
                        [ipn_track_id] => 28e4077687517
                    */
            //    }
            //    if($request->get('txn_type') == "subscr_cancel"){


            //    }

            //}

           
        }
        catch (\Exception $ex){

        }

    }

    public function successfully(Request $request){

        return redirect()->route("employer.thank.you");

    	/*$data =  $request->all();

        parse_str($data['custom'], $custom);

        $transection = new Transection;

        $transection->payment_type = "paypal";
        $transection->amount = $data['mc_gross'];
        $transection->employer_id = $custom['user_id'];
        $transection->postdata = $request->all();

        $transection->save();*/

    }

    public function cancelled(Request $request){
        return redirect()->route("dashboard");
        //\Storage::disk('local')->put('cancel.txt', json_encode($request->all()));
    }

}