<?php

use App\State;
use Illuminate\Database\Seeder;

class StateCitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	
        $state = new State;
        $state->name = "Texas";
        $state->short_name = "TX";
        $state->save();

        $state->city()->create(['name' => "Houston" ]);
        $state->city()->create(['name' => "Dallas" ]);
        $state->city()->create(['name' => "Austin" ]);
        $state->city()->create(['name' => "San Antonio" ]);
        $state->city()->create(['name' => "Fort Worth" ]);
        $state->city()->create(['name' => "El Paso" ]);
        $state->city()->create(['name' => "Corpus Christi" ]);
        $state->city()->create(['name' => "Arlington" ]);
        $state->city()->create(['name' => "Amarillo" ]);


        $state = new State;
        $state->name = "California";
        $state->short_name = "CA";

        $state->save();
        $state->city()->create(['name' => "Los Angeles" ]);
        $state->city()->create(['name' => "San Francisco" ]);
        $state->city()->create(['name' => "San Diego" ]);
        $state->city()->create(['name' => "Sacramento" ]);
        $state->city()->create(['name' => "Oakland" ]);
        


    }
}
