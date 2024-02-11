
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
                <div class="card-header"><h2>  تعديل الراتب الأساسي</h2></div>
                <div class="card-body">
                <form action="/Payroll/{{$Payroll->id}}/update" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row mb-2">
                        <div class="col-md-12 mb-4 fw-bold">
                            <label for="" class="fw-bold form-label">المبلغ الحالي</label>
                            <input type="text" name="" value="{{$Payroll->salary}}" id="" class="fw-bold form-control" disabled>
                            @error('id')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label for="" class="fw-bold form-label">المبلغ الجديد</label>
                            <input type="number" name="salary" maxlength="12" id="" class="form-control" required>
                            @error('salary')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        
                    </div>




                    <div class="row mt-4 mb-2">
                        <div class="col-md-12">
                            <label for="" class="fw-bold form-label">تاريخ إنتهاء المرتب</label>
                            <input type="date" name="endDate" id="" value="{{$Payroll->endDate}}" class="text-center form-control" required>
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