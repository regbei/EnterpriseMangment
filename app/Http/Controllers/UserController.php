<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function __construct(User $user)
    {
        
    }

    public function index(Request $request, User $user)
    {
        // $this->authorize('view', $user);
        if ($request->ajax()) {
            $data = User::get();
            return DataTables::of($data)->addIndexColumn()->addColumn('action', function($data){
                $btn = '<a href="/User/'.$data->id.'/edit" class="fw-bold btn btn-info btn-sm m-1 fs-5">تعديل</a>';
                return $btn;
            })->editColumn('role', function($data){
                return $data->role->name;
            })->rawColumns(['action'])->make(true);

        }

        return view('User.index');
    }


    public function create()
    {
        //
    }

    public function marked(Request $request, $id)
    {
        $notify = Notification::findOrFail($id);
        $notify->update(['read_at'=>now()]);
        return redirect()->back();
    }

    public function store(Request $request)
    {
        //
    }

    public function show(User $user)
    {
        //
    }


    public function edit(User $user, int $id)
    {
        // $this->authorize('update', $user);
        $user = User::find($id);
        return view('User.edit')->with('user',$user);
    }

   
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'=>['required', 'min:5', 'max:20'],
            'email'=>['required','email', 'max:30']
        ]);

        // dd($data);

        User::find($request->id)->update($data);

        return back()->with('message', 'تم التعديل');
    }

    public function destroy(User $user)
    {
        //
    }
}
