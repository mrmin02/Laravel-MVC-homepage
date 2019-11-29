<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

#   메인
Route::get('/', function () {
    return view('home');
});

#   로그인 

Route::resources([
    '/register' => 'UsersController',
    '/login' => 'LoginController',
]);
Route::delete('/login',[
    'as' => 'logout',
    'uses' =>'LoginController@logout',
]);

# Q n A

Route::resource('/questions',"QuestionsController");
Route::resource('/answers',"AnswersController");


# 현지학기제
Route::get('/intros/list', function() {
    $intros = \App\Intro::all();
    return $intros;
});
Route::resource('intros','IntrosController');


# 조원소개

Route::get('/introduce/list', function(){
    $introduces = \App\Member::all();
    return $introduces;
    // return 'aaa';
  
});
 
Route::resource('introduce', 'IntroduceContoller');

# 내 정보
Route::get('/profile',"ProfilesController@index");
Route::get('/profile/{user_id}','ProfilesController@show');
Route::get('/profile/{user_id}/edit_info','ProfilesController@edit_info');

Route::put('/profile/{user_id}/update_info','ProfilesController@update_info');

Route::get('/profile/{user_id}/edit_pwd','ProfilesController@edit_pwd');

Route::put('/profile/{user_id}/update_pwd','ProfilesController@update_pwd');

Route::delete('/profile/{id}','ProfilesController@destroy');
Route::put('/profile/{id}/admin','ProfilesController@put_admin');