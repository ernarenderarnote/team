<?php

namespace App\Http\Controllers\Employer;

use App\CreditCard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CardController extends Controller
{
    public $data = [];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("employer.card.create", $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // "first_name", "last_name", "card_number", "expiry_month", "expiry_year", "cvc"
       $this->validate($request, [
                            "first_name" => "required",
                            "last_name" => "required",
                            "card_number"    => "required|digits:16",
                            "expiry_month"  => "required",
                            "expiry_year"   => "required",
                            "cvc"           => "required|digits:3"
                        ]);


       $card = new CreditCard();
       $card->fill($request->toArray());
       $card->user_id = auth()->user()->getUser()->id;
       $card->save();

       session()->flash("success", "Card has been saved");
       return back();
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
    public function edit(CreditCard $card)
    {
        $this->data["card"] = $card;

        return view("employer.card.edit", $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CreditCard $card)
    {
        $this->validate($request, [
                            "first_name" => "required",
                            "last_name" => "required",
                            "card_number"    => "required|digits:16",
                            "expiry_month"  => "required",
                            "expiry_year"   => "required",
                            "cvc"           => "required|digits:3"
                        ]);

        $card->fill($request->toArray());
        $card->save();

        session()->flash("success", "Card updated successfully!");

        return redirect()->route("employer.settings.index");
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
