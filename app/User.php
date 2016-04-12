<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
	 public static $rules_signup=array(
	 
	 'name'=> 'required|min:2',
	  'email'=>'required|email|unique:users',
	  'password'=>'required|between:8,50|confirmed',
	  'password_confirmation'=>'required|between:8,50',
	  'user_level'=>'integer',
	 );
	 public static $rules_login=array(
	  'email'=>'required|email|unique:users',
	  'password'=>'required|between:8,50'
	 );
    protected $hidden = [
        'password', 'remember_token',
     ];
}
