<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Allowance;
use Illuminate\Http\Request;
use App\Models\AllowanceType;
use App\Models\CompanyAccount;
use App\Events\AllowanceExpirey;
use Yajra\DataTables\DataTables;
use App\Http\Requests\saveAllowance;
use App\Models\AllowanceTransaction;

class AllowanceController extends Controller
{
    public function index(Request $request, Allowance $allowance)
    {
        // $this->authorize('view', $allowance);
        event(new AllowanceExpirey($allowance));

        
    if ($request->ajax()) {
        $allowance = Allowance::select('id','allowance_type_id' , 'employee_id', 'amount', 'effectiveDate', 'endDate')->get();
        return DataTables::of($allowance)->addIndexColumn()->addColumn('action', function($allowance){
            $btn = '<a href="/Employee/single/'.$allowance->employee_id.'" class="btn btn-primary btn-sm fw-bold fs-5 m-1">عرض</a>';
            $btn = $btn.'<a href="/Allowance/'.$allowance->id.'/edit" class="btn btn-warning m-1 fw-bold fs-5 btn-sm">تعديل</a>';
            return $btn;
        })->editColumn('full_name', function($allowance){
           
            $allowance->with('employee')->get();
           
            return $allowance->employee->firstName .' '.$allowance->employee->sureName .' '.$allowance->employee->thirdName .' '.$allowance->employee->lastName;
                
            })->editColumn('type', function($allowance){
                
                $allowance->with('allowanceTypes')->get();
                
                return $allowance->allowanceTypes[0]->name;
            })->
            rawColumns(['action'])->make(true);
        }
        return view('allowance.index');
    }


    public function create(Allowance $allowance)
    {
        // $this->authorize('create', $allowance);

        $types = AllowanceType::select('id', 'name')->get();
        $employees = Employee::select('id', 'firstName', 'sureName', 'thirdName','lastName')->get();
        return view('Allowance.create', compact('types', 'employees'));
    }


    public function store(saveAllowance $request, Allowance $allowance)
    {
        // $this->authorize('create', $allowance);

      

        $allowance->create([
            'employee_id'=>$request->emp_id,
            'allowance_type_id'=>$request->type,
            'amount'=>$request->amount,
            'stmt'=>$request->stmt,
            'effectiveDate'=>$request->effectiveDate,
            'endDate'=>$request->endDate,
        ]);

        return back()->with('message', 'تم الحفظ :)');
    }


    public function transaction(Allowance $allowance)
    {
        // $this->authorize('create', $allowance);
    
         $allowances = $allowance->with('employee', 'allowanceTypes')->get();
    
        return view('allowance.make-transaction')->with('allowances', $allowances);
    }

    public function transaction_report(AllowanceTransaction $transaction, Request $request, Allowance $allowance)
{

    // $this->authorize('view', $allowance);
    if ($request->ajax()) {
     
        $transaction = AllowanceTransaction::select(['id', 'allowance_id', 'company_account_acc_number','amount', 'date'])->get();

        return DataTables::of($transaction)->addIndexColumn()->addColumn('action', function($transaction){
        
            $btn = '<a href="/Allowance/'.$transaction->id.'/delete" class="btn btn-warning m-1 fw-bold fs-5 btn-sm">حذف</a>';
            
            return $btn;

        })->editColumn('full_name', function($transaction){
            
            $fomrattedName = $transaction->allowance->employee->firstName.'
             '.$transaction->allowance->employee->sureName.'
              '.$transaction->allowance->employee->thirdName.'
               '.$transaction->allowance->employee->lastName ;
            
            return $fomrattedName;
                    
    })->editColumn('type', function($transaction){
        return $transaction->allowance->allowanceTypes[0]->name;
    })-> rawColumns(['action'])->make(true);
    

    }

    return view('allowance.transactions-report');
}
    
    public function save(Request $request, AllowanceTransaction $transaction, Allowance $allowance)
    {
        // $this->authorize('create', $allowance);
        
        $balance = CompanyAccount::find($request->acc_number);


        $currentBalance = $balance->balance - $request->amount;

    
        $allowances = $allowance->find($request->id);
    
        if ($request->amount <= $allowances->amount && $balance->balance >= $request->amount) {
            
            $data = $request->validate(['id'=>['required','max:20'], 'acc_number'=>['required', 'max:12'], 'amount'=>['required','min:3'], 'date'=>['required', 'date']]);
           
            $balance->find($request->acc_number)->update(['balance'=>$currentBalance]);

            $transaction->create([
                'allowance_id'=>$data['id'],
                'company_account_acc_number'=>$data['acc_number'],
                'amount'=>$data['amount'],
                'date'=>$data['date']]);
       
                return back()->with('message', 'تم حفظ المعاملة بنجاح');
        } else {
            return back()->with('warning', 'المبلغ المدخل أكبر من المبلغ أو لايوجد رصيد كافي');
    
        }
    
        
    
    }
    
    public function edit(int $id, Allowance $allowance)
    {
        // $this->authorize('update', $allowance);

        $allowance = Allowance::findOrFail($id);
        return view('allowance.edit', compact('allowance'));
    }

    public function update(Allowance $allowance, Request $request, int $id)
    {
        // $this->authorize('update', $allowance);

        $data = $request->validate([
            'amount'=>['required', 'max:10'],
            'stmt'=>['required', 'max:50'],
            'endDate'=>['required', 'date']
        ]);

        Allowance::findOrFail($id)->update($data);

        return back()->with('message', 'تم التعديل :)');
    }
 
    public function delete(Request $request, Allowance $allowance)
    {
        // $this->authorize('delete', $allowance);
        $ids = $request->ids;
        $id = $request->id;

        if($ids || $id){

            Allowance::whereIn('id', $ids)->delete();
            
            Allowance::findOrFail($id)->delete();
            
            return redirect('/Employee')->with('message', 'تم الحذف');

        }else{
            
            return redirect('/Employee/index')->with('error', 'لم يتم الحذف');
        }
        
    }
}
