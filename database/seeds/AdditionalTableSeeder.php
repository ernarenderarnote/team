<?php

use App\Additional;
use Illuminate\Database\Seeder;

class AdditionalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $additional = new Additional;
        $additional->type = "employer.support.contact";
        $additional->values = [
        						"email"=>"support@team.education",
        						"phone"=>"(555) 123-3456",
        						"address"=>"Test address st. Waco, TX 44454"
        					 ];
        $additional->save();

        $additional = new Additional;
        $additional->type = "educator.support.contact";
        $additional->values = [
        						"email"=>"support@team.education",
        						"phone"=>"(555) 123-3456",
        						"address"=>"Test address st. Waco, TX 44454"
        					 ];
        $additional->save();

        $additional = new Additional;
        $additional->type = "school";
        $additional->values = [
                                "school_name"=>"school"
                             ];
        $additional->save();
        
    }
}
