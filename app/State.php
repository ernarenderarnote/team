<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = ["name", "short_name"];

    public function city()
    {
    	return $this->hasMany(City::class);
    }
}
