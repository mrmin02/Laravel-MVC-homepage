<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\Requests\QuestionsRequest; # 질문 등록에 관한 규칙 정의.

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // paginate ( 몇개씩 )
        // $questions = \App\Question::with('user')->latest()->paginate(5);
        $questions = \App\Question::with('user')->latest()->paginate(5);
        return view('question.index',compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // 로그인 하지 않았을 경우 글을 추가 못하게 하기.
        // dump(session()->all()); # 세션에있는 데이터  복사본 ( 덤프 데이터 만들기. )
        
        if(!auth()->check()){
            return redirect('/login');
        }
        return view('question.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     */
    public function store(QuestionsRequest $request)
    {
        //
        // 로그인 정보로
        // dump(session()->all()); # 세션에있는 데이터  복사본 ( 덤프 데이터 보기 -- 디버그 코드. )
        
        if(!auth()->check()){
            return redirect('/login');
        }
        $question = auth()->user()->questions()->create($request->all());
        
        

        return redirect(route('questions.index'))->with('flash_message','작성한 글이 저장되었습니다.');
        // var_dump($question);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $question = \App\Question::findOrFail($id); # 있으면 찾고, 없으면 fail
        $answers = \App\Question::findOrFail($id)->answers()->get();

        return view('question.show',compact(['question','answers']));   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $question = \App\Question::find($id);
        return view('question.edit',compact('question'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionsRequest $request, $id)
    {
        //
        // print($request);
        $question = \App\Question::find($id)->update(['title'=>$request->title,'content'=>$request->content]);
        return redirect()->route('questions.show',[$id])->with('flash_message','글이 수정되었습니다.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $qeustion = \App\Question::find($id)->delete();
        return redirect()->route('questions.index')->with('flash_message','글이 삭제되었습니다.');
    }
}
