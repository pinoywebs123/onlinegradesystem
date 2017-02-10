<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;	
use Illuminate\Support\Facades\DB;


use App\User;
use App\Teacher_Student;
use App\Grade;
use App\firstgrade;
use App\secondgrade;
use App\thirdgrade;
use App\newsfeed;
use App\finalgrade;

class TeacherController extends Controller
{
   
    public function checkUser(){
    	if(Auth::check()){
    		if(Auth::user()->role->name != 'teacher'){
	    		return redirect()->route('auth_login');
	    		die();
	    	}
    	}else{
    		return redirect()->route('auth_login');
    		die();
    	}
    }

    public function main(){
    	if($this->checkUser()){
    		return $this->checkUser();
    	}
        $newsfeed = newsfeed::orderBy('id', 'desc')->paginate(5);
    	return view('teacher.main', compact('newsfeed'));
    }

    public function teacher_edit(){
        $edits = User::where('id', Auth::id())->get();

        return view('teacher.edit', compact('edits'));
    }

    public function teacher_setting(){
        return view('teacher.setting');
    }

    public function teacher_class(){
        if($this-> checkUser() ){
            return $this->checkUser();
        }
        $teacher_student = Teacher_Student::where('teacher_id', Auth::id())->where('status', 0)->paginate(7);

        return view('teacher.class', compact('teacher_student'));
        
    }

    public function add_teacher(){
          $id = Auth::id();

        if( $this->checkUser() ){
            return $this->checkUser();
        }
        
      
         $counts = DB::select("select year from teacher__students where teacher_id = $id and status = 1  group by year ");
        

        return view('teacher.summary', compact('counts'));
    }
    public function summary_class($year){
       $summary_class = Teacher_Student::where('status',1)->where('year', $year)->where('teacher_id',Auth::id())->get();
       return view('teacher.summary_class', compact('summary_class'));
    }

    public function add_student(){
         if( $this->checkUser() ){
            return $this->checkUser();
        }

        return view('teacher.add_student');
    }

    public function add_studentHandler(Request $request){
        if( $this->checkUser() ){
            return $this->checkUser();
        }

        $this->validate($request, [
                'student_id'=> 'required',
                'level'=> 'required',
                'room'=> 'required',
                'lname'=> 'required',
                'fname' => 'required',
                'mname'=> 'required'
            ]);
        $teacher_student = new Teacher_Student;
        $teacher_student->teacher_id = Auth::id();
        $teacher_student->user_id = $request['student_id'];
        $teacher_student->last_name = $request['lname'];
        $teacher_student->first_name =  $request['fname'];
        $teacher_student->middle_name =  $request['mname'];
        $teacher_student->level = $request['level'];
        $teacher_student->room_number = $request['room'];
        $teacher_student->status = 0;
        $teacher_student->year = date('Y');

        $teacher_student->save();

        if($teacher_student){
            $args = 'Student Added in the Class Successfully..!';
            return redirect()->back()->with(['message'=> $args]);
        }else{
            $args = 'Failed to add student in the Class!';
            return redirect()->back()->with(['failed'=> $args]);
        }

    }

    public function add_student_grade($student_id, $level){
        if( $this->checkUser() ){
            return $this->checkUser();
        }
        $student = Teacher_Student::where('user_id', $student_id)->where('status', 0)->get();
        $firstgrade = firstgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->get();
        $secondgrade = secondgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->get();
        $thirdgrade = thirdgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->get();
        $finalgrade = finalgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->get();

        if(count($firstgrade) > 0){
            if(count($secondgrade) > 0){
                if(count($thirdgrade) > 0){
                    if(count($finalgrade) > 0){
                        return view('teacher.student_grade4', compact('student', 'firstgrade','secondgrade', 'thirdgrade','finalgrade'));
                    }
                   return view('teacher.student_grade3', compact('student', 'firstgrade','secondgrade', 'thirdgrade')); 
                }
                return view('teacher.student_grade2', compact('student', 'firstgrade','secondgrade'));
            }
            return view('teacher.student_grade', compact('student', 'firstgrade'));
        }
        return view('teacher.student_empty_grade', compact('student'));
        
    }


