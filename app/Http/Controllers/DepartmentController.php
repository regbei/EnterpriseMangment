<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class DepartmentController extends Controller
{
 
    

    public function index(Request $request, Department $DPT)
    {
        
        // $this->authorize('viewAny', $DPT);
        if ($request->ajax()) {

            $data = $DPT->get();
    
            return DataTables::of($data)->addIndexColumn()->addColumn('action', function($data){
            
                $btn = '<a href="/DPT/'.$data->id.'/edit" class="btn btn-warning m-1 fw-bold fs-5 btn-sm">تعديل</a>';
                $btn =$btn. '<a href="/DPT/'.$data->id.'/show" class="btn btn-secondary m-1 fw-bold fs-5 btn-sm">عرض</a>';
                
                return $btn;
    
            })->editColumn('Manager', function($DPT){
                return $DPT->departmentManager->firstName.' '.$DPT->departmentManager->sureName.' '.$DPT->departmentManager->thirdtName.' '.$DPT->departmentManager->lastName;
            })->rawColumns(['action'])->make(true);
        }
        
        return view('DPT.index');
    }

    
    public function create(Department $DPT)
    {
        // $this->authorize('create', $DPT);
        
        return view('DPT.create');
    }
    
    
    public function store(Request $request, Department $DPT)
    {
        // $this->authorize('create', $DPT);
        $data = $request->validate([
            'name'=>['required', 'string', 'min:5','max:20', Rule::unique('departments', 'name')],
            'manager_id'=>['required', 'min:1', 'max:15', Rule::unique('departments', 'employee_id')],
        ]);

        Department::create([
            'name'=>$data['name'],
            'employee_id'=>$data['manager_id'],
        ]);
        
        return back()->with('message', 'تمت إضافة قسم جديد بنجاح :)');
    }
    
    public function show(Department $DPT, int $id)
    {
        // $this->authorize('view', $DPT);
        
        $DPT = Department::findOrFail($id);
        return view('DPT.show')->with('DPT', $DPT);
    }
    
    
    public function edit(Department $department, int $id)
    {
        // $this->authorize('update', $department);
        $DPT = Department::findOrFail($id);
        return view('DPT.edit')->with('DPT', $DPT);
        
    }
    
    public function update(Request $request, Department $DPT, int $id)
    {
        // $this->authorize('update', $DPT);
        
        $data = $request->validate([
            'name'=>['min:5','string','max:20', Rule::unique('departments', 'name')],
            'employee_id'=>['min:10','max:15'],
        ]);
        
        
        $DPT->findOrFail($id)->update($data);
        
        return back()->with('message', 'تم التعديل بنجاح :)');
    }
    
    public function delete(Department $department, int $id)
    {
        // $this->authorize('delete', $department);
        $department->findOrFail($id)->delete();
        return back()->with('message', 'تم الإزالة بنجاح :)');
    }
}
