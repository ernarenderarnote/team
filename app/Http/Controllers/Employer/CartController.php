<?php

namespace App\Http\Controllers\Employer;

use App\Cart;
use App\UserAction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{

    public $data = [];

    public function placeOrder()
    {

        $carts = Cart::whereUserId(auth()->user()->getUser()->id)->get();

        $carts->each(function($cart){

            $userAction = new UserAction();
            $userAction->user_id = auth()->user()->getUser()->id;
            $userAction->action = "contact";
            $userAction->sender_id = auth()->id();
            $userAction->receiver_id = $cart->educator_id;
            //$userAction->educator_id = $id;
            $cart->delete();
            $userAction->save();

            if($userAction->employer->details->credit > 0) 
                $userAction->employer->details->forceFill(["credit" => \DB::raw("credit - 1")])->save();

        });

        return  redirect()->route("employer.order.thank.you");
    }
    /**
     * Display a listing of the resource. 
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data["carts"] = Cart::with("addedBy")
                                            ->groupBy("added_by_id")
                                            ->orderBy("id")
                                            ->select("*", \DB::raw("count(*) as count_addby"))
                                            ->whereUserId(auth()->user()->getUser()->id)
                                            ->get();

        $this->data["needCredit"] = Cart::whereUserId(auth()->user()->getUser()->id)->count();
        return view('employer.cart.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Cart $cart)
    {
        $this->validate($request, ["educator_id" => "required"]);

        $cart->user_id = auth()->user()->getUser()->id;
        $cart->educator_id = $request->educator_id;
        $cart->added_by_id = auth()->id();
        $cart->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
