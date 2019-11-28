@extends('layouts.introduce')
@section('content')
    <h1>회원 소개</h1>
    <button class='creBtn'>등록하기</button>
    <div class='work'></div>
    <div class='main'></div>
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
    function intro_delete(id){
        if(confirm('삭제하시겠습니까?')){
        $.ajax({
            type: 'DELETE',
            url: '/introduce/' + id
            }).then(function() {
                get_list();
            });
         }
    }
    
    function get_list( board_list ){
        console.log('정상실행됫음 ㅇㅇ');
        $.ajax({
            method:'GET',
            url:'/introduce/list',
        })
        .done(function( board_list ) {
            var board_div=$('.main'); //main의 재구성
            board_div.html('');//이건 머꼬?
            board_list.map(board=>{
                var str ='';
                if(board.photo !== '')
                {
                    str = `<img src = "/images/${board.photo}" alt="사진없음" />`;
                }
                var c_ul = $('<ul>');
                var li = $('<li>'+board.user_id+'</li>');
                li.append($('<li>'+ board.intro +'</li>'));
                li.append($('<li>'+ board.goal +'</li>'));
                li.append($(`<li>${str}</li>`));  
                c_ul.append(li);
                
                var button = $(`<li><button type="button">수정하기</button></li>`);
                button.bind('click' , function(e) {intro_edit(board.id)});
                c_ul.append(button);
                        
                var button = $(`<li><button type="button">삭제하기</button></li>`);
                button.bind('click' , function(e) {intro_delete(board.id)});
                c_ul.append(button);
                board_div.append(c_ul);
            }); 
        });
    }
    get_list(); //왜하는지는 모르겠음
    </script>
@stop 