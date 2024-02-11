<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\User;
use App\Models\AccountInfo;
use Illuminate\Http\Request;
use App\Models\CompanyAccount;
use App\Models\BankTransaction;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use App\Notifications\BankNotify;
use Illuminate\Support\Facades\Notification;

class BankController extends Controller
{
    public function index(Request $request, AccountInfo $account)
    {
        
        // $this->authorize('viewAny', Bank::class);

        if ($request->ajax()) {

            $data = $account->get();
    
            return DataTables::of($data)->addIndexColumn()->addColumn('action', function($data){
            
                $btn = '<a href="/Bank/'.$data->acc_number.'/edit" class="btn btn-warning m-1 fw-bold fs-5 btn-sm">تعديل</a>';
                
                return $btn;
    
            })->rawColumns(['action'])->make(true);
        }
        
        return view('Bank.index');
    }

    public function create_transaction(AccountInfo $accounts, CompanyAccount $company, Bank $bank)
    {
        // $this->authorize('create', $bank);

        $accounts=AccountInfo::get();

        $company=CompanyAccount::get();

        return view('Bank.make-transaction', compact('accounts', 'company'));
    }

    
    public function create(AccountInfo $accounts, Bank $bank)
    {
        // $this->authorize('create', $bank);

        return view('Bank.create', compact('accounts'));
        
    }


     public function store(Request $request, AccountInfo $account)
     {
        //  $this->authorize('create', Bank::class);
        
      
        $data = $request->validate([
            'acc_number'=>['required', 'max:10', Rule::unique('account_infos', 'acc_number')],
            'owner_name'=>['required', 'string', 'min:10', 'max:50', Rule::unique('account_infos', 'owner_name')],
            'phone'=>['required', 'max:13'],
            'email'=>['required', 'email','min:10','max:40'],
        ]);

        
        // $users= User::whereIn('role_id', [1,2])->get();
        
        // Notification::send($users, new BankNotify($, $request->amount, "تمت إضافة حساب  جديد", $deposit->owner_Name));

        
        $account->create([
            'acc_number'=>$data['acc_number'],
            'owner_name'=>$data['owner_name'],
            'phone'=>$data['phone'],
            'email'=>$data['email'],
        ]);

        
        return back()->with('message','تم التسجيل ');

     }
    
    
     public function transaction_store(Request $request, BankTransaction $bank, CompanyAccount $company)
    {
        // $this->authorize('create', Bank::class);

        $balance = $company->find($request->company_account);

        $currentBalance = $balance->balance + $request->amount;

        $data = $request->validate([
            'bank_account'=>['required', 'max:10'],
            'company_account'=>['required', 'max:10'],
            'amount'=>['required', 'max:15'],
            'bank'=>['required', 'max:10'],
            'title'=>['required', 'max:30'],
        ]);
        // dd($deposit->owner_Name);
        $company->find($request->company_account)->update(['balance'=> $currentBalance]);
        
        
        
        $deposit = AccountInfo::findOrFail($request->bank_account);

        $users= User::whereIn('role_id', [1,2])->get();
        
        Notification::send($users, new BankNotify($balance->name, $request->amount, $request->title, $deposit->owner_Name));

        $tr = $bank->create([
            'account_info_acc_number'=>$data['bank_account'],
            'company_account_acc_number'=>$data['company_account'],
            'amount'=>$data['amount'],
            'title'=>$data['title'],
            'bank_id'=>$data['bank'],
            'user_id'=>auth()->user()->id,
        ]);

        if ($tr) {
            return back()->with('message', 'تمت المعاملة بنجاح');
        }else {
            return back()->with('warning', 'حصل خطأ');
        }

    }


    public function transaction_report(Request $request, BankTransaction $bank)
    {
        // $this->authorize('view', Bank::class);

        if ($request->ajax()) {
            $transaction = $bank->get();
    
            return DataTables::of($transaction)->addIndexColumn()->addColumn('action', function($transaction){
            
                $btn = '<a href="/Bank/transaction/'.$transaction->id.'/delete" class="btn btn-warning m-1 fw-bold fs-5 btn-sm">عرض</a>';
                
                return $btn;
    
            })->editColumn('owner_name', function($transaction){

                return $transaction->accounts->owner_name;
             
            })->editColumn('dateTime', function($transaction){
                
                $date=date_format($transaction->created_at, 'h:i:s Y-m-d');
                return $date;
             
            })->editColumn('bank', function($transaction){

                return $transaction->bank->name;
             
            })->editColumn('username', function($transaction){

                return $transaction->user->name;
             
            })->rawColumns(['action'])->make(true);
        }

        return view('Bank.transactions-report');

    }


    public function show($id, AccountInfo $account)
    {
        // $this->authorize('viewAny', $account);
        
    }


    public function edit($id, Bank $bank)
    {
        // $this->authorize('update', $bank);
        $account = AccountInfo::find($id);
        return view('Bank.edit')->with('account', $account);

    }

    public function update(Request $request, $id, Bank $bank)
    {
        
        // $this->authorize('update', $bank);
        
        $data = $request->validate([
            'owner_name'=>['required', 'string', 'max:30'],
            'phone'=>['required', 'max:13'],
            'email'=>['required', 'max:30'],
        ]);


        return AccountInfo::findOrFail($id)->update($data) ?
         back()->with('message', 'تم التعديل بنجاح'):
          back()->with('warning', 'فشل التعديل');

 
    }

 
    public function destroy($id, AccountInfo $account, Bank $bank)
    {
        // $this->authorize('delete', $bank);
        
    }
}
