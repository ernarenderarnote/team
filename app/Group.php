<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function sub()
    {
    	return $this->hasMany(Group::class, 'parent_id');
    }
}
