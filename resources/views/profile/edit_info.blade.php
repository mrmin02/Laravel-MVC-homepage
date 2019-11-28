<form id="formData" enctype="multipart/form-data" >
{!! method_field('PUT')!!}
{!! csrf_field() !!}
    <p>정보 변경</p>
    <table>
        <tr>
            <td>이름</td>
            <td><input type="text" value="{{$info->user_id}}" required autofocus></td>
        </tr>
        <tr>
            <td>이메일</td>
            <td><input type="text" value="{{$info->email}}" required></td>
        </tr>
        <tr>
            <td>전화번호</td>
            <td><input type="text" value="{{$info->phone}}" required></td>
        </tr>
    </table>
    
    <button type="submit"lass='update'>저장</button>
    <a href="/profile" class='back'>취소</a>
    
</form>