    public function input_handler(Request $request, $student_id, $level){
        $this->validate($request, [
            '1f' => 'required',
            '2f' => 'required',
            '3f' => 'required',
            '4f' => 'required',
            '5f' => 'required',
            '6f' => 'required',
            '7f' => 'required',
            '8f' => 'required',
            '9f' => 'required',
            '10f' => 'required',
            '11f' => 'required',
            '12f' => 'required',
            '13f' => 'required'
            ]);

    firstgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 1, 'grade'=> $request['1f'],'status'=> 0]);
    firstgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 2, 'grade'=> $request['2f'],'status'=> 0]);
    firstgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 3, 'grade'=> $request['3f'],'status'=> 0]);
    firstgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 4, 'grade'=> $request['4f'],'status'=> 0]);
    firstgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 5, 'grade'=> $request['5f'],'status'=> 0]);
    firstgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 6, 'grade'=> $request['6f'],'status'=> 0]);
    firstgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 7, 'grade'=> $request['7f'],'status'=> 0]);
    firstgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 8, 'grade'=> $request['8f'],'status'=> 0]);
    firstgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 9, 'grade'=> $request['9f'],'status'=> 0]);
    firstgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 10, 'grade'=> $request['10f'],'status'=> 0]);
    firstgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 11, 'grade'=> $request['11f'],'status'=> 0]);
    firstgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 12, 'grade'=> $request['12f'],'status'=> 0]);
    firstgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 13, 'grade'=> $request['13f'],'status'=> 0]);

   return redirect()->back()->with(['ok'=> 'Grade Submitted Successfully..!']);
      
    }

    public function input_handler2(Request $request, $student_id, $level){

         $this->validate($request, [
            '1s' => 'required',
            '2s' => 'required',
            '3s' => 'required',
            '4s' => 'required',
            '5s' => 'required',
            '6s' => 'required',
            '7s' => 'required',
            '8s' => 'required',
            '9s' => 'required',
            '10s' => 'required',
            '11s' => 'required',
            '12s' => 'required',
            '13s' => 'required'
            ]);

    secondgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 1, 'grade'=> $request['1s'],'status'=> 0]);
    secondgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 2, 'grade'=> $request['2s'],'status'=> 0]);
    secondgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 3, 'grade'=> $request['3s'],'status'=> 0]);
    secondgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 4, 'grade'=> $request['4s'],'status'=> 0]);
    secondgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 5, 'grade'=> $request['5s'],'status'=> 0]);
    secondgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 6, 'grade'=> $request['6s'],'status'=> 0]);
    secondgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 7, 'grade'=> $request['7s'],'status'=> 0]);
    secondgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 8, 'grade'=> $request['8s'],'status'=> 0]);
    secondgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 9, 'grade'=> $request['9s'],'status'=> 0]);
    secondgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 10, 'grade'=> $request['10s'],'status'=> 0]);
    secondgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 11, 'grade'=> $request['11s'],'status'=> 0]);
    secondgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 12, 'grade'=> $request['12s'],'status'=> 0]);
    secondgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 13, 'grade'=> $request['13s'],'status'=> 0]);
    return redirect()->back()->with(['ok'=> 'Grade Submitted Successfully..!']);
    }

    public function input_handler3(Request $request, $student_id, $level){

         $this->validate($request, [
            '1t' => 'required',
            '2t' => 'required',
            '3t' => 'required',
            '4t' => 'required',
            '5t' => 'required',
            '6t' => 'required',
            '7t' => 'required',
            '8t' => 'required',
            '9t' => 'required',
            '10t' => 'required',
            '11t' => 'required',
            '12t' => 'required',
            '13t' => 'required'
            ]);

    thirdgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 1, 'grade'=> $request['1t'],'status'=> 0]);
    thirdgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 2, 'grade'=> $request['2t'],'status'=> 0]);
    thirdgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 3, 'grade'=> $request['3t'],'status'=> 0]);
    thirdgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 4, 'grade'=> $request['4t'],'status'=> 0]);
    thirdgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 5, 'grade'=> $request['5t'],'status'=> 0]);
    thirdgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 6, 'grade'=> $request['6t'],'status'=> 0]);
    thirdgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 7, 'grade'=> $request['7t'],'status'=> 0]);
    thirdgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 8, 'grade'=> $request['8t'],'status'=> 0]);
    thirdgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 9, 'grade'=> $request['9t'],'status'=> 0]);
    thirdgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 10, 'grade'=> $request['10t'],'status'=> 0]);
    thirdgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 11, 'grade'=> $request['11t'],'status'=> 0]);
    thirdgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 12, 'grade'=> $request['12t'],'status'=> 0]);
    thirdgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 13, 'grade'=> $request['13t'],'status'=> 0]);

    return redirect()->back()->with(['ok'=> 'Grade Submitted Successfully..!']);
    }

     public function input_final(Request $request, $student_id, $level){

         $this->validate($request, [
            '1l' => 'required',
            '2l' => 'required',
            '3l' => 'required',
            '4l' => 'required',
            '5l' => 'required',
            '6l' => 'required',
            '7l' => 'required',
            '8l' => 'required',
            '9l' => 'required',
            '10l' => 'required',
            '11l' => 'required',
            '12l' => 'required',
            '13l' => 'required'
            ]);

    finalgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 1, 'grade'=> $request['1l'],'status'=> 0]);
    finalgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 2, 'grade'=> $request['2l'],'status'=> 0]);
    finalgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 3, 'grade'=> $request['3l'],'status'=> 0]);
    finalgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 4, 'grade'=> $request['4l'],'status'=> 0]);
    finalgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 5, 'grade'=> $request['5l'],'status'=> 0]);
    finalgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 6, 'grade'=> $request['6l'],'status'=> 0]);
    finalgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 7, 'grade'=> $request['7l'],'status'=> 0]);
    finalgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 8, 'grade'=> $request['8l'],'status'=> 0]);
    finalgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 9, 'grade'=> $request['9l'],'status'=> 0]);
    finalgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 10, 'grade'=> $request['10l'],'status'=> 0]);
    finalgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 11, 'grade'=> $request['11l'],'status'=> 0]);
    finalgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 12, 'grade'=> $request['12l'],'status'=> 0]);
    finalgrade::create(['user_id'=> Auth::id(),'student_id'=> $student_id, 'level'=> $level, 'subject_id'=> 13, 'grade'=> $request['13l'],'status'=> 0]);
    
    return redirect()->back()->with(['ok'=> 'Grade Submitted Successfully..!']);
    }



    public function newsfeed_handler(Request $request){
            $this->validate($request, [
                'news'=> 'required'
                ]);
            $newsfeed = new newsfeed;
            $newsfeed->user_id = Auth::id();
            $newsfeed->news = $request['news'];
            $newsfeed->save();

            if($newsfeed){
                $args = array('ok'=> 'Posted Successfully..');
                return redirect()->back()->with($args);
            }else{
                return redirect()->back()->withErrors(['news'=> 'Opps somthing wrong try again later.']);
            }
    }

