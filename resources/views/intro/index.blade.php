@extends('layouts.intros')
@section('content')
    <div class='page'>
    </div>
@stop
@section('script')
    <script>
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });
        var weeknd = [ '월', '화', '수', '목', '금', '토', '일' ];
        var attrs = ['title', 'place', 'master', 'weekset', 'starttime', 'endtime', 'append',]
        var attrKo = {
            'title' : '제목',
            'place' : '장소',
            'master' : '담당자',
            'weekset' : '요일',
            'starttime' : '시작시간',
            'endtime' : '종료시간',
            'append' : '내용',
        };
        function load_page(id,str = ''){
            $('.page').load('/intros/'+id+str);
        }
        function get_list(){
            var board_div= $('.page');
            board_div.html('');
            var b_ul = $('<ul class="b_ul">');
            for(i = 9; i <= 18; i++){
                var ti = (`<li>${i}시 --</li>`);
                b_ul.append(ti); 
            }
            board_div.append(b_ul);
            $.ajax({
                method:'GET',
                url: '/intros/list',
                })
                .done(function( board_list ) {
                    var key = 0;
                    board_list.map(board=>{
                        var a_ul = $('<ul class="a_ul">');
                        var c_ul = $('<ul>');
                        a_ul.append(c_ul); 
                        var li = $('<li> ' + weeknd[key] + ' </li>');
                        c_ul.append(li); 
                        board.map(list=>{
                            var str = '';
                            var time = parseInt(list.endtime) - parseInt(list.starttime);
                            var y_fix = (parseInt(list.starttime)-9)*60+40;
                            var c_ul = $(`<li style="height:${(time*60)}px; top:${y_fix}px"><div>${list.title}</div></li>`);
                            c_ul.bind('click' , function(e) {load_page(list.id)});
                            a_ul.append(c_ul); 
                        });
                        board_div.append(a_ul);
                        key++;
                    });
                    if({{$lv}}){
                    var button = $(`<div class='btnBlk'><button type="button">등록하기</button></div>`);
                    button.bind('click' , function(e) {load_page('create')});
                    board_div.append(button);
                    }
                });
        }
        function intro_delete(id){
            if(confirm('글을 삭제합니다.')){
                $.ajax({
                    type: 'DELETE',
                    url: '/intros/' + id,
                }).done(function(data){
                    alert(data.message);
                    get_list();
                });
            }
        }
        function valid_chk(data){
            var err = 0;
            var filter = '';
            var txt = '[ ';
            attrs.map(function(attr){
                filter = (attr === 'weekset') ? null : '';
                if (data.get((attr === 'weekset') ? 'weekset[]' : attr) === filter){
                    $(`#${attr}`).css('background','#FAECC5');
                    $(`#${attr}`).css('border','solid 1px #FFBB00');
                    txt += attrKo[attr] + ' ';
                    err++;
                }else{
                    $(`#${attr}`).css('background','white');
                    $(`#${attr}`).css('border','solid 1px black');
                }
            });
            txt += '] 입력해주세요';
            if(err !== 0) alert(txt);
            return (err === 0) ? true : false;
        }
        get_list();
    </script>

    <style>
        *{ margin:0; padding:0;}
        ul li {list-style:none;}
        .page{float:left; width:100%;}
        .a_ul{float:left; width:13%; height:582px; background:#bbbbbb; color:#4F4F4F; font:bold 15px malgun gothic; position:relative;padding-left:1px;}
        .page > .a_ul:nth-child(2) > li:nth-child(2n) {background:#FFA2A2; color:#B70000;}
        .page > .a_ul:nth-child(3) > li:nth-child(2n) {background:#FFDC7E; color:#DB3A00;}
        .page > .a_ul:nth-child(4) > li:nth-child(2n) {background:#FFFF6C; color:#C98500;}
        .page > .a_ul:nth-child(5) > li:nth-child(2n) {background:#89FF82; color:#00A500;}
        .page > .a_ul:nth-child(6) > li:nth-child(2n) {background:#90E4FF; color:#001EC9;}
        .page > .a_ul:nth-child(7) > li:nth-child(2n) {background:#9190FF; color:#0000ED;}
        .page > .a_ul:nth-child(8) > li:nth-child(2n) {background:#FFB4FF; color:#8324FF;}
        .page > .a_ul > ul {background:#484848; color:white; height:40px; line-height:40px;}
        .page > .a_ul > li {display:table; position:absolute; left:0; background:#DFDFDF;}
        .page > .a_ul > li > div {display:table-cell; vertical-align:middle; width:100%;}
        .page > .a_ul li {float:left; width:100%; text-align:center;}
        .page > .b_ul{float:left; width:5.5%; margin-top:28px; font:bold 15px malgun gothic;}
        .page > .b_ul > li {float:left; height:60px;width:100%; text-align:right;}
        .page > .btnBlk{float:left; width:100%;}
    </style>
@stop