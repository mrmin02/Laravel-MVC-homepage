@extends('layouts.mainnav')

@section('content')
<br><br>
<div class="container">
    <h3>회원 정보</h3>
    <div class='mid'>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">아이디</th>
                            <th scope="col">이름</th>
                            <th scope="col">이메일</th>
                            <th scope="col">전화번호</th>
                            <th scope="col">생일</th>
                            <th scope="col">가입일</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr onclick="">                     
                            <td>{{ $user_info->id }}</a></td>
                            <td>{{$user_info->user_id}}</td>
                            <td>{{$user_info->name}}</td>
                            <td>{{$user_info->email}}</td>
                            <td>{{$user_info->phone}}</td>
                            <td>{{$user_info->birth}}</td>
                            <td>{{$user_info->created_at}}</td>     
                        </tr>
                    </tbody>
                </table>
    <button type='button' class='edit_info'> 내 정보 수정하기</button>
    <button type='button' class='edit_pwd'>비밀번호 변경하기</button>

    <br><br><br>
        <h3>작성한 글</h3>
        <table class="table table-hover">
            <thead>
                <th scope="col">No</th>
                <th scope="col">글 제목</th>
                <th scope="col">댓글 개수</th>
            </thead>
            <tbody>
                @foreach ( $user_questions as $question )
                    <tr>
                        <td>{{$question->id}}</td>
                        <td><a href="/questions/{{$question->id}}">{{$question->title}}</a></td>
                        <td>{{$user_q_a_num[$question->id]}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if($user_questions->count())
            <div class="text-center"> 
            {{--css 가 bootstrap 에 설정되어 있고, 필요하면 가져다가 넣으면 됨.--}}
            {{--https://getbootstrap.com/docs/4.3/getting-started/introduction/--}}
            {{--public 의 app.js 를 사용하는 거임. --}}
                {!! $user_questions->render() !!}
                {{--XSS 방지 기능 무력화 , 보호기능 끄기: htmlspecialchars 이거 안하기==> render 로 테그를 만드는데 뭐 마음대로 바뀌니까.--}}
            </div>
        @endif
    </div>
</div>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script>
$.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.edit_info').on('click', function(e){
        console.log("정보 변경 가기");
        $('.user_questions').empty();
        $('.mid').load('/profile/{{$user_info->user_id}}/edit_info');
        

    });
    $('.edit_pwd').on('click', function(e){
        console.log("비밀번호 변경 가기")
        $('.mid').load('/profile/{{$user_info->user_id}}/edit_pwd');
    });

</script>
@stop

