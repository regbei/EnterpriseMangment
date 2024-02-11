
@extends('layouts.app')
@section('content')

<div class="container justify-content-center" dir="rtl">
        @if(session()->has('message'))  
        
        <div class="alert alert-success active text-end fs-5 d-flex">
            <p class='fw-bold'>{{session('message')}}</p>
            <i class="fas fa-file-circle-check me-auto fs-4"></i>
        </div>
        
        @endif


        <div class="card shadow" dir="rtl">
            <div class="card-header"><h2>تسجيل حساب مصرفي</h2></div>
            <div class="card-body">
                <form action="/Bank/store" method="post">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="" class="fw-bold form-label fs-5">رقم الحساب</label>
                            <input type="number" name="acc_number" maxlength="10" id="" class="form-control" required>
                            @error('acc_number')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        
                        
                        <div class="col-md-6">
                            <label for="" class="fw-bold form-label fs-5">إسم المالك</label>
                            <input type="text" name="owner_name" id="" maxlength="50" class="form-control" required>
                            @error('owner_name')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        
                    </div>

                        
                        <div class="row mb-3">
                            
                            <div class="col-md-6">
                                <label for="" class="fw-bold form-label fs-5">رقم الهاتف</label>
                                <input type="number"  name="phone" maxlength="15" id="" class="form-control" required>
                                @error('phone')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>


                            <div class="col-md-6">
                                <label for="" class="fw-bold form-label fs-5">البريد الإلكتروني</label>
                                <input type="email" name="email" maxlength="40" id="" class="form-control" required>
                                @error('email')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            
                        </div>
                 
                    
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary btn-lg fw-bold">حفظ</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    @endsection