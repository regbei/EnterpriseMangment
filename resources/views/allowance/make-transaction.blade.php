
@extends('layouts.app')
@section('content')

<div class="container justify-content-center" dir="rtl">
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
        <div class="row">

            <div class="col-md-4 col-lg-4 fw-bold fs-5 mb-sm-3 col-sm-12">
                <div class="card">
                <div class="card-header">أنواع البدلات</div>
                <div class="card-body">
                    <table class="table table-responsive table-hover overflow-auto">
                        <thead class="table-dark">
                            <tr>
                                <th>نوع الخصم</th>
                                <th>المبلغ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($allowances as $item)
                            <tr>
                                <td>{{$item->allowanceTypes[0]->name}}</td>
                                <td>{{$item->amount}}</td>
                            </tr>
                            @empty
                            
                                
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-8 mx-auto fw-bold fs-5 col-sm-12">
            
            <div class="card" >
                <div class="card-header"><h2>إضافة معاملة</h2></div>
                <div class="card-body">
                    <form action="/Allowance/transaction/save" method="post">
                        @csrf


                    <div class="row mb-2">
                            
                    <div class="col-md-6 mb-4">
                                <label for="" class="fw-bold form-label">الموظف</label>
                                <select name="id"  class="form-select" id="" required>
                                    @forelse ($allowances as $item)
                                    <option value="{{$item->id}}">{{$item->employee->firstName ." ".$item->employee->sureName."
                                 ".$item->employee->thirdName." 
                                 ".$item->employee->lastName."  : ". $item->allowanceTypes[0]->name}}</option>                                
                                @empty
                                <option value="0">لايوجد سجل حالياً</option>
                                @endforelse
                            </select>
                            @error('id')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                    </div>
                            
                    <div class="col-md-6 mb-4">
                                <label for="" class="fw-bold form-label">الحساب</label>
                                <select name="acc_number"  class="form-select" id="">
                                    @forelse (\App\Models\CompanyAccount::get(); as $item)
                                    <option value="{{$item->acc_number}}">{{$item->name}}</option>                                
                                @empty
                                <option value="0">لايوجد سجل حالياً</option>
                                @endforelse
                            </select>
                            @error('acc_number')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                    </div>
                    
                    
                    </div>
                            
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <label for="" class="fw-bold form-label">المبلغ</label>
                            <input type="number" name="amount" maxlength="12" class="form-control" required>
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
                            <button type="submit" class="btn btn-primary fw-bold">حفظ</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>


    @endsection