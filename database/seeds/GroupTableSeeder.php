<?php

use App\Group;
use Facades\App\Helper\Common;
use Illuminate\Database\Seeder;

class GroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	
    	foreach(Common::categories() as $key => $category)
    	{
    		$group = new Group;
    		$group->type = 'category';
    		$group->name = $key;
    		$group->save();

    		foreach ($category as $value) {
    			$childGroup = new Group;
    			$childGroup->type = 'category';
	    		$childGroup->name = $value;
	    		$childGroup->parent_id = $group->id;
	    		$childGroup->save();
    		}
    	}

    	foreach(Common::grade() as $key => $category)
    	{
    		$group = new Group;
    		$group->type = 'grade';
    		$group->name = $key;
    		$group->save();

    		foreach ($category as $value) {
    			$childGroup = new Group;
    			$childGroup->type = 'grade';
	    		$childGroup->name = $value;
	    		$childGroup->parent_id = $group->id;
	    		$childGroup->save();
    		}
    	}

        foreach(Common::jobType() as $key => $value)
        {
            $group = new Group;
            $group->type = 'jobtype';
            $group->name = $value;
            $group->save();

        }

        foreach (Common::jobPosition() as $key => $value) {
            $group = new Group;
            $group->type = 'position';
            $group->name = $value;
            $group->save();
        }
    	
        foreach (Common::jobDegreeAttained() as $key => $value) {
            $group = new Group;
            $group->type = 'attained';
            $group->name = $value;
            $group->save();
        }


        foreach (Common::teammates() as $key => $value) {
            $group = new Group;
            $group->type = 'teammate.role';
            $group->name = $value;
            $group->save();
        }
        
    }
}
