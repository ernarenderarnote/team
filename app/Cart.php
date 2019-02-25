<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
    	"educator_id"
    ];


    function user(){
    	return $this->belongsTo(User::class, 'user_id');
    }

    function addedBy(){
    	return $this->belongsTo(User::class, "added_by_id");
    }

    function educator(){
    	return $this->belongsTo(User::class, "added_by_id");
    }
}
