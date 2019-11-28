@extends('layouts.mainnav')

@section('content')
<!-- <img src="{{ asset('pic/winter_14-wallpaper-1920x1080.jpg') }}" width=100% height="500px" alt="Responsive image"> -->

<div class="container">
    <h3>회원 정보</h3>
    <div class='mid'>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">아이디</th>
                            <th scope="col">이메일</th>
                            <th scope="col">가입일</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr onclick="">                     
                            <td><a href="#">{{ $user_info->id }}</a></td>
                            <td>{{$user_info->user_id}}</td>
                            <td>{{$user_info->email}}</td>
                            <td>{{$user_info->created_at}}</td>     
                        </tr>
                    </tbody>
                </table>
    <button type='button' class='edit_info'> 내 정보 수정하기</button>
    <button type='button' class='edit_pwd'>비밀번호 변경하기</button>
    <div>
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
        $('.mid').load('/profile/{{$user_info->user_id}}/edit_info');
    });
    $('.edit_pwd').on('click', function(e){
        console.log("비밀번호 변경 가기")
        $('.mid').load('/profile/{{$user_info->user_id}}/edit_pwd');
    });

</script>
@stop
