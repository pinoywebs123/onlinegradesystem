<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
use App\User;
use App\Role;
use App\Subject;

Route::get('/', function () {
    return view('main');
});







Route::get('/user_role/{id}', function($id){
	return $user_role = User::findOrFail($id)->role->name;
	 
});

Route::get('/auth/login', ['as'=> 'auth_login', 'uses'=> 'AuthController@student_login']);
Route::post('/loginHandler', ['as'=> 'student_loginHandler', 'uses'=> 'AuthController@student_loginHandler']);

Route::get('/student/main', ['as'=> 'student_main', 'uses'=> 'StudentController@main']);
Route::get('/student/grade', ['as'=> 'student_grade', 'uses'=> 'StudentController@student_grade']);
Route::get('/student/record', ['as'=> 'student_record', 'uses'=> 'StudentController@student_record']);
Route::get('/student/edit', ['as'=> 'student_edit', 'uses'=> 'StudentController@student_edit']);
Route::get('/student/settings', ['as'=> 'student_setting', 'uses'=> 'StudentController@student_setting']);



Route::get('/teacher/main', ['as'=> 'teacher_main', 'uses'=> 'TeacherController@main']);
Route::get('/teacher/class', ['as'=> 'teacher_class', 'uses'=> 'TeacherController@teacher_class']);
Route::get('/teacher/edit', ['as'=> 'teacher_edit', 'uses'=> 'TeacherController@teacher_edit']);
Route::get('/teacher/setting', ['as'=> 'teacher_setting', 'uses'=> 'TeacherController@teacher_setting']);


Route::get('/teacher/add-teacher/', ['as'=> 'add_teacher', 'uses'=> 'TeacherController@add_teacher']);
Route::get('/teacher/add-student/', ['as'=> 'add_student', 'uses'=> 'TeacherController@add_student']);
Route::post('/teacher/add-studentHandler/', ['as'=> 'add_studentHandler', 'uses'=> 'TeacherController@add_studentHandler']);
Route::get('/teacher/{student_id}/{level}/input-grades/', ['as'=> 'add_student_grade','uses'=> 'TeacherController@add_student_grade']);
Route::post('teacher/{student_id}/{level}/input-handler', ['as'=> 'input_handler', 'uses'=> 'TeacherController@input_handler']);
Route::post('teacher/{student_id}/{level}/input-handler2', ['as'=> 'input_handler2', 'uses'=> 'TeacherController@input_handler2']);
Route::post('teacher/{student_id}/{level}/input-handler3', ['as'=> 'input_handler3', 'uses'=> 'TeacherController@input_handler3']);
Route::post('teacher/{student_id}/{level}/input-finals', ['as'=> 'input_final', 'uses'=> 'TeacherController@input_final']);


Route::get('/teacher/class/{student_id}', ['as'=> 'delete_class', 'uses'=> 'TeacherController@delete_class']);
Route::get('/teacher/class/edit/{student_id}', ['as'=> 'edit_class', 'uses'=> 'TeacherController@edit_class']);
Route::post('/teacher/class/update/{student_id}', ['as'=> 'update_class', 'uses'=> 'TeacherController@update_class']);
Route::get('/teacher/class/new_student/{level}/{room}', ['as'=> 'new_student', 'uses'=> 'TeacherController@new_student']);

Route::get('/teacher/{student_id}/{level}/edit', ['as'=> 'edit_student_grade', 'uses'=> 'TeacherController@edit_student_grade']);
Route::get('/teacher/{student_id}/{level}/edit2', ['as'=> 'edit_student_grade2', 'uses'=> 'TeacherController@edit_student_grade2']);
Route::get('/teacher/{student_id}/{level}/edit3', ['as'=> 'edit_student_grade3', 'uses'=> 'TeacherController@edit_student_grade3']);
Route::get('/teacher/{student_id}/{level}/edit4', ['as'=> 'edit_student_grade4', 'uses'=> 'TeacherController@edit_student_grade4']);

Route::post('/teacher/{student_id}/{level}/editHandle', ['as'=> 'edit_student_editHandle', 'uses'=> 'TeacherController@edit_student_editHandle']);
Route::post('/teacher/{student_id}/{level}/editHandle2', ['as'=> 'edit_student_editHandle2', 'uses'=> 'TeacherController@edit_student_editHandle2']);
Route::post('/teacher/{student_id}/{level}/editHandle3', ['as'=> 'edit_student_editHandle3', 'uses'=> 'TeacherController@edit_student_editHandle3']);
Route::post('/teacher/{student_id}/{level}/editHandle4', ['as'=> 'edit_student_editHandle4', 'uses'=> 'TeacherController@edit_student_editHandle4']);



Route::get('/summary/class/{year}', ['as'=> 'summary_class', 'uses'=> 'TeacherController@summary_class']);
Route::get('/record/level/{level}', ['as'=> 'record_level', 'uses'=> 'StudentController@record_level']);

Route::post('/newsfeed_handler', ['as'=> 'newsfeed_handler', 'uses'=> 'TeacherController@newsfeed_handler']);
Route::get('/logout', ['as'=> 'logout', 'uses'=> 'AuthController@logout']);

Route::get('/register/student', ['as'=> 'register', 'uses'=> 'AuthController@register']);
Route::get('/register/teacher', ['as'=> 'register_teacher', 'uses'=> 'AuthController@register_teacher']);
Route::post('/registerHandle', ['as'=> 'registerHandle', 'uses'=> 'AuthController@registerHandle']);
