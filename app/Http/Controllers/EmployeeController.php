<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Branch;
use App\Models\Payroll;
use App\Models\Employee;
use App\Models\Allowance;
use App\Models\Deduction;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\saveEmployee;
use Illuminate\Support\Facades\File;
use App\Http\Requests\updateEmployee;
use App\Notifications\createEmployee;
use Illuminate\Support\Facades\Notification;

class EmployeeController extends Controller
{
    public function index(Request $request, Employee $employee)
    {
        // $this->authorize('viewAny', $employee);

        if ($request->ajax()) {
            $employee = Employee::select('id', 'firstName', 'sureName', 'thirdName', 'lastName', 'email', 'phone', 'hiredAt', 'gender','birthDate', 'position', 'department_id')->get();
            return Datatables::of($employee)->addIndexColumn()
                ->addColumn('action', function($employee){
                    $btn = '<a href="/Employee/single/'.$employee->id.'" class="fw-bold btn btn-outline-info btn-sm  m-1">عرض</a>';
                    $btn = $btn . '<a href="/Employee/'.$employee->id.'/edit" class="fw-bold btn btn-none btn-sm  m-1">تعديل</a>';
                    return $btn;
                })->editColumn('full_name', function($employee){
                    $formattedName = $employee->firstName.' '.$employee->sureName.' '.$employee->thirdName.' '.$employee->lastName;
                    return $formattedName;
                })->editColumn('department', function($employee){

                    return $employee->department->name;

                })->rawColumns(['action'])->make(true);
        }


        return view('employees.index');
    }
    
    public function show(Request $request, $id, Employee $employee)
    {
        // $this->authorize('info', $employee);
        $employees = Employee::findOrFail($id);
        
        $start = Carbon::createFromFormat('Y-m-d', $employees->hiredAt);
        $end = Carbon::createFromFormat('Y-m-d', date('Y-m-d'));
        $atService = $start->diffInYears($end);
        $start = Carbon::createFromFormat('Y-m-d', $employees->birthDate);
        $end = Carbon::createFromFormat('Y-m-d', date('Y-m-d'));
        $Age = $start->diffInYears($end);

        return view('employees.show', compact('employees', 'atService', 'Age'));
    }

    public function create(Employee $employee, Request $request)
    {
        // $this->authorize('create', $employee);
        // dd($request->ip());
        $branches = Branch::select('id', 'name')->get();
        $departments = Department::select('id', 'name')->get();
        
        return view('employees.create', compact('branches', 'departments'));
    }

    public function store(saveEmployee $request, Employee $employee)
    {
        // $this->authorize('create', $employee);

        $id = $request->id;
       
        $fullName=$request->firstName. ' '.$request->sureName.' ' .$request->thirdName.' ' .$request->lastName; 
        $users= User::whereIn('role_id', [1,2])->get();
       
        Notification::send($users, new createEmployee($id, $fullName));
        
        if($request->hasFile('image')){
            $request->file('image')->store('profile', 'public');
            $data['image'] = $request->file('image')->hashName();
            Employee::create([
                'id'=>$request->id,
                'firstName'=>$request->firstName,
                'sureName'=>$request->sureName,
                'thirdName'=>$request->thirdName,
                'lastName'=>$request->lastName,
                'gender'=>$request->gender,
                'religion'=>$request->religion,
                'birthDate'=>$request->birthDate,
                'hiredAt'=>$request->hiredAt,
                'phone'=>$request->phone,
                'email'=>$request->email,
                'marital_status'=>$request->marital_status,
                'position'=>$request->position,
                'qualifications'=>$request->qualifications,
                'branch_id'=>$request->branch,
                'department_id'=>$request->department,
                'address'=>$request->address,
                'image'=>$data['image'],
            ]);
       
            return back()->with('message', 'تم الحفظ');
        
        } else {
        
            return back()->with('warning', 'فشل الحفظ');
        
        }


    }

    public function edit(Request $request, Employee $employee, int $id)
    {
        // $this->authorize('update', $employee);

        
        $employee = Employee::find($id);
        
        $branchs = Branch::select('id', 'name')->get();
        
        $departments = Department::select('id', 'name')->get();
        
        return view('employees.edit', compact('employee', 'departments',  'branchs'));
    }
    
    public function update(Request $request, Employee $employee, int $id)
    {
        // $this->authorize('update', $employee);
        $image = Employee::findOrFail($id);
        File::delete(public_path('storage\profile\\'.$image->image));
        
        $data = $request->validate([
            'firstName'=>['required', 'max:10', 'string'],
            'sureName'=>['required', 'max:10', 'string'],
            'thirdName'=>['required', 'max:10', 'string'],
            'lastName'=>['required', 'max:10', 'string'],
            'email'=>['required', 'email', 'min:10', 'max:30'],
            'phone'=>['required','min:6','max:11'],
            'address'=>['required', 'string', 'min:10','max:30'],
            'hiredAt'=>['required','date'],
            'qualifications'=>['required', 'string', 'min:10','max:40'],
            'position'=>['required',  'min:4','max:15'],
            'marital_status'=>['required',  'min:4','max:15'],
            'department'=>['required', 'integer', 'min:1','max:10'],
            'branch'=>['required', 'integer', 'min:1','max:17'],
            'image'=>['image', 'max:160000'],
        ]);
        // dd($request->all());
        
        if ($request->hasFile('image')) {

            $request->file('image')->store('profile', 'public');
            $data['image'] = $request->file('image')->hashName();
            Employee::findOrFail($id)->update([
                'firstName'=>$data['firstName'],
                'sureName'=>$data['sureName'],
                'thirdName'=>$data['thirdName'],
                'lastName'=>$data['lastName'],
                'email'=>$data['email'],
                'phone'=>$data['phone'],
                'address'=>$data['address'],
                'hiredAt'=>$data['hiredAt'],
                'marital_status'=>$data['marital_status'],
                'qualifications'=>$data['qualifications'],
                'position'=>$data['position'],
                'department_id'=>$data['department'],
                'branch_id'=>$data['branch'],
                'image'=>$data['image']
            ]);
            

            return back()->with('message', "تم التعديل");

        } else {

            return back()->with('message', "$id فشل التعديل");

        }

    }

    public function delete(Request $request, Employee $employee, int $id)
    {
        // $this->authorize('delete', $employee);

        $image = Employee::findOrFail($id);
        // dd(public_path('storage\profile\\'.$image->image));
        File::delete(public_path('storage\profile\\'.$image->image));
            Payroll::whereIn('employee_id', [$id])->delete();
            Deduction::whereIn('employee_id', [$id])->delete();
            Allowance::whereIn('employee_id', [$id])->delete();
    
            $employee->findOrFail($id)->delete();
            return redirect('/Employee')->with('message', 'تم الحذف');
        }
    }