public function delete_class(Request $request, $student_id){
    $delete = Teacher_Student::where('user_id', $student_id)->delete();
    if($delete){
        return redirect()->back()->with(['delete'=> 'Student Deleted Successfully..!']);
    }
}

public function edit_class(Request $request, $student_id){
    $editclass = Teacher_Student::where('user_id', $student_id)->get();
    return view('teacher.editclass', compact('editclass'));
}

public function update_class(Request $request, $student_id){
    $this->validate($request, [
                'student_id'=> 'required',
                'level'=> 'required',
                'room'=> 'required',
                'lname'=> 'required',
                'fname' => 'required',
                'mname'=> 'required'
            ]);
       
         $update = Teacher_Student::where('user_id', $student_id)->update([
            'user_id'=> $request['student_id'], 
            'last_name'=> $request['lname'],
            'first_name'=> $request['fname'],
            'middle_name'=> $request['mname'],
            'level'=> $request['level'],
            'room_number'=> $request['room']

            ]);   
         if($update){
           return redirect()->route('teacher_class')->with(['update'=> 'Student Information Updated Successfully..!']);
         }
}

public function new_student($level, $room){
    $teacher_student = teacher_student::where('teacher_id', Auth::id())->where('level', $level)->where('room_number', $room)->where('status', 0)->update(['status'=> 1]);
    $firstgrade = firstgrade::where('user_id', Auth::id())->where('level', $level)->where('status', 0)->update(['status'=> 1]);
    $secondgrade = secondgrade::where('user_id', Auth::id())->where('level', $level)->where('status', 0)->update(['status'=> 1]);
    $thirdgrade = thirdgrade::where('user_id', Auth::id())->where('level', $level)->where('status', 0)->update(['status'=> 1]);
    $finalgrade = finalgrade::where('user_id', Auth::id())->where('level', $level)->where('status', 0)->update(['status'=> 1]);

    $args = array('new_student'=> 'I hope you will enjoy your another year of teaching god bless Teachers!!');
    return redirect()->back()->with($args);
}

