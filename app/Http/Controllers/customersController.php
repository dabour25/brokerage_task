<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Str;
//DB Connect
use App\Customers;
use App\Actions;

class customersController extends Controller
{
    public function create(){
    	return view('customers.create');
    }

    public function store(Request $req){
    	$valarr=[
	       'customer_name'=>'required|min:3|max:191|unique:customers,customer_name',
	       'type'=>'required|in:individual,corporate',
	    ];
	    $this->validate($req,$valarr);
	    $req['user_id']=Auth::user()->id;
	    $req['slug']=Str::slug($req['customer_name']);
	    Customers::create($req->all());
	    return back()->with('message', $req['customer_name'].' Created Successfully');
    }

    public function edit($slug){
    	$customer=Customers::where('slug', $slug)->firstOrFail();
    	return view('customers.edit',compact('customer'));
    	//If uses Android API
        //return response()->json($customer,200, [], JSON_UNESCAPED_UNICODE);
    }

    public function update(Request $req,$slug){
    	$valarr=[
	       'customer_name'=>'required|min:3|max:191|unique:customers,customer_name,'.$slug.',slug',
	       'type'=>'required|in:individual,corporate',
	    ];
	    $this->validate($req,$valarr);
	    $req['user_id']=Auth::user()->id;
	    Customers::where('slug',$slug)->update($req->except(['_token','_method']));
	    return back()->with('message', $req['customer_name'].' Updated Successfully');
    }
    public function destroy($slug){
        Customers::where('slug',$slug)->delete();
        return back()->with('message', 'Customer Removed Successfully');

    }

    public function show($slug){
    	$customer=Customers::where('slug', $slug)->firstOrFail();
    	$actions=Actions::join('users','users.id','=','actions.user_id')
    	->where('actions.customer_id',$customer->id)
    	->select('actions.*','users.email')->orderBy('actions.id','DESC')->paginate(20);
    	return view('actions.index',compact('customer','actions'));
    }
}
