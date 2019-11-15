<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Str;
//DB Connect
use App\Customers;
use App\Actions;

class actionsController extends Controller
{
    public function store(Request $req){
    	$valarr=[
	       'customer'=>'required|exists:customers,slug',
	       'type'=>'required|in:call,visit',
           'details'=>'required|min:5|max:1000',
           'phone_no'=>'required_if:type,call|max:13',
	    ];
	    $this->validate($req,$valarr);
	    $req['user_id']=Auth::user()->id;
	    $req['slug']=Str::slug(substr($req['details'], 0, 5).rand(100, 999));
        $req['customer_id']=Customers::where('slug',$req['customer'])->firstOrFail()->id;
	    Actions::create($req->all());
	    return back()->with('message','Action Created Successfully');
        //If uses Android API
        //return response()->json($message,200, [], JSON_UNESCAPED_UNICODE);
    }

    public function edit($slug){
    	$action=Actions::join('customers','customers.id','=','actions.customer_id')
            ->where('actions.slug', $slug)
            ->select('actions.*','customers.slug as customer_slug','customers.customer_name')->firstOrFail();
    	return view('actions.edit',compact('action'));
        //If uses Android API
        //return response()->json($action,200, [], JSON_UNESCAPED_UNICODE);
    }

    public function update(Request $req,$slug){
    	$valarr=[
           'type'=>'required|in:call,visit',
           'details'=>'required|min:5|max:1000',
           'phone_no'=>'required_if:type,call|max:13',
	    ];
	    $this->validate($req,$valarr);
	    Actions::where('slug',$slug)->update($req->except(['_token','_method']));
	    return back()->with('message', 'Action Updated Successfully');
    }
    public function destroy($slug){
        Actions::where('slug',$slug)->delete();
        return back()->with('message', 'Action Removed Successfully');

    }

    public function show($slug){
        $action=Actions::join('users','users.id','=','actions.user_id')
            ->join('customers','customers.id','=','actions.customer_id')
            ->where('actions.slug',$slug)
            ->select('actions.*','users.email','customers.customer_name','customers.slug as customer_slug')->firstOrFail();
        return view('actions.single',compact('action'));
    }
}
