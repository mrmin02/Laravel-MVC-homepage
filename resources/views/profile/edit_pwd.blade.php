<form id="formData" enctype="multipart/form-data" >
{!! method_field('PUT')!!}
{!! csrf_field() !!}
    <p>정보 변경</p>
    <table>
        <tr>
            <td>변경할 비밀번호</td>
            <td><input type="password" value="" required autofocus></td>
        </tr>
        <tr>
            <td>비밀번호 확인</td>
            <td><input type="password" value="" required></td>
        </tr>
    </table>
    
    <button type="submit"lass='update'>저장</button>
    <a href="/profile" class='back'>취소</a>
    
</form>