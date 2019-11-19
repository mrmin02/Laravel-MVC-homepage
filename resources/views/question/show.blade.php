@extends('layouts.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container">
    <h1>글 제목: {{$question->title}}</h1>
    <hr />
    <!-- {{-- css 는 bootstrap 4.3.1 을 사용함. 9장에  
        php artisan ui:vue --auth, npm i , npm run dev 에 의해서. 라이브러리 설치가 되고, 
        public\css\app.css 가 만들어 짐.
        
        --}} -->
    {!! csrf_field() !!} {{-- @csrf   로 대체가능 (블레이드) --}}
    {{-- cross site request forge --}}
    {{-- route() : url 경로 , csrf_field(): csrf 대응하는 헬퍼함수 --}}

    <div class="form-group {{ $errors->has('title') ? 'has-error' :'' }}">
        <label for="title">제목</label>
        <p type="text" name="title" id="title" value="{{ old('title') }}" class="form-control">
            {{$question->title}}
        </p>
    </div>
    <div class="form-group {{ $errors->has('content') ? 'has-error':'' }}">
        <label for="content">내용</label>
        <p name="content" id="content" rows="10" class="form-control" value="{{ old('content') }}">
            {{$question->content}}
        </p>
        
    </div>
    
    @if(Auth::id() == $question->user_id)
        <form action="{{route('questions.edit',[$question->id])}}" method="get">
            <div class="form-group">
                <button type="submit" class="btn btn-primary">수정</button>
            </div>
        </form>
        <form action="{{route('questions.destroy',[$question->id])}}" method="post">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <div class="form-group">
                <button type="submit" class="btn btn-primary">삭제</button>
            </div>
        </form>
    @endif
    <div class="form-group">
        <label for="answer">댓글</label>
        @auth
            <form id="answerSubmit">
                <!-- {{ method_field('POST') }}
                    {{ csrf_field() }}   -->
                <textarea name="content" id="answer" rows="10" class="form-control" required></textarea>
                <br>
                <button class="btn btn-primary" id="answer" type="submit">댓글 작성하기</button>
            </form>
        @endauth
    </div>
    <div id="answersList"></div>
</div>
@stop
@section('script')

<!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
<!-- <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script> -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

<script type="text/javascript">
    function modefiClick(id, content){
        console.log("수정클릭");
        $('#userAnswer'+id).empty();
        $('#userAnswer'+id).append("<textarea id='newContent'>"+content+"</textarea>");
        $("#modefiAnswer"+id).empty();
        console.log("수정 ");
        $("#modefiAnswer"+id).append("<div class='form-group'>" +
            "<button type='button' class='btn btn-primary' onclick='modefiSubmit("+id+")'>수정 완료</button>" +
            "</div>");
    }
    function modefiSubmit(id){
        console.log("수정 완료 클릭");
        
        var content = $('#newContent').val();
        var question_id = {{$question -> id}};
        console.log("content :",content);
        $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                asnc: true,
                type: 'PUT',
                url: "/answers/"+id,
                
                data: {content:content,question_id:question_id},
                dataType: 'json',
                success: function(data) {
                    drawAnswer(data);
                    console.log("업데이트 성공");
                    console.log(data);
                    // alert("댓글 로딩 성공");
                },
                error: function(data) { 
                    // flash 메시지를 사용하고 싶어도, controller 에서 제약에 걸리면 오류로 반환하기 때문에 비동기적으로 해야만 함. 
                    // 따라서 ajax 에서는 사실상 사용 하기 어려움
                    var errors = data.responseJSON;
                    console.log(errors);
                    alert(errors.errors.content[0]);
                }
            });
    }
    function drawAnswer(datas) {
            $("#answersList").empty();
            datas.map((data) => {
                var csrfVar = "{{ csrf_token() }}";
                var id = <?php if (Auth::check()){
                print(Auth::user()->id);
                print(';');
            }else{print("'not login';");}
                ?>
                var addButton = '';
                if ( id == data.user_id){
                    addButton = 
                    "<form id='modefiAnswer" + data.id +"'>" +
                    "<div class='form-group'>" +
                    "<button type='button' class='btn btn-primary' onclick='modefiClick("+data.id+",\""+data.content+"\")'>수정</button>" +
                    "</div>" +
                    "</form>" +
                    "<form id='deleteAnswer" + data.id + "'>" +
                    "<div class='form-group'>" +
                    "<button type='submit' class='btn btn-primary'>삭제</button>" +
                    "</div>" +
                    "</form>" ;
                }
                $("#answersList").append("<div id='answer'" + data.id + "><h5>" + data.user_id + 
                    "</h5><p id='userAnswer"+data.id+"'>" 
                    + data.content +"</p>"+
                    addButton+
                    "</div>");
                $("#deleteAnswer" + data.id).submit(function(e) {
                    console.log("#deleteAnswer" + data.id);
                    var question_id = {{$question -> id}}      
                    e.preventDefault();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        // asnc: true,
                        type: 'DELETE',
                        url: "/answers/"+data.id,
                        data: {question_id:question_id},
                        dataType: 'json',
                        success: function(data) {
                            alert("댓글 삭제 성공했습니다 !!");
                            console.log(data);
                            drawAnswer(data)
                            
                        },
                        error: function(data) {
                            console.log("data");
                            alert("댓글 삭제 오류 발생" + data);
                        }
                    });
                    // .fail(function (jqXHR, textStatus, errorThrown) {

                    // console.log('2. fail 을 탄다 : ' + errorThrown);

                });
            });

        };
    $(document).ready(function() {
        ajaxShow();
        
        $("#answerSubmit").submit(function(e) {  // and delete ajax  # 댓글 등록
            e.preventDefault();
            var content = $("textarea[name=content]").val();
            var user_id = <?php if (Auth::check()){
                print(Auth::user()->id);
            }else{print("'not login';");}
                ?>

            var question_id = {{$question -> id}};
            
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                
                type: 'POST',
                url: "{{ route('answers.store') }}",
                data: {
                    question_id: question_id,
                    user_id: user_id,
                    content: content
                },
                dataType: 'json',
                success: function(data) {
                    alert("댓글 등록에 성공했습니다 !!");
                    $("textarea[name=content]").val('');
                    drawAnswer(data)
                    console.log(data);
                },
                error: function(data) {
                    // flash 메시지를 사용하고 싶어도, controller 에서 제약에 걸리면 오류로 반환하기 때문에 비동기적으로 해야만 함. 
                    // 따라서 ajax 에서는 사실상 사용 하기 어려움
                    var errors = data.responseJSON;
                    if(errors){ // 글자수, required  만족 못했을 경우.
                        alert(errors.errors.content[0]);
                    }else{ // 로그인 안한 경우
                        alert("로그인이 필요합니다.");
                    }
                    
                }
            });
        });

        function ajaxShow() { // 처음에 댓글 로딩
            var question_id = {{$question -> id}}                    

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                asnc: true,
                type: 'GET',
                url: "{{ route('answers.index') }}",
                data: {question_id:question_id},
                dataType: 'json',
                success: function(data) {
                    drawAnswer(data);
                    console.log("댓글 로딩 성공");
                    // alert("댓글 로딩 성공");
                },
                error: function(data) {
                    console.log(data);
                    alert("댓글 로딩 오류 발생" + data);
                    // console.log(data);
                }
            });

        }
    });

   



</script>
@stop
