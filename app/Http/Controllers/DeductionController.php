<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Employee;
use App\Models\Deduction;
use Illuminate\Http\Request;
use App\Models\DeductionType;
use App\Models\CompanyAccount;
use App\Events\DeductionExpirey;
use Yajra\DataTables\DataTables;
use App\Http\Requests\saveDeduction;
use App\Models\DeductionTransaction;

class DeductionController extends Controller
{
    
    public function index(Request $request, Deduction $deduction)
    {

        event(new DeductionExpirey($deduction));

            // $this->authorize('viewAny', $deduction);
            
            if ($request->ajax()) {
                $deduction = Deduction::select(['id', 'deduction_type_id','employee_id','amount','effectiveDate','endDate'])->get();
                
                return DataTables::of($deduction)->addIndexColumn()->addColumn('action', function($deduction){
                
                    $btn = '<a href="/Employee/single/'.$deduction->employee_id.'" class="btn btn-primary m-1 fw-bold fs-5 btn-sm">تفاصيل</a>';
                
                    $btn = $btn. '<a href="/Deduction/'.$deduction->id.'/edit" class="btn btn-warning m-1 fw-bold fs-5 btn-sm">تعديل</a>';
                    
                    return $btn;
                
                })->editColumn('full_name', function($deduction){
                    
                    $deduction->with('employee')->get();
                    
                    return $deduction->employee->firstName .' '.$deduction->employee->sureName .' '.$deduction->employee->thirdName .' '.$deduction->employee->lastName;
                    
                })->editColumn('type', function($deduction){
                    return $deduction->deductionTypes[0]->name;
                })->
                rawColumns(['action'])->make(true);
            }
    
    
            return view('deduction.index');
        }

        public function create(Deduction $deduction)
        {
            // $this->authorize('create', $deduction);

            $employees = Employee::select('id', 'firstName', 'sureName', 'thirdName', 'lastName')->get();
            $types = DeductionType::select('id', 'name')->get();
            return view('deduction.create',compact('employees', 'types'));
        }


public function transaction(Deduction $deduction)
{
    // $this->authorize('create', $deduction);

     $deductions = $deduction->with('employee', 'deductionTypes')->get();


    return view('deduction.make-transaction')->with('deductions', $deductions);
}


public function transaction_report(DeductionTransaction $transaction, Request $request, Deduction $deduction)
{

    // $this->authorize('create', $deduction);
    if ($request->ajax()) {
        $transaction = DeductionTransaction::select(['id', 'deduction_id','company_account_acc_number', 'amount', 'date'])->get();

        return DataTables::of($transaction)->addIndexColumn()->addColumn('action', function($transaction){
        
            $btn = '<a href="/Deduction/'.$transaction->id.'/delete" class="btn btn-warning m-1 fw-bold fs-5 btn-sm">حذف</a>';
            
            return $btn;

        })->editColumn('full_name', function($transaction){
            
            $fomrattedName = $transaction->deduction->employee->firstName.' '
            .$transaction->deduction->employee->sureName.' '
            .$transaction->deduction->employee->thirdName.' '
            .$transaction->deduction->employee->lastName ;
            return $fomrattedName;
         
            
    })->editColumn('type', function($transaction){
        return $transaction->deduction->deductionTypes[0]->name;
    })->rawColumns(['action'])->make(true);
    
}

    return view('deduction.transactions-report');
}



public function save(Request $request, DeductionTransaction $transaction, Deduction $deduction)
{
    // $this->authorize('create', $deduction);


    $balance = CompanyAccount::find($request->acc_number);


    $currentBalance = $balance->balance + $request->amount;

    
    $deductions = $deduction->find($request->id);

    if ($request->amount == $deductions->amount) {
        
        $data = $request->validate(['id'=>['required','max:20'], 'acc_number'=>['required', 'max:12'], 'amount'=>['required','min:3'], 'date'=>['required', 'date']]);
       
        $balance->find($request->acc_number)->update(['balance'=>$currentBalance]);

            $transaction->create(['deduction_id'=>$data['id'], 
            'amount'=>$data['amount'],
            'company_account_acc_number'=>$data['acc_number'], 
            'date'=>$data['date']
        ]);
   
            return back()->with('message', 'تم حفظ المعاملة بنجاح');
    } else {
        return back()->with('warning', 'المبلغ المخصوم أعلى من المبلغ المسموح به');

    }
}


        public function show(Request $request, id $id, Deduction $deduction)
        {
            // $this->authorize('view', $deduction);

            $deduction = Deduction::findOrFail($id);
            return view('deduction.show')->with('deductions', $deduction);
        }

        public function store(saveDeduction $request, Deduction $deduction)
        {
            // $this->authorize('create', $deduction);

        
    
            Deduction::create([
                'employee_id'=>$request->emp_id,
                'deduction_type_id'=>$request->type,
                'amount'=>$request->amount,
                'stmt'=>$request->stmt,
                'effectiveDate'=>$request->effectiveDate,
                'endDate'=>$request->endDate,
            ]);
    
            return back()->with('message', 'تم الحفظ بنجاح');
        }
        
        public function edit(int $id, Deduction $deduction)
        {
            // $this->authorize('update', $deduction);

            $deduction = Deduction::findOrFail($id);
            
            return view('deduction.edit', compact('deduction'));
        }
    
        public function update(Request $request, Deduction $deduction, int $id)
        {
            // $this->authorize('update', $deduction);

            $data = $request->validate([
                'amount'=>['required', 'max:10'],
                'stmt'=>['required', 'max:50'],
                'endDate'=>['required', 'date']
            ]);
    
            Deduction::findOrFail($id)->update($data);
    
            return back()->with('message', 'تم التعديل');
        }

        public function delete(Request $request, Deduction $deduction)
        {
            // $this->authorize('delete', $deduction);

            $ids = $request->ids;
            $id = $request->id;

            if($ids || $id){

                Deduction::whereIn('id', $ids)->delete();
                
                Deduction::findOrFail($id)->delete();

                return view('employees.index')->with('message', 'تم الحذف');

            } else{
                
                return back()->with('error', 'خطأ أثناء عملية الحذف');

            }
            
        }
    }
