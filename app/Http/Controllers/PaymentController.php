<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\ExpenseCategory;

class PaymentController extends Controller
{
    public function index()
    {
        $report = Payment::Where('expense_id', 1)->sum('amount_paid');
        return view('payment.index', compact('report'));
    }
    public function create()
    {
        $expenses = ExpenseCategory::select('id','name')->get();
        return view('payment.create', compact('expenses'));
    }
    public function store(Request $request)
    {
        $data=$request->validate([
            'name'=>['required','string','min:7', 'max:30'],
            'title'=>['required','string','min:7', 'max:30'],
            'type'=>['required','string','min:4', 'max:30'],
            'method'=>['required','string','min:4', 'max:30'],
            'amount'=>['required','min:1', 'max:10'],
            'paid'=>['required','min:1', 'max:10'],
            'status'=>['required','string','min:1', 'max:10'],
            'description'=>['required','string','min:1', 'max:100'],
            'expense_id'=>['required','min:1', 'max:30']
        ]);
        $data['residual'] = $data['amount'] - $data['paid'];
        // dd($data['residual']);

        Payment::create([
            'Fname'=>$data['name'],
            'title'=>$data['title'],
            'type'=>$data['type'],
            'method'=>$data['method'],
            'amount'=>$data['amount'],
            'amount_paid'=>$data['paid'],
            'status'=>$data['status'],
            'description'=>$data['description'],
            'expense_id'=>$data['expense_id'],
            'residual'=>$data['residual']
        ]);

        return back()->with('message', 'Payment Succeed');
    }
    public function edit()
    {
        
    }
    public function update()
    {
        
    }
    public function delete()
    {
        
    }
}
