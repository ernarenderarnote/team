<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address','address2','city', 'state', 'zipcode', "answers", "school_id", "phone",
        'region', 'relocate', 'gender', 'campus', 'classify', 'creditable_experience',
        'amount_order_to_relocate', 'degree_attained', 'current_position', 'least_amount',
        'accept_positions', 'experience', 'certifications', 'is_additional_duties',  'notifications', 'resume'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'answers' => 'object',
        'accept_positions' => 'array',
        "certifications" => 'array',
        "relocate"  => 'array',
        "notifications" => "array"
    ];


    public function school()
    {
        return $this->belongsTo(Additional::class, 'school_id', 'id');
    }

    public function position()
    {
        return $this->belongsTo(Group::class, 'current_position');
    }

}