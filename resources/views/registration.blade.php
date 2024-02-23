@extends('layouts')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="centered-div" style="background-color:#e4ede9;">
                <div  style="text-align:center"> <h2>{{ __('ABC Bank') }}</h2></div>
                <form action="{{ route('createAccount') }}" method="post">
                    @csrf
                    <div class="container">
                        @if (session('error'))
                        <div class="alert">
                            <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                            {{ session('error') }}
                        </div> 
                        <br>
                        @endif
                        @if ($errors->any())
                        <div class="alert">
                            <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                            {{ 'Please fill all fields to proceed further.' }}
                        </div> 
                        <br>                    
                        @endif
                        <label for="textmsg" style="color:#959e9a">{{ __('Create New Account') }}</label>
                        <br> <br>
                        <label for="name"><b>{{ __('Name') }}</b></label>
                        <input type="text" placeholder="Enter Name" name="name" required value="{{ old('name') }}">

                        <label for="email"><b>{{ __('Email Address') }}</b></label>
                        <input type="text" placeholder="Enter Email" name="email" required value="{{ old('email') }}"> 

                        <label for="psw"><b>{{ __('Password') }}</b></label>
                        <input type="password" placeholder="Enter Password" name="psw" required>

                        <button type="submit" class="loginbtn">{{ __('Create new account') }}</button>
                        <label>
                            <input type="checkbox" checked="checked" name="terms"> {{ __('Agree the ') }}
                            <a href="#" style="text-decoration: none;color:#0069d9"> {{ __('terms and policy.') }}</a>                       
                        </label>
                    </div>

                    <div class="container" style="background-color:#f1f1f1; text-align:right">
                        <!--<button type="button" class="cancelbtn">Cancel</button>-->
                        {{ __('Already have an account?')}} <a href="{{route('loginform')}}" style="text-decoration: none;color:#0069d9">{{ __('Sign In') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

