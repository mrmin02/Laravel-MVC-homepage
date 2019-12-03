@extends('layouts.introduce')
@section('content')
    <h1>회원 소개</h1>
    @if(isset(auth()->user()->admin) ?  (auth()->user()->admin==1)?1:0  : 0 )
        <button class='creBtn'>등록하기</button>
    @endif
    <div class='work'>
    </div>
@stop

@section('script')
    <script>
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $('.creBtn').on('click', function(e){
        $('.work').load('/introduce/create');
    });
  
    function intro_edit(id){
        $('.work').load('/introduce/'+id+'/edit');
    }
    
    function get_list(){
        console.log('정상실행됫음 ㅇㅇ');
        $.ajax({
            method:'GET',
            url:'/introduce/list',
        })
        .done(function( board_list ) {
            var board_div=$('.work'); //main의 재구성
            board_div.html('');//이건 머꼬?
            board_list.map(board=>{
                var str ='';
                if(board.photo !== '')
                {
                    str = `<img src = "/images/${board.photo}" alt="사진없음" />`;
                }
                var c_ul = $('<ul>');
                var li = $('<li>'+board.name+'</li>');
                li.append($('<li>'+ board.intro +'</li>'));
                li.append($('<li>'+ board.goal +'</li>'));
                li.append($(`<li>${str}</li>`));  
                c_ul.append(li);
                if({{$lv}}){
                    var button = $(`<li><button type="button">수정하기</button></li>`);
                    button.bind('click' , function(e) {intro_edit(board.id)});
                    c_ul.append(button);   
                }
                board_div.append(c_ul);
            }); 
        });
    }
    get_list(); //왜하는지는 모르겠음
    </script>
@stop 