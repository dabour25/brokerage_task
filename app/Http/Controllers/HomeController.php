<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\ahmed_trait;
use Auth;
use Str;
//DB Connect
use App\Customers;
use App\User;

class HomeController extends Controller
{
    //Use Trait
    use ahmed_trait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $customers=Customers::join('users','users.id','=','customers.user_id')
        ->select('customers.*','users.email')->paginate(20);
        return view('home',compact('customers'));
    }
    //when URL Call trait
    public function trait(){
        $customers=$this->getCustomers();
        $actions=$this->getActions();
        return response()->json(['customers'=>$customers,'actions'=>$actions],200, [], JSON_UNESCAPED_UNICODE);
    }
    public function changephoto(Request $req){
        $valarr=[
           'photo'=>'required|max:8192|mimes:jpeg,bmp,png',
        ];
        $this->validate($req,$valarr);
        $user=User::find(Auth::user()->id);
        $photoPath = public_path('/img/brofiles');
        $photoName=Str::random(20);
        $photoName.='.'.$req['photo']->getClientOriginalExtension();
        $req['photo']->move($photoPath,$photoName);
        $user->photos()->create(['url'=>$photoName]);
        return back();
    }
}
