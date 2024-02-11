
@extends('layouts.app')
@section('content')

<div class="container justify-content-center">
        @if(session()->has('message'))  
                <div class='alert alert-success'>
                    <p class='fw-bold'>{{session('message')}}</p>
                </div>
        @endif
        <div class="col-md-6 col-lg-8 mx-auto col-sm-12 " dir="rtl">

            <div class="card">
                <div class="card-header"><h2>تعديل</h2></div>
                <div class="card-body">
                <form action="/Deduction/{{$deduction->id}}/update" method="post" style="font-size: 17px; font-family:sans-serif;">
                    @csrf
                    @method('PUT')
                    <div class="row mb-2">
                        <div class="col-md-12 mb-4 fw-bold">
                            <label for="" class="fw-bold form-label">المبلغ الحالي</label>
                            <input type="text" name="" value="{{$deduction->amount}}" id="" class="fw-bold form-control" disabled>
                            @error('id')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label for="" class="fw-bold form-label">المبلغ الجديد</label>
                            <input type="number" name="amount" maxlength="12" id="" class="form-control" required>
                            @error('amount')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label for="" class="fw-bold form-label">البيان</label>
                            <textarea name="stmt" maxlength="50" id="" class="text-end form-control" value="" required>{{$deduction->stmt}}</textarea>
                            @error('stmt')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        
                    </div>




                    <div class="row mt-4 mb-2">
                        <div class="col-md-12">
                            <label for="" class="fw-bold form-label">تاريخ الإنتهاء</label>
                            <input type="date" name="endDate" id="" value="{{$deduction->endDate}}" class="fw-bold text-center form-control" required>
                            @error('endDate')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        
                        
                    </div>
                    
                    
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">حفظ</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    
    
    @endsection