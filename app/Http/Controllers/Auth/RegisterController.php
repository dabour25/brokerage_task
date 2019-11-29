<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Str;
use Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
			'photo' => ['required','mimes:jpeg,bmp,png','max:8192'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    /*protected function create(array $data)
    {
        $user= User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
		$photo=$data->file('photo');
		$photosPath = public_path('/img/brofiles');
		$photoName=Str::random(20);
		$photoName.='.'.$photo->getClientOriginalExtension();
		$photo->move($photosPath,$photoName);
		$user->photos()->create(['url'=>$photoPath.'/'.$photoName]);
		return $user;
    }*/
	public function register(Request $req){
		$valarr=[
	       'email'=>'required|min:3|max:191|unique:users,email',
	       'password'=>'required|min:8|max:60|regex:/[A-z]*[0-9]+[A-z]*/|confirmed',
		   'photo'=>'required|max:8192|mimes:jpeg,bmp,png',
	    ];
	    $this->validate($req,$valarr);
		$user= User::create([
            'email' => $req['email'],
            'password' => Hash::make($req['password']),
        ]);
		$photoPath = public_path('/img/brofiles');
		$photoName=Str::random(20);
		$photoName.='.'.$req['photo']->getClientOriginalExtension();
		$req['photo']->move($photoPath,$photoName);
		$user->photos()->create(['url'=>$photoName]);
		$credentials = $req->only('email', 'password');
		Auth::attempt($credentials);
		return redirect('/');
	}
}
