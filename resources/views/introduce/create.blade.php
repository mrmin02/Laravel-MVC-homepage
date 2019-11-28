<form action="{{ route('introduce.store') }}" id="formData" method="POST" enctype="multipart/form-data">
 {!! csrf_field() !!}
    <div class="form-group">
         아이디 : <input type="text" name="user_id" id ="user_id" /></br>
         비밀번호 : <input type="password" name="password" id ="password" value="{{ old('password') }}"/></br>
         자기소개 : <textarea cols='30' rows='5' name='intro'>{{ old('intro') }}</textarea></br>
         목표 : <input type="text" name="goal" id ="goal" value="{{ old('goal') }}"/></br>
         사진 : <input type="file" name="photo" id="photo"/></br>
         
    </div>

    <div>
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
        var form = $('#formData')[0]; //
        //Create an FormData object
        var data = new FormData(form); // 

        e.preventDefault();// 서브밋 행동취소(왜 쓰는지는 모르겟음)
        $.ajax({
            type: 'POST',
            enctype: 'multipart/form-data',
            url: '/introduce',
            data: data,
            processData: false,
            contentType: false,
            cache: false, 
            success : function(data){
                console.log(data);
                get_list();// introduce에서 get_list함수를 호출 
                $('.work').empty();
            }
        });
    });
</script>