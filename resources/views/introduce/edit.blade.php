<form id="formData" enctype="multipart/form-data" >
 {!! csrf_field() !!}
 <!-- {!! method_field('PUT')!!} -->
    <div class="print-error-msg" style="display:none">
        <ul></ul>
    </div>
    <div class="form-group">
        <h1>내용 수정</h1>
        <P>이름</P>
        <textarea cols='30' rows='1' name="name" id ="name">{{ old('name',$member->name)}}</textarea>
        <P>자기소개</P>
        <textarea cols='30' rows='5' name='intro' id='intro'>{{ old('intro', $member->intro ) }}</textarea>
        <P>목표</P> 
        <textarea cols='30' rows='5' name="goal" id ="goal">{{ old('goal',$member->goal) }}</textarea>
        <p>현재 사진</P>
        <img src="/images/{{ $member->photo }}" alt="photo x"></br>
        <p>바꿀 사진</p>
        <input type="file" name="photo" id="photo" value="{{ old('photo',$member->photo )}}"></br>

        <h2>관리자 인증</h2>
        <P>아이디</P>
        <textarea cols='30' rows='1' name="user_id" id ="user_id"></textarea>
        <P>비밀번호</P>
        <textarea cols='30' rows='1' name="password" id ="password"></textarea>
    </div>
    <div>
        <button type="submit" class=saveBtn data-id="{{$member->id}}">저장하기</button>
        <button type="button" class=clsBtn data-id="{{$member->id}}">삭제하기</button>
    </div>
</form>

<script>
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.clsBtn').on('click', function(e){
        var clsId = $(this).attr('data-id');
        if(confirm('삭제하시겠습니까?')){
        $.ajax({
            type: 'DELETE',
            data: {
                user_id : $('#user_id').val(),
                password : $('#password').val(),
                
            },
            url: '/introduce/' + clsId,   
            }).then(function(data) {
                if(data=="idx"){
                    alert("관리자 아이디가 아닙니다.");
                }
                else if(data=='passx'){
                    alert("password가 일치하지않습니다.");
                }
                else{
                    get_list();
                    $('.work').empty();
                }
            });
         }
    });
    // $('.clsBtn').on('click', function(e){
    //     var clsId = $(this).attr('data-id');
    //     if(confirm('삭제하시겠습니까?')){
    //     $.ajax({
    //         type: 'DELETE',
    //         url: '/introduce/' + clsId
    //         }).then(function() {
    //             get_list();
    //             $('.work').empty();
    //         });
    //      }
    // });
    
    
    $('.saveBtn').on('click', function(e){  
        //GET form
        var form = $('#formData')[0];
        var introId = $(this).attr('data-id'); // member의 id값을 가져옴
        //js의 this : 이벤트가 발생한 태그요소가 표시
        //jquery의 $(this) : 이벤트가 발생한 요소의 정보들이 object로 표시
        //.attr('속성') : 속성의 값을 가져옴
        //Create an FormData object
        var data = new FormData(form); // 뭔지모르겟다 
        data.append('_method', 'PATCH'); // PATCH?
        e.preventDefault();// 서브밋 행동취소
        $.ajax({
            type: 'POST', //ajax는 patch 안먹음
            url: '/introduce/' + introId,
            data: data, 
            processData: false,
            contentType: false,
            cache: false, 
            success : function(data){
                if($.isEmptyObject(data.error)){
                    if(data=="idx"){
                        alert("관리자 아이디가 아닙니다.");
                    }
                    else if(data=='passx'){
                        alert("password가 일치하지않습니다.");
                    }
                    else{
                        console.log(data);
                        get_list();// introduce에서 get_list함수를 호출 
                        $('.work').empty();
                    }
                }else{
                    console.log(data.error);
	                printErrorMsg(data.error);
	            }    
            }
        });
    });
    function printErrorMsg (msg) {
			$(".print-error-msg").find("ul").html('');
			$.each( msg, function( key, value ) {
				$(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                $(".print-error-msg").show();
			});
		}
</script>