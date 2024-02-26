@extends('layouts')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div  style="text-align:left"> <h1>&nbsp;{{ __('ABC Bank') }}</h1></div>
            <form  method="post">
                @csrf
                <ul>
                    <li><a class="active" href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('deposit') }}">Deposit</a></li>
                    <li><a href="{{ route('withdraw') }}">Withdraw</a></li>
                    <li><a href="{{ route('transfer') }}">Transfer</a></li>
                    <li><a href="{{ route('statement') }}">Statement</a></li>
                    <li><a href="{{ route('logout') }}">Logout</a></li>
                </ul>

                <div style="padding:50px;margin-top:10px;background-color:#e4ede9;height:1500px;">
                    &nbsp;&nbsp;<b>{{ __('Welcome ') }}</b> @if(session()->has('name')){{ session('name') }}@endif
                    <br><br>
                    <table class='hometableclass'>                     
                        <tr >
                            <td width="20%" class='hometdthclass'>{{ __('Your ID ') }}</td>
                            <td width="80%" class='hometdthclass'>@if(session()->has('email')){{ session('email') }}@endif</td>
                        </tr>
                        <tr >
                            <td width="20%" class='hometdthclass'>{{ __('Your BALANCE ') }}</td>
                            <td width="80%" class='hometdthclass'>@if(session()->has('balance')){{ session('balance') }}@endif</td>
                        </tr>
                    </table>                    
                </div>
            </form>
        </div>
    </div>
</div>


@endsection