public function edit_student_grade($student_id, $level){
$student = Teacher_Student::where('user_id', $student_id)->where('status', 0)->get();
$firstgrade = firstgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->get();
return view('teacher.edit_grade_first', compact('student', 'firstgrade'));
}

public function edit_student_grade2($student_id, $level){
$student = Teacher_Student::where('user_id', $student_id)->where('status', 0)->get();
$secondgrade = secondgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->get();
return view('teacher.edit_grade_second', compact('student', 'secondgrade'));
}

public function edit_student_grade3($student_id, $level){
$student = Teacher_Student::where('user_id', $student_id)->where('status', 0)->get();
$thirdgrade = thirdgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->get();
return view('teacher.edit_grade_third', compact('student', 'thirdgrade'));
}

public function edit_student_grade4($student_id, $level){
$student = Teacher_Student::where('user_id', $student_id)->where('status', 0)->get();
$finalgrade = finalgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->get();
return view('teacher.edit_grade_final', compact('student', 'finalgrade'));
}

public function edit_student_editHandle($student_id, $level, Request $request){
$firstgrade = firstgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 1)->update([
        'grade'=> $request['1f']

    ]);
$firstgrade = firstgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 2)->update([
        'grade'=> $request['2f']

    ]);
$firstgrade = firstgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 3)->update([
        'grade'=> $request['3f']

    ]);
$firstgrade = firstgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 4)->update([
        'grade'=> $request['4f']

    ]);
$firstgrade = firstgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 5)->update([
        'grade'=> $request['5f']

    ]);
$firstgrade = firstgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 6)->update([
        'grade'=> $request['6f']

    ]);
$firstgrade = firstgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 7)->update([
        'grade'=> $request['7f']

    ]);
$firstgrade = firstgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 8)->update([
        'grade'=> $request['8f']

    ]);
$firstgrade = firstgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 9)->update([
        'grade'=> $request['9f']

    ]);
$firstgrade = firstgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 10)->update([
        'grade'=> $request['10f']

    ]);
$firstgrade = firstgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 11)->update([
        'grade'=> $request['11f']

    ]);
$firstgrade = firstgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 12)->update([
        'grade'=> $request['12f']

    ]);
$firstgrade = firstgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 13)->update([
        'grade'=> $request['13f']

    ]);

if($firstgrade){
    $args = array('update'=> 'Grades Updated Successfully..!');
    return redirect()->back()->with($args);
}


}
public function edit_student_editHandle2($student_id, $level, Request $request){
$secondgrade = secondgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 1)->update([
        'grade'=> $request['1s']

    ]);
$secondgrade = secondgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 2)->update([
        'grade'=> $request['2s']

    ]);
$secondgrade = secondgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 3)->update([
        'grade'=> $request['3s']

    ]);
$secondgrade = secondgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 4)->update([
        'grade'=> $request['4s']

    ]);
