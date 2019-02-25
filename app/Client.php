<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//teammate.role
class Client extends Model
{
    
    protected $fillable = [
    	"first_name", "last_name", "email", "roles"
    ];


    //protected $casts = [
    //	"roles"	=> "array"
    //];

    public function getNameAttribute(){
    	return $this->first_name. ' '. $this->last_name;
    }


    public function user(){
    	return $this->belongsTo(User::class);
    }
}
