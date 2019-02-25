<?php
namespace App\Services;

use App\Cart;
use App\CreditCard;

class CommonService {


	public function cart(){

		$cart = Cart::query();
		$cart->whereUserId(auth()->user()->getUser()->id);
		return $cart;
	}

	public function cards(){
		return CreditCard::whereUserId(auth()->user()->getUser()->id)->get();
	}

}