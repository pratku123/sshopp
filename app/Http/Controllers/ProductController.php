<?php

namespace App\Http\Controllers;
use View;
use DateTime;
use Illuminate\Http\Request;
use App\Product;
use App\User;
use App\Http\Requests;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Session;
use Redirect;
class ProductController extends Controller
{
	 public function index()
     {
 		//return "Hello World";
		$prod=Product::all();
		return View::make('index')->with('prod',$prod);
     }
	 
	 
	 public function all()
	 {
	    $prod=Product::all();
		
		return response()->json(array('errors' => 'none','access'=> 'true','message' => 'errors not found','data'=>$prod));
	 }
	 
	 
	 public function view_id($id)
	 {
	    //return $id;
	    $user_l=0;
		$validator = Validator::make(Input::all(), Product::$rules4);
        // process the login and check if the entered user has access to create a new product
        if ($validator->fails()) 
		{
            $err=$validator->errors()->all();
			return response()->json(array
			(
			'errors' => $err,
			'access'=> 'false',
			'message' => 'errors found',
			'data'=>"null"
			));
        }
        else
        { 		
		  $secret_key1=Input::get('client_secret1');//Both these are required
		  $secret_key2=Input::get('client_secret2');
	      $user=User::where('Secret_key1',$secret_key1)->where('Secret_key2',$secret_key2)->first();
		  if($user==null)
	      {
			$err=array('authentication error, check client secret keys');
			return response()->json(array('errors' => $err,'access'=> 'false','message' => 'errors found','data'=>'null'));
	      }
	      $product = Product::find($id);
	      if($product==null)
		  return response()->json(array('errors'=>'true','access'=>'true','message'=>'Invalid product id','data'=>$product));
		  else
          return response()->json(array('errors'=>'none','access'=>'true','message'=>'errors not found','data'=>$product));
		}
	 }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
     public function create()                             
     {   
		return View::make('create');
     }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
	 
