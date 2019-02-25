<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    protected $fillable = [  "email", "phone", "subject_id", "message"];

    public function subject()
    {
    	return $this->belongsTo(SupportSubject::class);
    }
}