$secondgrade = secondgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 5)->update([
        'grade'=> $request['5s']

    ]);
$secondgrade = secondgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 6)->update([
        'grade'=> $request['6s']

    ]);
$secondgrade = secondgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 7)->update([
        'grade'=> $request['7s']

    ]);
$secondgrade = secondgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 8)->update([
        'grade'=> $request['8s']

    ]);
$secondgrade = secondgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 9)->update([
        'grade'=> $request['9s']

    ]);
$secondgrade = secondgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 10)->update([
        'grade'=> $request['10s']

    ]);
$secondgrade = secondgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 11)->update([
        'grade'=> $request['11s']

    ]);
$secondgrade = secondgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 12)->update([
        'grade'=> $request['12s']

    ]);
$secondgrade = secondgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 13)->update([
        'grade'=> $request['13s']

    ]);

if($secondgrade){
    $args = array('update'=> 'Grades Updated Successfully..!');
    return redirect()->back()->with($args);
}


}

public function edit_student_editHandle3($student_id, $level, Request $request){
$thirdgrade = thirdgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 1)->update([
        'grade'=> $request['1t']

    ]);
$thirdgrade = thirdgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 2)->update([
        'grade'=> $request['2t']

    ]);
$thirdgrade = thirdgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 3)->update([
        'grade'=> $request['3t']

    ]);
$thirdgrade = thirdgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 4)->update([
        'grade'=> $request['4t']

    ]);
$thirdgrade = thirdgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 5)->update([
        'grade'=> $request['5t']

    ]);
$thirdgrade = thirdgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 6)->update([
        'grade'=> $request['6t']

    ]);
$thirdgrade = thirdgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 7)->update([
        'grade'=> $request['7t']

    ]);
$thirdgrade = thirdgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 8)->update([
        'grade'=> $request['8t']

    ]);
$thirdgrade = thirdgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 9)->update([
        'grade'=> $request['9t']

    ]);
$thirdgrade = thirdgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 10)->update([
        'grade'=> $request['10t']

    ]);
$thirdgrade = thirdgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 11)->update([
        'grade'=> $request['11t']

    ]);
$thirdgrade = thirdgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 12)->update([
        'grade'=> $request['12t']

    ]);
$thirdgrade = thirdgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 13)->update([
        'grade'=> $request['13t']

    ]);

if($thirdgrade){
    $args = array('update'=> 'Grades Updated Successfully..!');
    return redirect()->back()->with($args);
}


}
public function edit_student_editHandle4($student_id, $level, Request $request){
$finalgrade = finalgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 1)->update([
        'grade'=> $request['1fs']

    ]);
$finalgrade = finalgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 2)->update([
        'grade'=> $request['2fs']

    ]);
$finalgrade = finalgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 3)->update([
        'grade'=> $request['3fs']

    ]);
$finalgrade = finalgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 4)->update([
        'grade'=> $request['4fs']

    ]);
$finalgrade = finalgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 5)->update([
        'grade'=> $request['5fs']

    ]);
$finalgrade = finalgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 6)->update([
        'grade'=> $request['6fs']

    ]);
$finalgrade = finalgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 7)->update([
        'grade'=> $request['7fs']

    ]);
$finalgrade = finalgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 8)->update([
        'grade'=> $request['8fs']

    ]);
$finalgrade = finalgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 9)->update([
        'grade'=> $request['9fs']

    ]);
$finalgrade = finalgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 10)->update([
        'grade'=> $request['10fs']

    ]);
$finalgrade = finalgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 11)->update([
        'grade'=> $request['11fs']

    ]);
$finalgrade = finalgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 12)->update([
        'grade'=> $request['12fs']

    ]);
$finalgrade = finalgrade::where('student_id', $student_id)->where('level', $level)->where('status', 0)->where('subject_id', 13)->update([
        'grade'=> $request['13fs']

    ]);



if($finalgrade){
    $args = array('update'=> 'Grades Updated Successfully..!');
    return redirect()->back()->with($args);
}


}





}
