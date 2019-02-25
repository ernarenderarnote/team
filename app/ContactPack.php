<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactPack extends Model
{
    
    protected $fillable = [
    		"credit", "price","offer_value", "offer_type"
    ];

    public function setOfferValueAttribute($value){
    	$this->attributes["offer_value"] = (int) $value;
    }


    public function getPrice()
    {
		switch ($this->offer_type)
		{
			case 'percent':
				return $this->price - (($this->price * (int) $this->offer_value)/100);
				break;
			
			default:
				return $this->price;
				break;
		}

    }
}
