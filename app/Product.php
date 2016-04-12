<?php

namespace App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
	public static $rules=array(
	'title' =>'required|min:1',
	'company'=>'required',
	'description' => 'required|min:2',
	'cost'=>'required'
	  );
	  public static $rules2=array(
	  'id' => 'required',
	   'client_secret1'=> 'required|min:40|max:40',
	   'client_secret2'=>'required|min:40|max:40'
	  );
	  public static $rules3=array(
	   'title' => 'required',
	   'company' => 'required',
	   'cost'=>'required',
	   'client_secret1'=> 'required|min:40|max:40',
	   'client_secret2'=>'required|min:40|max:40'
	  );
	  public static $rules4=array(
	  'client_secret1'=> 'required|min:40|max:40',
	   'client_secret2'=>'required|min:40|max:40'
	  );
}