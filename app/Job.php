<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       "title", "deadline",'job_type_id', "category_id", 'grade_id','pay_type','pay_min', "pay_max", "state_id", "city_id",  'description', 'education', 'skills', 'additional_information'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userAction()
    {
        return $this->belongsToMany(User::class, 'job_user_action',  'job_id','sender_id' )->withPivot('action');
    }

    public function userActionJob()
    {
        return $this->hasMany(UserAction::class, 'job_id', 'id' );
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function jobType()
    {
        return $this->belongsTo(Group::class, 'job_type_id');
    }

    public function category()
    {
        return $this->belongsTo(Group::class, 'category_id');
    }

    public function grade()
    {
        return $this->belongsTo(Group::class, 'grade_id');
    }

}
