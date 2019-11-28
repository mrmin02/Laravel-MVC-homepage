<form id="formData" enctype="multipart/form-data" >
 {!! csrf_field() !!}
 <!-- {!! method_field('PUT')!!} -->
    <div class="form-group">
         아이디 : <input type="text" name="user_id" id ="user_id" value="{{ old('user_id',$member->user_id)}}"></br>
         자기소개 : <textarea cols='30' rows='5' name='intro'>{{ old('intro', $member->intro ) }}</textarea></br>
         목표 : <input type="text" name="goal" id ="goal" value="{{ old('goal',$member->goal )}}"></br>
         현재 사진 <img src="/images/{{ $member->photo }}" alt="photo x"></br>
         바꿀 사진 : <input type="file" name="photo" id="photo" value="{{ old('photo',$member->photo )}}"></br>
    </div>
    <div>
        <button type="submit" class=saveBtn data-id="{{$member->id}}">저장하기</button>
        <button type="button" class=backBtn>취소</button>
    </div>
</form>

<script>
    $('.backBtn').on('click', function(e){
        $('.work').empty();
    });
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });
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
                get_list();// introduce에서 get_list함수를 호출 
                $('.work').empty();
            }
        });
    });
</script>