      public function new_(Request $request)//Rest API for creating a new product  Returns JSON reponse
	  {
	  $validator = Validator::make(Input::all(), Product::$rules3);
        // process the login and check if the entered user has access to create a new product
        if ($validator->fails()) 
		{
            $err=$validator->errors()->all();
			return response()->json(array
			(
			'errors' => $err,
			'access'=> 'false',
			'message' => 'errors found',
			'data'=>"NULL"
			));
        } 
		else 
		{   
              //$prod=Product::find(Input::get('id'));//id is also required
			 // if($prod==null)
			  //{
			   // $err=array('Invalid product id');
			   // return response()->json(array('errors' => $err,'access'=> 'true','message' => 'errors found','data'=>null));
			  
			//  }
			  $user_l=0;
			  $secret_key1=Input::get('client_secret1');//Both these are required
			  $secret_key2=Input::get('client_secret2');
			 $prod=new Product;
			  $user=User::where('Secret_key1',$secret_key1)->where('Secret_key2',$secret_key2)->first();
			  //return $user;
			  if($user==null)
			  {
			    $err=array('authentication error, check client secret keys');
			    return response()->json(array('errors' => $err,'access'=> 'false','message' => 'errors found','data'=>'null'));
			  }
			  else
			  {
			  
			      $user_l=$user->user_level;
				  $err=array('No access');
				  if($user_l>2)
				  return response()->json(array('errors' => $err,'access'=> 'false','message' => 'Only super admins and admins can access this','data'=>'null'));
				 //return $user_l;
			  }
       		  if($request->has('title'))
		      {
			     $name=Input::get('title');
			     $prod->title=$name;
			  } 
			  if($request->has('company'))
	          {
			    $company=Input::get('company');
			    $prod->company=$company;
              }
			  if($request->has('cost'))
			  {
		        $cost=Input::get('cost');
				$prod->cost=$cost;
		      }
			  if($request->has('description'))
			  {
			    $desc=Input::get('description');
				$prod->description=$desc;
			  }
			$prod->created_at=new DateTime();
			$prod->updated_at=new DateTime();
            $prod->save();
            return response()->json(array('errors' => 'none','access'=> 'true','message' => 'created successfully','data'=>$prod));		
            //Session::flash('message', 'Successfully updated the product!');
            //return Redirect::to('products');
        }
          	//return Input::get('id');
            //	return "update";
	     
	  }
    public function store(Request $request)     
    {                                           
//	return "store";
		$validator = Validator::make(Input::all(), Product::$rules);
        // process the login and check if the entered user has access to create a new product
        if ($validator->fails()) 
		{
            //return Redirect::to('')
//                ->withErrors($validator)
  //              ->withInput(Input::except('password'));
            $err=$validator->errors()->all();
			return response()->json(array
			(
			'errors' => $err,
			'access'=> 'true',
			'message' => 'errors_found',
			'data'=>"NULL"
			));
        } 
		else 
		{
		      $name=$request->input('title');
	          $company=$request->input('company');
		      $cost=$request->input('cost');
			  $desc=$request->input('description');
              $prod=new Product;
              $prod->title=$name;
              $prod->company=$company;
              $prod->cost=$cost;
			$prod->description=$desc;
			$prod->created_at=new DateTime();
			$prod->updated_at=new DateTime();
            $prod->save();
            return response()->json(array('errors' => 'none','access'=> 'true','message' => 'errors not found','data'=>$prod));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
		$products = Product::find($id);
		if($products==null)
		return View::make('nothing');
		else
		return View::make('show')->with('product',$products);
	   // if($product==null)
	//	return response()->json(array('errors'=>'true','access'=>'true','message'=>'Invalid product id','data'=>$product));
		//else
        //return response()->json(array('errors'=>'none','access'=>'true','message'=>'errors not found','data'=>$product));
       // return View::make('show')
         //   ->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
		$product = Product::find($id);
//return $product;//correct
        return View::make('edit')
            ->with('prod', $product)->with('id1',$id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
	 public function modify(Request $request)
	 {
	     $validator = Validator::make(Input::all(), Product::$rules2);
        // process the login and check if the entered user has access to create a new product
        if ($validator->fails()) 
		{
            $err=$validator->errors()->all();
			return response()->json(array
			(
			'errors' => $err,
			'access'=> 'false',
			'message' => 'errors found',
			'data'=>"NULL"
			));
        } 
		else 
		{   
              $prod=Product::find(Input::get('id'));//id is also required
			  if($prod==null)
			  {
			    $err=array('Invalid product id');
			    return response()->json(array('errors' => $err,'access'=> 'true','message' => 'errors found','data'=>null));
			  
			  }
			  $user_l=0;
			  $secret_key1=Input::get('client_secret1');//Both these are required
			  $secret_key2=Input::get('client_secret2');
			 
			  $user=User::where('Secret_key1',$secret_key1)->where('Secret_key2',$secret_key2)->first();
			  //return $user;
			  if($user==null)
			  {
			    $err=array('authentication error, check client secret keys');
			    return response()->json(array('errors' => $err,'access'=> 'false','message' => 'errors found','data'=>null));
			  }
			  else
			  {
			  
			      $user_l=$user->user_level;
				  $err=array('No access');
				  if($user_l>2)
				  return response()->json(array('errors' => $err,'access'=> 'false','message' => 'Only super admins and admins can access this','data'=>'null'));
				 //return $user_l;
			  }
       		  if($request->has('title'))
		      {
			     $name=Input::get('title');
			     $prod->title=$name;
			  } 
			  if($request->has('company'))
	          {
			    $company=Input::get('company');
			    $prod->company=$company;
              }
			  if($request->has('cost'))
			  {
		        $cost=Input::get('cost');
				$prod->cost=$cost;
		      }
			  if($request->has('description'))
			  {
			    $desc=Input::get('description');
				$prod->description=$desc;
			  }
			//$prod->created_at=new DateTime();
			$prod->updated_at=new DateTime();
            $prod->save();
            return response()->json(array('errors' => 'none','access'=> 'true','message' => 'update successful','data'=>$prod));		
            //Session::flash('message', 'Successfully updated the product!');
            //return Redirect::to('products');
        }
          	//return Input::get('id');
            //	return "update";
              
	 }
    public function update($id)
    {
			
			$validator = Validator::make(Input::all(), Product::$rules);
        // process the login and check if the entered user has access to create a new product
        if ($validator->fails()) 
		{
            //return Redirect::to('')
//                ->withErrors($validator)
  //              ->withInput(Input::except('password'));
            $err=$validator->errors()->all();
			return response()->json(array
			(
			'errors' => $err,
			'access'=> 'true',
			'message' => 'errors_found',
			'data'=>"NULL"
			));
        } 
		else 
		{
		      $name=Input::get('title');
	          $company=Input::get('company');
		      $cost=Input::get('cost');
			  $desc=Input::get('description');
            $prod=Product::find(Input::get('id'));
			if($prod==null)
			return "Invalid id, but return a JSON object with fields";
            $prod->title=$name;
            $prod->company=$company;
            $prod->cost=$cost;
			$prod->description=$desc;
			//$prod->created_at=new DateTime();
			$prod->updated_at=new DateTime();
            $prod->save();
            return response()->json(array('errors' => 'none','access'=> 'true','message' => 'errors not found','data'=>$prod));		
            //Session::flash('message', 'Successfully updated the product!');
            //return Redirect::to('products');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
	    $prod = Product::find($id);
        $prod->delete();
        //Session::flash('message', 'Successfully deleted the product!');
        return Redirect::to('products');
    }
	public function remove($id)
	{
	  $user_l=0;
		$validator = Validator::make(Input::all(), Product::$rules4);
        // process the login and check if the entered user has access to create a new product
        if ($validator->fails()) 
		{
            $err=$validator->errors()->all();
			return response()->json(array
			(
			'errors' => $err,
			'access'=> 'false',
			'message' => 'errors found',
			'data'=>"null"
			));
        }
        else
        { 		
		  $secret_key1=Input::get('client_secret1');//Both these are required
		  $secret_key2=Input::get('client_secret2');
	      $user=User::where('Secret_key1',$secret_key1)->where('Secret_key2',$secret_key2)->first();
		  if($user==null)
	      {
			$err=array('authentication error, check client secret keys');
			return response()->json(array('errors' => $err,'access'=> 'false','message' => 'errors found','data'=>'null'));
	      }
		  else
		  {
                  $user_l=$user->user_level;
				  $err=array('No access');
				  if($user_l>2)
				  return response()->json(array('errors' => $err,'access'=> 'false','message' => 'Only super admins and admins can access this','data'=>'null')); 		  
		  }
	      $product = Product::find($id);
	      if($product==null)
		  return response()->json(array('errors'=>'true','access'=>'true','message'=>'Invalid product id','data'=>$product));
		  else
		  {
		   $product->delete();
           return response()->json(array('errors'=>'none','access'=>'true','message'=>'Product deleted successfully','data'=>$product));
		  }
		}
	}
}
