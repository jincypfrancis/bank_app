<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Repositories\BankRepository;
use App\Http\Requests\LoginPage;
use App\Http\Requests\RegistrationPage;
use App\Http\Requests\WithdrawPage;
use App\Http\Requests\DepositPage;
use App\Http\Requests\TransferPage;
use Illuminate\Support\Facades\Session;

class BankController extends Controller {

    protected $bankRepo;

    public function __construct(BankRepository $bankRepository) {
        $this->bankRepo = $bankRepository;
    }

    public function checkLogin(LoginPage $request) {
        $details = $this->bankRepo->checkLogin($request);
        if ($details['id'] == 0) {
            $msg = __('Invalid Credentials..');
            return redirect(route('loginform'))->with('error', $msg);
        } else {
            //success
            session(['id' => $details['id'], 'name' => $details['name'], 'email' => $request->email, 'balance' => $details['balance']]);
            return redirect(route('home'));
        }
    }

    public function createAccount(RegistrationPage $request) {
        $insertid = $this->bankRepo->createAccount($request);
        if ($insertid == 0) {
            $msg = __('Account not created!!!');
            return redirect(route('registrationform'))->with('error', $msg);
        } else {
            //success
            session(['id' => $insertid, 'name' => $request->name, 'email' => $request->email, 'balance' => 0]);
            return redirect(route('home'));
        }
    }

    public function depositAmount(DepositPage $request) {
        $insertid = $this->bankRepo->depositAmount($request);
        if ($insertid == 0) {
            $msg = __('Error!! Amount not deposited.');
            return redirect(route('deposit'))->with('error', $msg);
        } else {
            //success
            $msg = __('Success!!! Amount deposited successfully.');
            return redirect(route('deposit'))->with('success', $msg);
        }
    }

    public function withdrawAmount(WithdrawPage $request) {
        if(Session::get('balance') < $request->amount){
            $msg = __('Error!! Balance is less than the given amount. Cannot perform Withdraw.');
            return redirect(route('withdraw'))->with('error', $msg);
        }
        $insertid = $this->bankRepo->withdrawAmount($request);
        if ($insertid == 0) {
            $msg = __('Error!! Amount not withdrawed.');
            return redirect(route('withdraw'))->with('error', $msg);
        } else {
            //success
            $msg = __('Success!!! Amount withdrawed successfully.');
            return redirect(route('withdraw'))->with('success', $msg);
        }
    }

    public function transferAmount(TransferPage $request) {
        if(Session::get('balance') < $request->amount){
            $msg = __('Error!! Balance is less than the given amount. Cannot perform Transfer.');
            return redirect(route('transfer'))->with('error', $msg);
        }
        if(Session::get('email') == $request->email){
            $msg = __('Error!! Cannot transfer money to loggined mail id.');
            return redirect(route('transfer'))->with('error', $msg);
        }
        $insertid = $this->bankRepo->transferAmount($request);
        if ($insertid == 0) {
            $msg = __('Error!! Amount not transfered.');
            return redirect(route('transfer'))->with('error', $msg);
        } else {
            //success
            $msg = __('Success!!! Amount transfered successfully.');
            return redirect(route('transfer'))->with('success', $msg);
        }
    }

    public function statement() {
        $list = $this->bankRepo->statementList();
        return view('statement', ['details' => $list]);
   
    }

}
