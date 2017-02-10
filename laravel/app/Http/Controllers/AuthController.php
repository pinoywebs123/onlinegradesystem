<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

use App\User;

class AuthController extends Controller
{
	use ThrottlesLogins;
    
	public function student_login(){
		if( Auth::check() ){
			if(Auth::user()->role->name === 'student'){
			 	return redirect()->intended('/student/main');
			 }
			 	return redirect()->intended('teacher/main'); 

		}else{
			 return view('auth.login');
		}
	}

	public function student_loginHandler(Request $request){

		$this->validate($request, [
				'student_id' => 'required', 
				'password' => 'required'
				
			]);
		$student_id = $request['student_id'];
		$password = $request['password'];
		

		if($this->hasTooManyLoginAttempts($request)){
			$this->fireLockoutEvent($request);
			return $this->sendLockoutResponse($request);
		}


		if(Auth::attempt(['id'=> $student_id, 'password'=> $password])){
			$request->session()->regenerate();
			$this->clearLoginAttempts($request);

			 if(Auth::user()->role->name === 'student'){
			 	return redirect()->intended('/student/main');
			 }
			 	return redirect()->intended('teacher/main');
		}else{
			$this->incrementLoginAttempts($request);
			return redirect()->back()->withErrors(['student_id'=> Lang::get('auth.failed')]);
		}

		
	}


	public function username()
    {
        return 'student_id';
    }


    public function logout(){
    	Auth::logout();
    	return redirect()->route('auth_login');
    }


    public function register(){
    	return view('auth.register');
    }

    public function registerHandle(Request $request){
    	$this->validate($request, [
    			'student_id' => 'required',
    			'email' => 'required|unique:users',
    			'contact' => 'required',
    			'fname' => 'required',
    			'mname' => 'required',
    			'lname' => 'required',
    			'password' => 'required',
    			'password2' => 'required|same:password'
    		]);

    		$user = new User;
    		$user->id = $request['student_id'];
    		$user->password = bcrypt($request['passwor']);
    		$user->first_name = $request['fname'];
    		$user->middle_name = $request['mname'];
    		$user->last_name = $request['lname'];
    		$user->email = $request['email'];
    		$user->contact = $request['contact'];
    		
    }

    public function register_teacher(){
    	return view('auth.register_teacher');
    }



}
