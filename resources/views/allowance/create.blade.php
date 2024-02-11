
@extends('layouts.app')
@section('content')

<div class="container justify-content-center">
        @if(session()->has('message'))  
                <div class='alert text-center fs-5 alert-success'>
                    <p class='fw-bold'>{{session('message')}}</p>
                </div>
        @endif

        <div class="card" dir="rtl">
            <div class="card-header"><h2>البدلات والحوافز</h2></div>
            <div class="card-body">
                <form action="/Allowance/store" method="post">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="" class="fw-bold form-label">رقم الموظف</label>
                            <select name="emp_id" class="form-select">
                            @forelse ($employees as $item)
                            <option value="{{$item->id}}">{{$item->firstName." ".$item->sureName." ".$item->thirdName." ".$item->lastName}}</option>
                            
                            @empty
                                <option value="">لايوجد موظفين في الوقت الحالي</option>
                            @endforelse
                            
                        </select>
                            @error('emp_id')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="" class="fw-bold form-label">المبلغ</label>
                            <input type="number" name="amount" id="" value="{{old('amount')}}" class="form-control" required>
                            @error('amount')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="" class="fw-bold form-label">نوع الحافز</label>
                            <select name="type" class="form-select">
                                @foreach ($types as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                            @error('type')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        
                    </div>

                    <div class="row mb-3">

                        <div class="col-md-6">
                            <label for="" class="fw-bold form-label">تاريخ السريان</label>
                            <input type="date" name="effectiveDate"  class="text-center form-control" value="{{old('effectiveDate')}}" id="" required>
                            @error('effectiveDate')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="" class="fw-bold form-label"> تاريخ الإنتهاء</label>
                            <input type="date" name="endDate"  class="text-center form-control" value="{{old('endDate')}}" id="" required>
                            @error('endDate')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        
                    </div>


     
                    <div class="row mb-3">
                        
                        <div class="col-md-12">
                            <label for="" class="fw-bold form-label">تعليق</label>
                            <textarea name="stmt" id="" maxlength="80" value="" class="form-control" required>{{old('stmt')}}</textarea>
                            @error('stmt')
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

    
    @endsection