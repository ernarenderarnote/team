<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $owner = new Role();
		$owner->name         = 'owner';
		$owner->display_name = 'Project Owner'; // optional
		$owner->description  = 'User is the owner of a given project'; // optional
		$owner->save();

		$admin = new Role();
		$admin->name         = 'employer';
		$admin->display_name = 'Employer'; // optional
		$admin->description  = 'User is allowed to manage employer Dashboard'; // optional
		$admin->save();
		
		$admin = new Role();
		$admin->name         = 'educator';
		$admin->display_name = 'Educator'; // optional
		$admin->description  = 'User is allowed to manage educator Dashboard'; // optional
		$admin->save();

		$admin = new Role();
		$admin->name         = 'client';
		$admin->display_name = 'client'; // optional
		$admin->description  = 'User is allowed to manage educator Dashboard'; // optional
		$admin->save();
		
    }
}
