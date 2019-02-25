<?php

namespace App\Http\Controllers\Employer;

use Session;
use Redirect;
use App\Transection;
use App\ContactPack;
use Facades\App\Services\ContactPackService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactPackController extends Controller
{
    public $data = [];

	private $business_email = "jitendraqwq@techsparksit.com";

    public $return_url     =   "http://team.fwphotographers.com/paypal/successfully";
    public $cancel_url     =   "http://team.fwphotographers.com/paypal/cancelled";
    public $notify_url     =   "http://team.fwphotographers.com/paypal/notify";

    public $paypal_data = [];

    public function __construct()
    {
        
    }

    public function index()
    {
        return view("employer.contactpack.index", $this->data);
    }

    
    /*
     * init data set
     * */
    public function initData()
    {

        $data = [
                "business"          => $this->business_email,
                "return"            => $this->return_url,
                "cancel_return"     => $this->cancel_url,
                "notify_url"        => $this->notify_url,
        ];

        $this->paypal_data = array_merge($this->paypal_data,$data);
    }


    /*
     * set paypal data;
     * $params array $data
     * */

    public function setData(array $data)
    {
        $this->paypal_data =  array_merge($data,$this->paypal_data);
    }


    /*
     * Send data to paypal
     * */

    public function send(){

        $queryString = http_build_query($this->paypal_data);

        header('location:https://www.sandbox.paypal.com/cgi-bin/webscr?'.$queryString,TRUE, 307);
        exit;
    }

    public function pay(Request $request){

        $this->validate($request,[ "pack" => "required"], ["pack" => "Contact Pack is required."]);

        $pack = ContactPack::findOrFail($request->pack);

        if($request->type == "paypal")
        {
            $this->paypal($pack);
        }
        else if($request->type == "stripe"){
            return $this->createStripe($pack);
        }
    }


    public function paypal(ContactPack $pack)
    {
        $this->initData();

        $data = [] ;
        $custom = [];
        $custom["user_id"] = auth()->user()->getUser()->id;
        $custom["pack_id"] = $pack->id;

        $this->setData(['cmd' => '_xclick']);
        $this->setData(['amount' => $pack->getPrice()]);
        $this->setData(['item_name' => 'Contact Pack']);

        $data["custom"] = http_build_query($custom,'', '|');
        $this->setData($data);
        $this->send();
    }

    public function createStripe($pack)
    {
        return redirect()->route("employer.stripe.pay")->with('pack', $pack->id);
    }

    public function stripePay(Request $request)
    {
        if($request->isMethod("POST"))
        {

            \Stripe\Stripe::setApiKey ( 'sk_test_iV2GIX0Y8FNOezD1mQlbk2qP' );
            try {
                $pack = ContactPack::findOrFail($request->pack);

                $customer = \Stripe\Customer::create(array(
                    'email' => 'dwarkapuria@gmail.com',
                    'source'  => $request->input ( 'stripeToken' )
                ));
                $charge = \Stripe\Charge::create( array (
                        "customer" => $customer->id,
                        "amount" => $pack->getPrice() *100,
                        "currency" => "usd",
                        "description" => "Test payment."
                ));

                //adding Credit
                $this->addContactCredit($pack->credit);

                $transection = new Transection;

                $transection->user_id = auth()->user()->getUser()->id;
                $transection->amount =  $pack->getPrice();
                $transection->payment_type =  "stripe";
                $transection->postdata = $charge;
                $transection->save();


                Session::flash ( 'success-message', 'Payment done successfully !' );
                return redirect()->route("employer.thank.you");
            } catch ( \Exception $e ) {
                echo $e->getMessage();
                //Session::flash ( 'fail-message', "Error! Please Try again." );
                //return Redirect::back ();
            }
        }
        else{
            if(session()->has("pack"))
            {
                $this->data["pack"] =  $pack = ContactPack::findOrFail(session()->get("pack"));

                $request->session()->keep(['pack']); // pack

                $this->data["cards"]= \App\CreditCard::whereUserId(auth()->user()->getUser()->id)->get();

                try{
                    $this->data["selected"] = $this->data["cards"][empty($request->offset) ? 0 : $request->offset];   
                }
                catch(\Exception $ex){
                    $this->data["selected"] = new \App\CreditCard ;
                }
                
                return view("employer.contactpack.stripe", $this->data);
            }
            else
            {
                return redirect()->route("employer.buy.credit");
            }
        }
        
    }


    private function addContactCredit($credit)
    {
        auth()->user()->getUser()->details()->update(["credit" => \DB::raw("credit + $credit")]);
    }

}
