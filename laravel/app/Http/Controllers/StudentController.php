<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\firstgrade;
use App\secondgrade;
use App\thirdgrade;
use App\finalgrade;
use App\User;
use App\newsfeed;

class StudentController extends Controller
{

	

    public function checkUser(){
    	if(Auth::check()){
    		if(Auth::user()->role->name != 'student'){
	    		return redirect()->route('auth_login');
	    		die();
	    	}
    	}else{
    		return redirect()->route('auth_login');
    		die();
    	}
    }

    public function main(){
    	if( $this->checkUser() ){
    		return $this->checkUser();
    	}
        $newsfeed = newsfeed::orderBy('id', 'desc')->paginate(5);
    	return view('student.main', compact('newsfeed'));
    }

    public function student_grade(){
        if( $this->checkUser() ){
            return $this->checkUser();
        }
        $firstgrade = firstgrade::where('student_id',Auth::id())->where('status', 0)->get();
        $secondgrade = secondgrade::where('student_id',Auth::id())->where('status', 0)->get();
        $thirdgrade = thirdgrade::where('student_id',Auth::id())->where('status', 0)->get();
        $finalgrade = finalgrade::where('student_id',Auth::id())->where('status', 0)->get();

      if(count($firstgrade) > 0){
        return view('student.grade', compact('firstgrade', 'secondgrade','thirdgrade','finalgrade'));  
    }else{
        return view('student.empty_grade');
    }
    }

    public function student_record(){
        if( $this->checkUser() ){
            return $this->checkUser();
        }

        $groups = DB::select("select level from firstgrades where status = 1 group by level");
        return view('student.record', compact('groups'));
    }

    public function record_level($level){
        $firstgrade = firstgrade::where('student_id', Auth::id())->where('level', $level)->where('status', 1)->get();
        $secondgrade = secondgrade::where('student_id', Auth::id())->where('level', $level)->where('status', 1)->get();
        $thirdgrade = thirdgrade::where('student_id', Auth::id())->where('level', $level)->where('status', 1)->get();
        $finalgrade = finalgrade::where('student_id', Auth::id())->where('level', $level)->where('status', 1)->get();
        return view('student.record_summary', compact('firstgrade', 'secondgrade', 'thirdgrade', 'finalgrade'));
    }

    public function student_edit(){
        $edits = User::where('id', Auth::id())->get();
        return view('student.edit',compact('edits'));
    }
    public function student_setting(){
        return view('student.setting');
    }

    

    








}
