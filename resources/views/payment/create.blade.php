
@extends('layouts.app')
@section('content')

<div class="container justify-content-center">
        @if(session()->has('message'))  
                <div class='alert alert-success'>
                    <p class='fw-bold'>{{session('message')}}</p>
                </div>
        @endif
        <div class="col-md-10 mx-auto">

            <div class="card">
                <div class="card-header"><h2>Payment Transactions</h2></div>
            <div class="card-body">
                <form action="/Payment/store" method="post">
                    @csrf
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <label for="" class="fw-bold form-label">Full Name</label>
                            <input type="text" name="name" maxlength="30" id="" value="{{old('name')}}" class="form-control">
                            @error('name')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        
                        
                    </div>

                    <div class="row mb-2">
   
                        <div class="col-md-12">
                            <label for="" class="fw-bold form-label">Title</label>
                            <input type="text" name="title" maxlength="20"  value="{{old('title')}}" id="" class="form-control">
                            @error('title')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>


                    </div>

                    <div class="row mb-2">

                        <div class="col-md-6">
                            <label for="" class="fw-bold form-label">payment type</label>
                            <select name="type" class="form-select">
                                <option value="income" selected>Income</option>
                                <option value="expense">expense</option>
                            </select>
                            @error('type')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>


                        
                        <div class="col-md-6">
                            <label for="" class="fw-bold form-label">Payment Metnod</label>
                            <select name="method" id="" class="form-select">
                                <option value="cash" selected>cash</option>
                                <option value="eBok">eBok</option>
                                <option value="cheque">Cheque</option>
                            </select>
                            @error('method')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>


                    <div class="row mb-2">
                        <div class="col-md-6">
                            <label for="" class="form-label">Amount</label>
                            <input type="number" name="amount" value="{{old('amount')}}" class="form-control">
                            @error('amount')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="" class="form-label">Paid</label>
                            <input type="number" name="paid" value="{{old('paid')}}" class="form-control">
                            @error('paid')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                    </div>
                    
                    <div class="row mb-2">
                            <div class="col-md-6">
                                <label for="" class="fw-bold form-label">Expense category</label>
                                <select name="expense_id" class="form-select" id="">
                                    @foreach ($expenses as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                                @error('expanse_id')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>

                    </div>

                    <div class="row mb-2">
                        <div class="col-md-12">
                            <label for="" class="fw-bold form-label">Desription</label>
                            <textarea name="description" id="" maxlength="50" cols="30" rows="10" class="form-control">{{old('description')}}</textarea>
                            @error('description')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row mb-2">
                        <div class="col-md-6">

                            <div class="form-check">
                                <input type="radio" name="status" value="paid" id="" class="form-check-input" checked required>
                                <label for="" class="fw-bold form-check-label">Paid</label>
                            </div>
                            
                            <div class="form-check">
                                <input type="radio" name="status" value="unpaid" id="" class="form-check-input" required>
                                <label for="" class="fw-bold form-check-label">unpaid</label>
                            </div>
                        </div>
                        </div>
                    
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    
    @endsection