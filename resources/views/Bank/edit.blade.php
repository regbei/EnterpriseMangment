
@extends('layouts.app')
@section('content')

<div class="container justify-content-center">
        @if(session()->has('message'))  
                
                <div class='alert text-center fs-4 alert-success'>
                    <p class='fw-bold'>{{session('message')}}</p>
                </div>
        @endif
        <div class="col-md-6 col-lg-8 mx-auto col-sm-12 " dir="rtl">

            <div class="card">
                <div class="card-header"><h2>تعديل</h2></div>
                <div class="card-body">
                <form action="/Bank/{{$account->acc_number}}/update" method="post" style="font-size: 17px; font-family:sans-serif;">
                    @csrf
                    @method('PUT')
                    <div class="row mb-2">

                        <div class="col-md-12 mb-4 fw-bold">

                            <label for="" class="fw-bold form-label">إسم المالك</label>
                            <input type="text" name="owner_name" value="{{$account->owner_Name}}" maxlength="20" class="fw-bold form-control" required>
                            @error('owner_name')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        
                    </div>
                    
                    <div class="row mb-2">
                    
                        <div class="col-md-6">
                            <label for="" class="fw-bold form-label">عنوان البريد</label>
                            <input type="email" name="email" maxlength="30" value="{{$account->email}}" id="" class="fw-bold form-control" required>
                            @error('email')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    
                        <div class="col-md-6">
                            <label for="" class="fw-bold form-label">رقم الهاتف</label>
                            <input type="number" name="phone" maxlength="30" value="{{$account->phone}}" id="" class="fw-bold form-control" required>
                            @error('phone')
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