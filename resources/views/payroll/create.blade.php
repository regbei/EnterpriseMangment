
@extends('layouts.app')
@section('content')

<div class="container justify-content-center">
        @if(session()->has('message'))  
                <div class='alert alert-success fs-5 text-center'>
                    <p class='fw-bold'>{{session('message')}}</p>
                </div>
        @endif
        <div class="col-md-6 col-lg-8 mx-auto fw-bold fs-5 col-sm-12">

            <div class="card" dir="rtl">
                <div class="card-header"><h2>تسجيل الرواتب</h2></div>
                <div class="card-body">
                <form action="/Payroll/store" method="post">
                    @csrf
                    <div class="row mb-2">
                        <div class="col-md-12 mb-4">
                            <label for="" class="fw-bold form-label">رقم الموظف</label>
                            <select name="id"  class="form-select" id="" required>
                                @foreach ($employees as $item)
                                <option value="{{$item->id}}">{{$item->firstName ." ".$item->sureName." ".$item->thirdName." ".$item->lastName}}</option>
                                @endforeach
                            </select>
                            @error('id')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label for="" class="fw-bold form-label">الراتب</label>
                            <input type="number" name="salary" maxlength="12" id="" class="form-control" required>
                            @error('salary')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        
                    </div>




                    <div class="row mt-4 mb-2">
                        
                        <div class="col-md-6">
                            <label for="" class="fw-bold form-label">تاريخ السريان</label>
                            <input type="date" name="effectiveDate" id="" value="{{old('effectiveDate')}}" class="form-control text-center" required>
                            @error('effectiveDate')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>


                        <div class="col-md-6">
                            <label for="" class="fw-bold form-label">تاريخ الإنتهاء</label>
                            <input type="date" name="endDate" id="" value="{{old('endDate')}}" class="form-control text-center" required>
                            @error('endDate')
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
    
    
    @endsection