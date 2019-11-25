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
    return redirect('/home');
});
Route::get('/home', function () {
    // return redirect('');
    return view('home');
});
// Route::get('/home',function(){
//     return view('home');
// });
// Route::get('/home',[
//     'as' => 'home',
//     'uses' =>function(){
//         return view('home');}
// ]);
#   로그인 

Route::resources([
    '/register' => 'UsersController',
    '/login' => 'LoginController',
    '/home' => 'HomeController',
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


