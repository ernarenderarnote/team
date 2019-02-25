<?php
namespace App\Services;

use App\ContactPack;

class ContactPackService {

	protected $credit;

	function __construct(ContactPack $contactPack)
	{
		$this->contactPack = $contactPack;
	}

	public  function all()
	{
		return $this->contactPack->all();
	}


	public function getPriceIfHasOffer(contactPack $contactPack){

		switch ($contactPack->offer_type)
		{
			case 'percent':
				return $contactPack->price - (($contactPack->price * (int) $contactPack->offer_value)/100);
				break;
			
			default:
				return $contactPack->price;
				break;
		}

	}
}