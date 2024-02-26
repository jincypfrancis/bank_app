@extends('layouts')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div  style="text-align:left"> <h1>&nbsp;{{ __('ABC Bank') }}</h1></div>
            <form >
                @csrf
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('deposit') }}">Deposit</a></li>
                    <li><a href="{{ route('withdraw') }}">Withdraw</a></li>
                    <li><a href="{{ route('transfer') }}">Transfer</a></li>
                    <li><a class="active" href="{{ route('statement') }}">Statement</a></li>
                    <li><a href="{{ route('logout') }}">Logout</a></li>
                </ul>

                <div style="padding:50px;margin-top:10px;background-color:#e4ede9;height:1500px;">
                    &nbsp;&nbsp;<b>{{ __('Statement of Account') }}</b>
                    <div  style="width: 80%;"><hr></div>
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
                    <table class="hometableclass">
                        <thead>
                            <tr>
                                <th width="5%" class="stmtthclass">#</th>
                                <th width="20%" class="stmtthclass">DATETIME</th>
                                <th width="15%" class="stmtthclass">AMOUNT</th>
                                <th width="5%" class="stmtthclass">TYPE</th>
                                <th width="30%" class="stmtthclass">DETAILS</th>
                                <th width="20%" class="stmtthclass">BALANCE</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            if($details->currentPage() == 1){
                            $slno=1;
                            }else{
                            $slno=(($details->perPage()*$details->currentPage())-$details->perPage())+1;
                            }
                            @endphp
                            @foreach($details as $user)
                            <tr>
                                <td class="stmttdclass">{{ $slno }}</td>
                                <td class="stmttdclass">{{ $user->transdate }}</td>
                                <td class="stmttdclass">{{ $user->amount }}</td>
                                <td class="stmttdclass">{{ $user->type }}</td>
                                <td class="stmttdclass">{{ $user->remarks }}</td>
                                <td class="stmttdclass">{{ $user->balanceafter }}</td>
                            </tr>
                            <?php $slno++; ?>
                            @endforeach
                        </tbody>
                    </table>
                    <br>
                    <div class="pagination">
                        {{-- Previous Page Link --}}
                        <div class="pagination-container">
                            @if ($details->onFirstPage())
                            <span>&laquo;</span>
                            @else
                            <a href="{{ $details->previousPageUrl() }}" rel="prev" class="pagination-link">&laquo;</a>
                            @endif
                        </div>
                        {{-- Pagination Elements --}}

                        @for ($i = 1; $i <= $details->lastPage(); $i++)
                        <div class="pagination-container">
                            <a href="{{ $details->url($i) }}" class="{{ ($details->currentPage() == $i) ? 'pagination-linkactive' : 'pagination-link' }}">{{ $i }}</a>
                        </div>
                        @endfor

                        {{-- Next Page Link --}}
                        <div class="pagination-container">
                            @if ($details->hasMorePages())
                            <a href="{{ $details->nextPageUrl() }}" rel="next" class="pagination-link">&raquo;</a>
                            @else
                            <span>&raquo;</span>
                            @endif
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
@endsection

