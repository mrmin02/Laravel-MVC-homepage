@extends('layouts.app')

@section('content')
<div class="container">
    <h1>포럼글 목록</h1>
    <hr/>
    <ul>
    @forelse($questions as $question)
        <li>
            <a href="{{route('questions.show',[$question->id])}}">{{ $question->title }}</a>
            <small>
                by {{ $question->user->name}}
            </small>
        </li>
    @empty
        <p>글이 없습니다.</p>
    @endforelse
    </ul>
</div>

@if($questions->count())
    <div class="text-center"> 
    {{--css 가 bootstrap 에 설정되어 있고, 필요하면 가져다가 넣으면 됨.--}}
    {{--https://getbootstrap.com/docs/4.3/getting-started/introduction/--}}
    {{--public 의 app.js 를 사용하는 거임. --}}
        {!! $questions->render() !!}
        {{--XSS 방지 기능 무력화 , 보호기능 끄기: htmlspecialchars 이거 안하기==> render 로 테그를 만드는데 뭐 마음대로 바뀌니까.--}}
    </div>
@endif
@stop