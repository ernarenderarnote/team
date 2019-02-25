<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transection extends Model
{
 	
 	protected $fillable = [
 		"employer_id", "employer_id" , "postdata"
 	] ;

 	protected $casts = [
 		"postdata" => "object"
 	]; 
}
