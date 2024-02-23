@extends('layouts')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="centered-div" style="background-color:#e4ede9;">
                <div  style="text-align:center;"> <h2>{{ __('ABC Bank') }}</h2></div>
                <form action="{{ route('checkLogin') }}" method="post">
                    @csrf
                    <div class="container">
                        @if (session('error'))
                        <div class="alert">
                            <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                            {{ session('error') }}
                        </div> 
                         <br>
                        @endif
                        <label for="textmsg" style="color:#959e9a">{{ __('Login To Your Account') }}</label>
                        <br> <br>
                        <label for="email"><b>{{ __('Email Address') }}</b></label>
                        <input type="text" placeholder="Enter Email" name="email" required>

                        <label for="psw"><b>{{ __('Password') }}</b></label>
                        <input type="password" placeholder="Enter Password" name="psw" required>

                        <button type="submit" class="loginbtn">{{ __('Login') }}</button>
                        <label>
                            <input type="checkbox" checked="checked" name="remember"> {{ __('Remember me') }}
                        </label>
                    </div>

                    <div class="container" style="background-color:#f1f1f1; text-align:right">
                        <!--<button type="button" class="cancelbtn">Cancel</button>-->
                        {{ __('Don`t have an account yet?')}} <a href="{{ route('registrationform') }}" style="text-decoration: none;color:#0069d9">{{ __('Sign Up') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

