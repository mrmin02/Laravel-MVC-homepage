<form action="{{ route('introduce.store') }}" id="formData" method="POST" enctype="multipart/form-data">
 {!! csrf_field() !!}
    <div class="print-error-msg" style="display:none">
        <ul></ul>
    </div>
    <div class="form-group">
        <P>아이디</P>
        <textarea cols='30' rows='1' name="user_id" id ="user_id">{{ old('user_id') }}</textarea>
        <P>비밀번호</P>
        <textarea cols='30' rows='1' name="password" id ="password">{{ old('password') }}</textarea>
        <P>자기소개</P>
        <textarea cols='30' rows='5' name='intro' id='intro'>{{ old('intro') }}</textarea>
        <P>목표</P> 
        <textarea cols='30' rows='5' name="goal" id ="goal">{{ old('goal') }}</textarea>
        <p>사진</p> 
        <input type="file" name="photo" id="photo">
    </div>

    <div>
    </br>
        <button type="submit" class=addBtn>저장하기</button>
        <button type="button" class=clsBtn>취소</button>
    </div>
</form>
<script>
    $('.clsBtn').on('click', function(e){
        $('.work').empty();
    });
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.addBtn').on('click', function(e){  
        //GET form
        //제이쿼리에서 .은 클래스 #은 id로 접근시 사용한다.
        var form = $('#formData')[0]; // 뭐지이건
        //Create an FormData object
        var data = new FormData(form); // 뭔지모르겟다 
        e.preventDefault();// 서브밋 행동취소(왜 쓰는지는 모르겟음)
        
        
        $.ajax({
            type: 'POST',
            enctype: 'multipart/form-data',
            url: '/introduce',
            data: data, // 모르겠다
            processData: false,
            contentType: false,
            cache: false, 
            success : function(data){
                if($.isEmptyObject(data.error)){
                    if(data=="idx"){
                        // alert("id가 일치하지않습니다.");
                        $(".print-error-msg").find("ul").html('');
                        $(".print-error-msg").find("ul").append('<li>'+"등록되지않은 ID입니다"+'</li>');
                        $(".print-error-msg").show();
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