<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\Requests\AnswersRequest; # 질문 등록에 관한 규칙 정의.

class AnswersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        // $answers = \App\Question::find($request->question_id)->answers()->get();

        // return $answers;
        // print("as");
        $answers = \App\Question::find($request->question_id)->answers()->get();

        return $answers;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return redirect()->route('questions.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnswersRequest $request)
    {
        //
        // return print("ddd");
        // dump(session()->all()); # 세션에있는 데이터  복사본 ( 덤프 데이터 보기.- 디버그 코드 )
    
        if (!auth()->check()){
            return ;
        }

        $answer = auth()->user()->answers()->create($request->all());
        $answers = \App\Question::find($request->question_id)->answers()->get();

        return $answers;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) # 사용 X
    {
        return redirect()->route('questions.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) # 사용 X
    {
        return redirect()->route('questions.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AnswersRequest $request, $id)
    {
        //
        $answerUpdata = \App\Answer::find($id)->update(['content'=>$request->content]);
        // if (! $answerUpdata){
        //     return response()->json([]);
        // }
        $answers = \App\Question::find($request->question_id)->answers()->get();

        return $answers;
        // print()
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        //
        \App\Answer::find($id)->delete();
        $answers = \App\Question::find($request->question_id)->answers()->get();

        // return response()->json(['data'=>$answers]);
        return $answers;
        
        

    }
}
