@include('flash::message')
@extends('auth.master')

@section('content')
		<form action="" method="POST">
            {!! csrf_field() !!} 

			<div class="form-group">
				<label for="user_id"> {{ __('ID') }} </label>
				<div class="register-id">
					<input id="user_id" type="text" name="user_id" value="{{ old('user_id') }}" required autocomplete="user_id" autofocus>
                    <!-- @error('user_id')
                        <span class="inavlid-feedback" role="alert">
                            <strong>{{ $message }}</strong>  
                        </span>
                    @enderror -->
				</div>
			</div>
			<div class="form-group">
				<label for="birth"> {{ __('name')}} </label>	
				<div class="register-birth">
					<input id="name" type="text" name="name" required  value="{{ old('name') }}">
                    @error('name')
                        <span class="inavlid-feedback" role="alert">
                            <strong>{{ $message }}</strong>  
                        </span>
                    @enderror
				</div>
			</div>
			<div class="form-group">
				<label for="email"> {{ __('E-MAIL')}} </label>	
				<div class="register-email">
					<input id="email" type="email" name="email" required  value="{{ old('email') }}" autocomplete="email">
                    @error('email')
                        <span class="inavlid-feedback" role="alert">
                            <strong>{{ $message }}</strong>  
                        </span>
                    @enderror
				</div>
			</div>
			<div class="form-group">
				<label for="phone"> {{ __('Phone')}} </label>	
				<div class="register-phone">
					<input id="phone" type="tel" name="phone" required  value="{{ old('phone') }}" autocomplete="phone" pattern="[0-9]{3}-[0-9]{4}-[0-9]{4}" placeholder="ex)010-1234-5678">
                    @error('phone')
                        <span class="inavlid-feedback" role="alert">
                            <strong>{{ $message }}</strong>  
                        </span>
                    @enderror
				</div>
			</div>
			<div class="form-group">
				<label for="birth"> {{ __('birth')}} </label>	
				<div class="register-birth">
					<input id="birth" type="date" name="birth" required  value="{{ old('birth') }}" autocomplete="birth" min="1940-01-01">
                    @error('birth')
                        <span class="inavlid-feedback" role="alert">
                            <strong>{{ $message }}</strong>  
                        </span>
                    @enderror
				</div>
			</div>
			<div class="form-group">
				<label for="password"> {{ __('PASSWORD') }} </label>
				<div class="register-password">
					<input id="password" type="password" name="password" required>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
				</div>
			</div>
			<div class="form-group">
				<label for="password-confirm"> {{ __('CONFIRM PASSWORD')}} </label>
				<div class="register-password">
					<input id="password-confirm" type="password" name="password_confirmation" required>
                    {{-- @error
                        <span class="invakud-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror --}}
				</div>
			</div>
			<div class="form-group">
				<label for="submit"></label>
				<div class="register-submit">
					<input id="submit" type="submit" name="submit" value="submit">
				</div>
			</div>
		</form>

@stop