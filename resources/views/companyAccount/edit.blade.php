
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
                <div class="card-header"><h2>تعديل بيانات الحساب</h2></div>
                <div class="card-body">
                <form action="/Account/{{$account->acc_number}}/update" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row mb-2">
                        
                        <div class="col-md-12 mb-4 fw-bold">
                            <label for="" class="fw-bold form-label">الرصيد الحالي</label>
                            <input type="text" name="" value="{{number_format($account->balance)}}" id="" class="fw-bold form-control" disabled>
                            @error('id')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label for="" class="fw-bold form-label">الرصيد الجديد</label>
                            <input type="number" name="balance" value="{{$account->balance}}" maxlength="12" id="" class="form-control" required>
                            @error('balance')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        
                    </div>




                    <div class="row mt-4 mb-2">
                        <div class="col-md-6 ">
                            <label for="" class="fw-bold form-label">عنوان الحساب</label>
                            <input type="text" name="name" value="{{$account->name}}" class="text-center fw-bold form-control" required>
                            @error('name')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    
                    
                        <div class="col-md-6 ">
                            <label for="" class="fw-bold form-label">الموظف المسؤول</label>
                            <select name="manager_id" id="" class="form-select">
                                @forelse (\App\Models\Employee::get(); as $item)
                                <option value="{{$item->id}}">{{$item->firstName.' '.$item->sureName.' '.$item->thirdName.' '.$item->lastName}}</option>
                                @empty
                                @endforelse
                            </select>
                            @error('name')
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