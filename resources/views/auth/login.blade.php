@include('flash::message')
@extends('auth.master')

@section('content')
<form action="" method="POST">
	{!! csrf_field() !!} 
		<div>
			<label>
				ID
			</label>
			<div>
				<input id="id" type="text" name="user_id" required autocomplete="user_id" autofocus>
				@error('user_id')
					<span class="inavlid-feedback" role="alert">
                        <strong>{{ $message }}</strong>  
                    </span>
				@enderror
			</div>
		</div>
		<div>
			<label>
				PASSWORD
			</label>
			<div>
				<input id="password" type="password" name="password" required>
				@error('pqssword')
					<span class="inavlid-feedback" role="alert">
                        <strong>{{ $message }}</strong>  
                    </span>
				@enderror
			</div>
		</div>
		<div>
			<div>
				<input id="login" type="submit" name="submit">
			</div>
		</div>
	</form>
	<form method="" action="">
		<div>
			<div>
				<a href="/register">회원가입</a>
				<a href ="{{route('remind.create')}}">비번 찾기</a>
			</div>
		</div>
	</form>
@stop