
@extends('layouts.app')
@section('content')

<div class="container justify-content-center">
        @if(session()->has('message'))  
                <div class="alert alert-success fs-5 text-center">
                    <span class="fw-bold">{{session('message')}}</span>
                </div>
        @endif
        <div class="col-md-6 col-lg-8 mx-auto col-sm-12 " dir="rtl">

            <div class="card">
                <div class="card-header"><h2>تعديل</h2></div>
                <div class="card-body">
                <form action="/DPT/{{$DPT->id}}/update" method="post" style="font-size: 17px; font-family:sans-serif;">
                    @csrf
                    @method('PUT')
                    <div class="row mb-2">
                        <div class="col-md-12 mb-4 fw-bold">
                            <label for="" class="fw-bold form-label">المدير الحالي</label>
                            <input type="text" name="" value="{{$DPT->departmentManager->firstName.' '.$DPT->departmentManager->sureName.' '.$DPT->departmentManager->thirdName.' '.$DPT->departmentManager->lastName}}" id="" class="fw-bold form-control" disabled>
                        </div>


                        <div class="col-md-12 mb-4 fw-bold">
                            <label for="" class="fw-bold form-label">المدير الجديد</label>
                            <select name="employee_id" id="" class="fw-bold form-select">
                                @forelse (\App\Models\Employee::get() as $item)
                                <option value="{{$item->id}}">{{$item->firstName.' '.$item->sureName.' '.$item->thirdName.' '.$item->lastName}}</option>
                                @empty
                                    <option value="">غير متوفر حالياً</option>
                                @endforelse
                            </select>
                            @error('employee_id')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label for="" class="fw-bold form-label">إسم القسم</label>
                            <input type="text" name="name" maxlength="20" value="{{$DPT->name}}" id="" class="form-control" required>
                            @error('name')
                                <span class="invalid-feedback">{{$message}}</span>
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