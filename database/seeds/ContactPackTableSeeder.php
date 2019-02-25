<?php

use App\ContactPack;
use Illuminate\Database\Seeder;

class ContactPackTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$credit = new ContactPack;
        $credit->credit = 10;
        $credit->price  = 99;
        $credit->save();

        $credit = new ContactPack;
        $credit->credit = 50;
        $credit->price  = 500;
        $credit->offer_type="percent";
        $credit->offer_value= 50;
        $credit->save();


        $credit = new ContactPack;
        $credit->credit = 250;
        $credit->price  = 999;
        $credit->save();


        $credit = new ContactPack;
        $credit->credit = 1000;
        $credit->price  = 3499;
        $credit->save();
    }
}