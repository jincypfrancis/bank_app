@extends('layouts')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div  style="text-align:left"> <h1>&nbsp;{{ __('ABC Bank') }}</h1></div>
            <form action="{{ route('depositAmount') }}" method="post">
                @csrf
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a class="active" href="{{ route('deposit') }}">Deposit</a></li>
                    <li><a href="{{ route('withdraw') }}">Withdraw</a></li>
                    <li><a href="{{ route('transfer') }}">Transfer</a></li>
                    <li><a href="{{ route('statement') }}">Statement</a></li>
                    <li><a href="{{ route('logout') }}">Logout</a></li>
                </ul>

                <div style="padding:50px;margin-top:10px;background-color:#e4ede9;height:1500px;">
                    &nbsp;&nbsp;<b>{{ __('Deposit Money ') }}</b>
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
                    <table>
                        <tr>
                            <td>{{ __('Amount') }}</td>                           
                        </tr>
                        <tr>
                            <td ><input type="text" min="1" maxlength="6" placeholder="Enter amount to deposit" name="amount" id="amount" required value="{{ old('amount') }}">
                                <div style="display: none" id="msg"></div>
                            </td>
                        </tr>
                        <tr>
                            <td ><button type="submit" class="loginbtn">{{ __('Deposit') }}</button></td>
                        </tr>
                    </table>                    
                </div>
            </form>
        </div>
    </div>
</div>
<style>
    table {
        border-collapse: collapse;
        width: 50%;
    }

    th, td {
        padding: 8px;
        text-align: left;

    }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    jQuery('#amount').change(function () {
        var fieldValue = $(this).val(); // Get the value of the #amount field
        if (isNumeric(fieldValue)) {
            // Field contains only numeric values
            $('#msg').html("");
            $('#msg').hide();
        } else {
            $('#msg').html("<span style='color:red'>*</span><span style='font-size:12px'> Only numeric value allowed</span>");
            $('#msg').show();
        }
    });
    function isNumeric(value) {
        return /^\d+(\.\d+)?$/.test(value);
    }
</script>

@endsection

