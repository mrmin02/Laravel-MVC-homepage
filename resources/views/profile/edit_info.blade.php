<form id="formData" action="/profile/{{$info->user_id}}/update_info" enctype="multipart/form-data" method="post">
{!! method_field('PUT')!!}
{!! csrf_field() !!}
    <p>정보 변경</p>
    <table>
        <tr>
            <td>이름</td>
            <td><input type="text" name="name"value="{{$info->name}}" required autofocus></td>
        </tr>
        <tr>
            <td>이메일</td>
            <td><input type="text" name="email" value="{{$info->email}}" required></td>
        </tr>
        <tr>
            <td>전화번호</td>
            <td><input type="tel" name="phone" required  value="{{$info->phone}}" autocomplete="phone" pattern="[0-9]{3}-[0-9]{4}-[0-9]{4}" placeholder="ex)010-1234-5678"></td>
        </tr>
        <tr>
            <td>생일</td>
            <td><input type="date" name="birth" required  value="{{$info->birth}}" autocomplete="birth" min="1940-01-01"></td>
        </tr>
    </table>
    
    <button type="submit"lass='update'>저장</button>
    <a href="/profile/{{$info->user_id}}" class='back'>취소</a>
    
</form>