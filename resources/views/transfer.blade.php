@extends('layouts')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div  style="text-align:left"> <h1>&nbsp;{{ __('ABC Bank') }}</h1></div>
            <form action="{{ route('transferAmount') }}" method="post">
                @csrf
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('deposit') }}">Deposit</a></li>
                    <li><a href="{{ route('withdraw') }}">Withdraw</a></li>
                    <li><a class="active" href="{{ route('transfer') }}">Transfer</a></li>
                    <li><a href="{{ route('statement') }}">Statement</a></li>
                    <li><a href="{{ route('logout') }}">Logout</a></li>
                </ul>

                <div style="padding:50px;margin-top:10px;background-color:#e4ede9;height:1500px;">
                    &nbsp;&nbsp;<b>{{ __('Transfer Money ') }}</b>
                    <div  style="width: 50%;"><hr></div>
                    @if (session('error'))
                    <div class="alert">
                        <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                        {{ session('error') }}
                    </div> 
                    <br>
                    @endif
                    @if (session('success'))
                    <div class="successalert">
                        <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                        {{ session('success') }}
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
                    <table class="menutableclass">
                        <tr>
                            <td class="menutdthclass">{{ __('Email address') }}</td>                           
                        </tr>
                        <tr>
                            <td class="menutdthclass"><input type="text"  placeholder="Enter email" name="email" id="email" required value="{{ old('email') }}">
                                <div style="display: none" id="msg2"></div>
                            </td>
                        </tr>
                        <tr>
                            <td class="menutdthclass">{{ __('Amount') }}</td>                           
                        </tr>
                        <tr>
                            <td class="menutdthclass"><input type="text" min="1" maxlength="6" placeholder="Enter amount to transfer" name="amount" id="amount" required @if(session()->has('balance') && session('balance')==0){{ 'readonly' }}@endif value="{{ old('amount') }}">
                                <div style="display: none" id="msg"></div>
                                @if(session()->has('balance') && session('balance')==0)
                                <div  id="msg1"><span style='color:red'>*</span><span style='font-size:12px'> Balance is Zero. Cannot perform Transfer.</span></div>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="menutdthclass"><button type="submit" class="loginbtn">{{ __('Transfer') }}</button></td>
                        </tr>
                    </table>                    
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    jQuery('#amount').change(function () {
        var fieldValue = $(this).val(); // Get the value of the #amount field       
        if (isNumeric(fieldValue)) {
            // Field contains only numeric values
            $('#msg').html("");
            $('#msg').hide();
            var sessionData = '<?php echo session('balance'); ?>';
            var sessionData = parseFloat(sessionData);
            var fieldValue = parseFloat(fieldValue);
            if (sessionData < fieldValue) {
                $('#msg').html("<span style='color:red'>*</span><span style='font-size:12px'> Balance is less than the given amount. Cannot perform Transfer.</span>");
                $('#msg').show();
            }
        } else {
            $('#msg').html("<span style='color:red'>*</span><span style='font-size:12px'> Only numeric value allowed</span>");
            $('#msg').show();
        }

    });
    jQuery('#email').change(function () {
        var fieldValue = $(this).val(); // Get the value of the #amount field
        var sessionData = '<?php echo session('email'); ?>';
        if (sessionData == fieldValue) {
            $('#msg2').html("<span style='color:red'>*</span><span style='font-size:12px'> Cannot transfer money to loggined mail id.</span>");
            $('#msg2').show();
        } else {
            $('#msg2').html("");
            $('#msg2').hide();
        }
    });
</script>

@endsection

