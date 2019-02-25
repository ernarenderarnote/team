<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAction extends Model
{
    protected $table = "job_user_action";

    protected $timestamp = false;

    protected $fillable = [
        "action", "user_id"
    ];

    public function job()
    {
    	return $this->belongsTo(Job::class, "job_id");
    }

    public function employer()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }

    public function sender()
    {
    	return $this->belongsTo(User::class, "sender_id", 'id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, "receiver_id");
    }

    public function educator()
    {
        return $this->belongsTo(User::class, "receiver_id");
    }

    public function scopeOffers($q, $id)
    {
        return $q->whereSenderId($id)->orWhere('receiver_id', $id);
    }
}
