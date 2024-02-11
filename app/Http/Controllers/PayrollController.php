<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Events\PayrollExpirey;
use App\Models\CompanyAccount;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use App\Http\Requests\savePayroll;
use App\Models\PayrollTransaction;

class PayrollController extends Controller
{

public function index(Request $request, Payroll $payroll)
{
    // $this->authorize('viewAny', $payroll);
    
    event(new PayrollExpirey($payroll));
    if ($request->ajax()) {
        $payroll = Payroll::select('id', 'employee_id', 'salary', 'effectiveDate', 'endDate');
        return DataTables::of($payroll)->addIndexColumn()->addColumn('action', function($payroll){
            
            $btn = '<a href="/Employee/single/'.$payroll->employee_id.'" class="fw-bold btn btn-info btn-sm m-1 fs-5">عرض</a>';
            
            $btn = $btn .'<a href="/Payroll/'.$payroll->id.'/edit" class="fw-bold btn btn-warning btn-sm m-1 fs-5">تعديل</a>';
            
            return $btn;
            
        })->editColumn('full_name', function($payroll){
            
            $payroll->with('employee')->get();
            
            return $payroll->employee->firstName .' '.$payroll->employee->sureName .' '.$payroll->employee->thirdName .' '.$payroll->employee->lastName;

        })->rawColumns(['action'])->make(true);
    }

    return view('payroll.index');
}

public function create(Payroll $payroll)
{   
    // $this->authorize('create', $payroll);
    
    $employees = Employee::get();
    return view('payroll.create', compact('employees'));
}


public function transaction(Payroll $payroll, CompanyAccount $account)
{
    // $this->authorize('create', $payroll);
    
     $payrolls = $payroll->with('employee')->get();

    return view('payroll.make-transaction')->with('payrolls', $payrolls);
}

public function transaction_report(PayrollTransaction $transaction, Request $request, Payroll $payroll)
{

    // $this->authorize('create', $payroll);
    if ($request->ajax()) {
        $transaction = PayrollTransaction::select(['id','payroll_id', 'company_account_acc_number', 'amount', 'date'])->get();

        return DataTables::of($transaction)->addIndexColumn()->addColumn('action', function($transaction){
        
            $btn = '<a href="/Payroll/'.$transaction->id.'/edit" class="btn btn-warning m-1 fw-bold fs-5 btn-sm">عرض</a>';
            
            return $btn;

        })->editColumn('full_name', function($transaction){
            
            $fomrattedName = $transaction->payroll->employee->firstName.' '.$transaction->payroll->employee->sureName.' '.$transaction->payroll->employee->thirdName.' '.$transaction->payroll->employee->lastName ;
            return $fomrattedName;
         
        })->rawColumns(['action'])->make(true);
    }

    return view('payroll.transactions-report');
}


public function save(Request $request, PayrollTransaction $transaction, Payroll $payroll)
{
    // $this->authorize('create', $payroll);
    $data = $request->validate([
        'id'=>['required','max:20'],
        'acc_number'=>['required','max:10'],
        'amount'=>['required','min:3'],
        'date'=>['required', 'date'],
    ]);
    
    $balance = CompanyAccount::find($request->acc_number);

    $currentBalance = $balance->balance - $request->amount;

    $payrolls = $payroll->find($request->id);

    if ($request->amount <= $payrolls->salary && $balance->balance >= $request->amount) {
        
        $transaction->create([
            'payroll_id'=>$data['id'],
            'amount'=>$data['amount'],
            'company_account_acc_number'=>$data['acc_number'],
            'date'=>$data['date'],
        ]);
        
        $balance->find($request->acc_number)->update(['balance'=>$currentBalance]);
   
            return back()->with('message', 'تم المعاملة بنجاح');
    }else{
        
        return back()->with('warning', 'المبلغ المدخل أكبر من المبلغ المصرح به');

    }

}


public function store(savePayroll $request, Payroll $payroll)
{
    // $this->authorize('create', $payroll);

    
    Payroll::create([
        'employee_id'=>$request->id,
        'salary'=>$request->salary,
        'effectiveDate'=>$request->effectiveDate,
        'endDate'=>$request->endDate,
    ]);

    return back()->with('message', 'تم الحفظ :)');
}

    public function edit(int $id, Payroll $Payroll)
    {
    // $this->authorize('update', $Payroll);
    
    $Payroll = Payroll::findOrFail($id);
    return view('payroll.edit', compact('Payroll'));
    }

public function update(Request $request, Payroll $payroll)
{
// $this->authorize('update', $payroll);
    
    $data = $request->validate([
        'salary'=>['required', 'min:1', 'max:10'],
        'endDate'=>['required', 'date']
    ]);
    $payroll->findOrFail($request->id)->update($data);
    return back()->with('message', 'تم التعديل');

}

public function delete(Request $request, Payroll $payroll, int $id)
{
// $this->authorize('delete', $payroll);
if($payroll->find($id)->delete()){

    return view('payroll.create')->with('message', 'تم الحذف');

} else {
    return view('payroll.create')->with('warning', 'فشل الحذف');

}

}

}
