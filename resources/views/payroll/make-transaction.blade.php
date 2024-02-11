
@extends('layouts.app')
@section('content')

<div class="container justify-content-center">
            @if (session()->has('message'))    
            <div class="alert alert-success active text-end fs-5 d-flex">
                    <p class='fw-bold'>{{session('message')}}</p>
                    <i class="fas fa-file-circle-check me-auto fs-4"></i>
            </div>
        @endif 

        @if (session()->has('warning'))    
            <div class="alert alert-warning active text-end fs-5 d-flex">
                    <p class='fw-bold'>{{session('warning')}}</p>
                    <i class="fas fa-sack-xmark me-auto fs-4"></i>
            </div>
        @endif 
        <div class="col-md-6 col-lg-8 mx-auto fw-bold fs-5 col-sm-12">

            <div class="card" dir="rtl">
                <div class="card-header"><h2>إجراء معاملة</h2></div>
                <div class="card-body">
                <form action="/Payroll/transaction/save" method="post">
                    @csrf
                    <div class="row mb-2">
                        <div class="col-md-12 mb-4">
                            <label for="" class="fw-bold form-label">الموظف</label>
                            <select name="id"  class="form-select" id="" required>
                                @foreach ($payrolls as $item)
                                <option value="{{$item->id}}">{{$item->employee->firstName ." ".$item->employee->sureName." ".$item->employee->thirdName." ".$item->employee->lastName .' : '.$item->salary}}</option>
                                @endforeach
                            </select>
                            @error('id')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row mb-2">
                    
                        <div class="col-md-6">
                            <label for="" class="fw-bold form-label">الحساب</label>
                            <select name="acc_number" id="" class="form-select">
                                @forelse (\App\Models\CompanyAccount::get(); as $item)
                                <option value="{{$item->acc_number}}">{{$item->name}}</option>
                                @empty

                                @endforelse
                            </select>
                            @error('amount')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="" class="fw-bold form-label">المبلغ</label>
                            <input type="number" name="amount" maxlength="12" id="" class="form-control" required>
                            @error('amount')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        
                    </div>




                    <div class="row mt-4 mb-2">
                        
                        <div class="col-md-12">
                            <label for="" class="fw-bold form-label">التاريخ</label>
                            <input type="date" name="date" id="" value="{{old('date')}}" class="form-control text-center" required>
                            @error('date')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        
                        
                    </div>
                    
                    
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary fw-bolder">حفظ</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    
    
    @endsection