<?PHP

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class BankRepository {

    public function checkLogin($request) {
        $login = DB::table('bank_customer')->where('email', $request->email)
                ->first();
        $res = array();
        $res['id'] = 0;
        $res['name'] = '';
        $res['balance'] =0;
        $check=0;
        if (Hash::check($request->psw, $login->password)){
             $check=1;
        }
        if (!empty($login) && ($check == 1)) {
            $res['id'] = $login->id;
            $res['name'] = $login->name;
            $res['balance'] = $login->balance;
        }
        return $res;
    }

    public function createAccount($request) {
        $encry_psw = Hash::make($request->psw );
        $data = ['name' => $request->name, 'email' => $request->email, 'password' => $encry_psw, 'balance' => 0];
        $insertid = DB::table('bank_customer')
                ->insertGetId($data);
        $res = 0;
        if (!empty($insertid)) {
            $res = $insertid;
        }
        return $res;
    }

    public function depositAmount($request) {
        $cust = DB::table('bank_customer')
                ->where('id', Session::get('id'))
                ->first();
        $newbal=$cust->balance+$request->amount;
        DB::table('bank_customer')
                ->where('id', Session::get('id'))
                ->update(['balance' => $newbal]);
        Session::forget('balance');
        Session::put('balance', $newbal);
        $data = ['customerid' => Session::get('id'), 'email' => Session::get('email'), 'transactiontype' => 'deposit',
            'amount' => $request->amount, 'balanceafter' => $newbal, 'transdate' => now(), 'remarks' => 'Deposit', 'type' => 'Credit'];
        $insertid = DB::table('bank_transaction')
                ->insertGetId($data);
        $res = 0;
        if (!empty($insertid)) {
            $res = $insertid;
        }
        return $res;
    }

    public function withdrawAmount($request) {
        $cust = DB::table('bank_customer')
                ->where('id', Session::get('id'))
                ->first();
        $newbal=$cust->balance-$request->amount;
        DB::table('bank_customer')
                ->where('id', Session::get('id'))
                ->update(['balance' => $newbal]);
        Session::forget('balance');
        Session::put('balance', $newbal);
        $data = ['customerid' => Session::get('id'), 'email' => Session::get('email'), 'transactiontype' => 'withdraw',
            'amount' => $request->amount, 'balanceafter' =>$newbal, 'transdate' => now(), 'remarks' => 'Withdraw', 'type' => 'Debit'];
        $insertid = DB::table('bank_transaction')
                ->insertGetId($data);
        $res = 0;
        if (!empty($insertid)) {
            $res = $insertid;
        }
        return $res;
    }

    public function transferAmount($request) {
        $customer = DB::table('bank_customer')->where('email', $request->email)
                ->first();
        //withdraw amount
        $cust = DB::table('bank_customer')->where('id', Session::get('id'))
                ->first();
        $newbal1=$cust->balance-$request->amount;
        DB::table('bank_customer')
                ->where('id', Session::get('id'))
                ->update(['balance' => $newbal1]);     
        $data = ['customerid' => Session::get('id'), 'email' => Session::get('email'), 'transactiontype' => 'withdraw',
            'amount' => $request->amount, 'balanceafter' => $newbal1, 'transdate' => now(), 'remarks' => 'Transfer To ' . $request->email, 'type' => 'Debit'];
        $insertid = DB::table('bank_transaction')
                ->insertGetId($data);
        Session::forget('balance');
        Session::put('balance', $newbal1);
        //deposit amount
        $newbal=$customer->balance+$request->amount;
        DB::table('bank_customer')
                ->where('email', $request->email)
                ->update(['balance' => $newbal]); 
        $data1 = ['customerid' => $customer->id, 'email' => $request->email, 'transactiontype' => 'deposit',
            'amount' => $request->amount, 'balanceafter' => $newbal, 'transdate' => now(), 'remarks' => 'Transfer From ' . Session::get('email'), 'type' => 'Credit'];
        $insertid1 = DB::table('bank_transaction')
                ->insertGetId($data1);
        $data2 = ['customerid' => Session::get('id'), 'email' => Session::get('email'), 'transfered_customer' => $customer->id, 'transfered_email' => $request->email,
            'amount' => $request->amount, 'transdate' => now()];
        $insertid2 = DB::table('bank_transfer')
                ->insertGetId($data2);
        $res = 0;
        if (!empty($insertid2)) {
            $res = $insertid2;
        }
        return $res;
    }

    public function statementList() {
        $query_data = DB::table('bank_transaction')
                ->where('customerid', Session::get('id'))
                ->orderBy('transdate', 'DESC')
                ->paginate(10);
        return $query_data;
    }

}

?>
