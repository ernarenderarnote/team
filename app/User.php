<?php

namespace App;

use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name', 'date_of_birth', 'email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     *  Get User with role 
     */
    public function scopeGetUserWithRole($q, $role)
    {
        return $q->whereHas('roles', function($q) use($role){
            $q->where('name', $role);
        });
    }

    public function getClientIdAttribute()
    {
        return session()->get('client_id');
    }

    public function details()
    {
        return $this->hasOne(UserDetail::class, 'user_id');
    }

    public function token()
    {
        return $this->hasMany(UserToken::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function userAction()
    {
        return $this->hasMany(UserAction::class);
    }

    public function getNameAttribute()
    {
        return $this->name = $this->first_name . ' ' . $this->last_name;
    }

    public function client(){
        return $this->hasMany(User::class, 'reference_id');
    }

    public function getUserId(){
        return auth()->id();
    }

    public function getClient(){
        return [];//Client::whereRememberToken(auth()->user()->remember_token)->first();
    }

    public function getUser(){

        if(empty(auth()->user()->reference_id))
            return auth()->user();
        return User::find(auth()->user()->reference_id);
    }

    public function cart(){
        return $this->hasOne(Cart::class, "educator_id");
    }

}