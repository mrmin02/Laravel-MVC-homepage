<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return redirect("/profile"."/".auth()->user()->user_id); 
    }


    public function show($id)
    {
        // if(!auth()->check()){
        //     return redirect('/login');
        // }
        if($id != auth()->user()->user_id){
            return redirect("/profile"."/".auth()->user()->user_id); 
            # 나누기 연산으로 착각함.. 0 / a  로  인식해서 오류 발생. 따라서 /profile  /  따로 
        }

        $user_info = \App\User::where('user_id',$id)->find(1);
        return view("profile.index",compact('user_info'));
    }

    # 정보 변경 ( 비밀번호 미포함 )
    public function edit_info($id)
    {
        
        $info = \App\User::where('user_id',$id)->find(1);
        return view('profile.edit_info',compact('info'));

    }
    public function update_info(Request $request, $id)
    {
        //
        // return view('profile.edit_info');

    }

    public function edit_pwd($id)
    {
        //
        return view('profile.edit_pwd');
    }
    public function update_pwd(Request $request, $id)
    {
        //
        // return view('profile.edit_info');

    }


    public function destroy($id)
    {
        //
    }
}
