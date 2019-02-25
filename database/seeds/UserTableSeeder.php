<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$user = new User;
    	$user->first_name = "Super";
    	$user->last_name  = "admin";
    	$user->email 	  = "super@gmail.com";
    	$user->password   =  bcrypt("1");
    	$user->save();

        $user->roles()->attach(1);

        $user = new User;
    	$user->first_name = "Employer";
    	$user->last_name  = "Singh";
    	$user->email 	  = "employer@gmail.com";
    	$user->password   =  bcrypt("1");
        $user->stepping = 3;
    	$user->save();
        $user->details()->create(["school_id" => 3]);
        $user->roles()->attach(2);

        $user = new User;
    	$user->first_name = "educator";
    	$user->last_name  = "Singh";
    	$user->email 	  = "educator@gmail.com";
    	$user->password   =  bcrypt("1");
    	$user->stepping = 1;
    	$user->save();
        $user->details()->create([]);

        $user->roles()->attach(3);

        $faker =  new \Faker\Generator;
        // employer
        factory(App\User::class, 9)->create(['stepping' => 3, "password" => bcrypt(1)])->each(function ($user) {
            $user->details()->create(["school_id" => 3]);
            $user->roles()->attach(2);
        });

        // educator
        

        factory(App\User::class, 9)->create(['stepping' => 3, "password" => bcrypt(1) ])->each(function ($user) {

            $faker =  Faker\Factory::create();

            $detail = [];
            $detail["phone"] = $faker->phoneNumber;
            $detail["address"] = $faker->streetAddress;
            $detail["city"] = $faker->city;
            $detail["state"] = $faker->stateAbbr; //state
            $detail["zipcode"]  = $faker->postcode ;
            $detail['answers'] = [];
            $detail['accept_positions'] = [];
            $detail["certifications"] = [];
            $detail["relocate"]  = [];
            $detail["notifications"] = [];

            $user->details()->create($detail);
            $user->roles()->attach(3);
        });
    }
}
