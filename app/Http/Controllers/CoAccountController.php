<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Payroll;
use App\Models\Employee;
use App\Models\AccountInfo;
use Illuminate\Http\Request;
use App\Models\CompanyAccount;
use App\Models\BankTransaction;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use App\Notifications\FinancialNotify;
use Illuminate\Support\Facades\Notification;

class CoAccountController extends Controller
{
    
    public function index(Request $request, CompanyAccount $company, Payroll $payroll)
    {

        // $this->authorize('view', $company);

        // dd(timezone_identifiers_list());
        if ($request->ajax()) {
            $data = $company->get();
            return DataTables::of($data)->addIndexColumn()->addColumn('action', function($data){
        
                $btn = '<a href="/Account/single/'.$data->acc_number.'" class="btn btn-primary btn-sm fw-bold fs-5 m-1">عرض</a>';
        
                $btn = $btn.'<a href="/Account/'.$data->acc_number.'/edit" class="btn btn-warning m-1 fw-bold fs-5 btn-sm">تعديل</a>';
        
                return $btn;
        
            })->editColumn('full_name', function($data){
        
                $data->with('employee')->get();
        
                return $data->employee->firstName.' '.$data->employee->sureName.' '.$data->employee->thirdName.' '.$data->employee->lastName;
        
            })->editColumn('balance', function($data){
                
                return number_format($data->balance);
           
            })->editColumn('dateTime', function($data){
                
                return date_format($data->updated_at, 'h:i:s Y-m-d');
           
            })->rawColumns(['action'])->make(true);
        
        }
            return view('companyAccount.index');
        
    }

   
    public function create(CompanyAccount $account)
    {
        // $this->authorize('create', $account);
        $employees = Employee::select('id', 'firstName', 'sureName', 'thirdName','lastName')->get();
        return view('companyAccount.create',compact('employees'));
    }


    public function store(Request $request, CompanyAccount $account)
    {
        // $this->authorize('create', $account);

        $data = $request->validate([
            'acc_number'=>['required', 'string', 'max:50', Rule::Unique('company_accounts', 'acc_number')],
            'balance'=>['required', 'max:10'],
            'name'=>['required', 'string', 'min:10', 'max:30', Rule::unique('company_accounts', 'name')],
            'manager_id'=>['required', 'min:12','max:20'],
        ]);


        $account->create([
            'acc_number'=>$data['acc_number'],
            'balance'=>$data['balance'],
            'name'=>$data['name'],
            'employee_id'=>$data['manager_id'],
        ]);

        return back()->with('message', 'تم الحفظ بنجاح :)');
    }


    public function create_transaction(AccountInfo $accounts, CompanyAccount $company)
    {
        // $this->authorize('create', $company);
        
        return view('companyAccount.make-transaction', compact('accounts', 'company'));
    }
    
    
    
    public function transaction_store(Request $request, BankTransaction $bank)
    {
        // $this->authorize('create', CompanyAccount::class);
        
        $balance = CompanyAccount::findOrFail($request->company_account);
        
        $currentBalance = $balance->balance - $request->amount;
        // dd($currentBalance);
        
        $data = $request->validate([
            'bank_account'=>['required', 'max:10'],
            'company_account'=>['required', 'max:10'],
            'amount'=>['required', 'max:15'],
            'bank'=>['required', 'max:10'],
            'title'=>['required', 'max:20'],
        ]);
        
        
        if ($request->amount <= $balance->balance) {
            CompanyAccount::findOrFail($request->company_account)->update(['balance'=> $currentBalance]);
            $users= User::whereIn('role_id', [1,2])->get();
            Notification::send($users, new FinancialNotify($balance->name,$request->amount,$request->title));
            
            $bank->create([
                'account_info_acc_number'=>$data['bank_account'],
                'company_account_acc_number'=>$data['company_account'],
                'amount'=>$data['amount'],
                'title'=>$data['title'],
                'bank_id'=>$data['bank'],
                'user_id'=>auth()->user()->id,
            ]);
            
            return back()->with('message', 'تمت المعاملة بنجاح');
        }else {
            return back()->with('warning', 'رصيدك غير متوفر');
            
        }
    }
    
    public function transaction_report(CompanyAccount $transaction, Request $request)
    {
    
        // $this->authorize('create', $transaction);
        
        
        if ($request->ajax()) {
            $transaction = array_merge([$transaction->deductionTransactions],[$transaction->payrollTransactions], [$transaction->allowanceTransactions]);
            $transaction = max($mix);
            
            return DataTables::of($transaction)->addIndexColumn()->addColumn('action', function($transaction){
                
                $btn = '<a href="/Allowance/'.$transaction->id.'/delete" class="btn btn-warning m-1 fw-bold fs-5 btn-sm">حذف</a>';
                
                return $btn;
                
            })->editColumn('full_name', function($transaction){
        
                        
        })-> rawColumns(['action'])->make(true);
        
    
        }
    
        return view('companyAccount.transactions-report');
    }

 
    public function show(CompanyAccount $companyAccount, Request $request, int $id)
    {
        // $this->authorize('create', $companyAccount);
        
        $company = $companyAccount->find($id);
        
        $mix = array_merge([$company->deductionTransactions],[$company->payrollTransactions], [$company->allowanceTransactions]);
        
        $filter = max($mix);
       

        
        
        return view('companyAccount.show', compact('company', 'filter'));
    }


    public function edit(CompanyAccount $account, int $id)
    {
        // $this->authorize('edit', $account);
        $account = CompanyAccount::findOrFail($id);
        return view('companyAccount.edit')->with('account', $account);
    }


   
    public function update(Request $request, CompanyAccount $account, int $id)
    {
        // $this->authorize('update', $account);

        $data = $request->validate([
            'balance'=>['required', 'max:25'],
            'name'=>['required', 'string','max:50'],
            'manager_id'=>['required', 'max:30']
        ]);

        $account->findOrFail($id)->update([
            'employee_id'=>$data['manager_id'],
            'balance'=>$data['balance'],
            'name'=>$data['name']
        ]);

        return back()->with('message', 'تم التعديل بنجاح');
    }

    public function destroy(CompanyAccount $companyAccount)
    {
        // $this->authorize('update', $account);
        
    }
}
