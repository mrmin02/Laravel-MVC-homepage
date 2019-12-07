<div class="container">
    <div class="form-group">
        <p class="form-control">제목 : {{$intro->title}}</p>
    </div>
    <div class="form-group">
        <p class="form-control">담장자 : {{$intro->master}}</p>
    </div>
    <div class="form-group">
        <p class="form-control">장소 : {{$intro->place}}</p>
    </div>
    <div class="form-group">
        <p class="form-control">요일 : {{$intro->weekset}}</p>
    </div>
    <div class="form-group">
        <p class="form-control">시간 : {{$intro->starttime}} ~ {{$intro->endtime}}</p>
    </div>
    <div class="form-group">
        <p class="form-control">상세내용 : <br/>
            @if($intro->photo!='')
            <img src = "/images/{{$intro->photo}}" alt="{{$intro->title}}" width="200"/>
            @endif
            {{$intro->append}}
        </p>
    </div>
</div>
<div class='btnBlk'>
    @if($lv)
    <button type="button" class="btn btn-primary" onclick='load_page({{$intro->id}},"/edit")'>수정하기</button>
    <button type="button" class='delBtn btn btn-primary'>삭제하기</button>
    @endif
    <button type='button' class='clsBtn btn btn-primary'>닫기</button>
</div>
<script>
$(document).ready(function() {
    $('.clsBtn').on('click',function(e){
        get_list({{$lv}});
    });
        
    $('.delBtn').on('click',function(e){
        if(confirm('글을 삭제합니다.')){
            $.ajax({
                headers:{
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                },
                type: 'DELETE',
                url: '/intros/' + {{$intro->id}},
            }).done(function(data){
                alert(data.message);
                get_list({{$lv}});
            });
        }
    });
});
</script>