
@extends('layouts.app')
@section('content')

<div class="container justify-content-center">
        @if(session()->has('message'))  
                <div class='alert alert-success'>
                    <p class='fw-bold'>{{session('message')}}</p>
                </div>
        @endif

        <div class="card" dir="rtl" style="font-size: 17px;">
            <div class="card-header"><h2>تعديل</h2></div>
            <div class="card-body">
                <form action="/Employee/{{$employee->id}}/update" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row mb-2">
                        <div class="col-md-3">
                            <label for="" class="fw-bold form-label">الإسم الأول</label>
                            <input type="text" name="firstName" maxlength="10" value="{{$employee->firstName}}" id="" class="form-control fw-bold" >
                            @error('firstName')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        
                        <div class="col-md-3">
                            <label for="" class="fw-bold form-label">الإسم الثاني</label>
                            <input type="text" name="sureName" maxlength="10" value="{{$employee->sureName}}" id="" class="form-control fw-bold" >
                            @error('sureName')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="" class="fw-bold form-label">الإسم الثالث</label>
                            <input type="text" name="thirdName" maxlength="10" value="{{$employee->thirdName}}" id="" class="form-control fw-bold">
                            @error('thirdName')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>


                        
                        <div class="col-md-3">
                            <label for="" class="fw-bold form-label">الإسم الرابع</label>
                            <input type="text" name="lastName" maxlength="10" value="{{$employee->lastName}}"id="" class="form-control fw-bold">
                            @error('lastName')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>


                    </div>

                    <div class="row mb-2">

                        <div class="col-md-6">
                            <label for="" class="fw-bold form-label">تاريخ الميلاد</label>
                            <input type="date" name="birthDate" id="" value="{{$employee->birthDate}}" class="text-center form-control fw-bold" >
                            @error('birthDate')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        
                        <div class="col-md-6">
                            <label for="" class="fw-bold form-label">تاريخ التعيين</label>
                            <input type="date" name="hiredAt" id="" value="{{$employee->hiredAt}}" class="text-center form-control fw-bold" >
                            @error('hiredAt')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>


                    <div class="row mb-2">
                        
     
                        <div class="col-md-6">
                            <label for="" class="fw-bold form-label">البريد الإلكتروني</label>
                            <input type="text" name="email" id="" maxlength="20" value="{{$employee->email}}" class="form-control fw-bold" >
                            @error('email')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="" class="fw-bold form-label">الحالةالإجتماعية</label>
                            <select name="marital_status" id=""  class="form-control fw-bold" required>
                                <option value="أعزب">أعزب</option>
                                <option value="متزوج">متزوج</option>
                                <option value="{{$employee->marital_status}}" @selected(true)>{{$employee->marital_status}}</option>
                                <option value="مطلق">مطلق</option>
                                <option value="أرمل">أرمل</option>
                            </select>
                        @error('marital_status')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                        </div>

                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <label for="" class="form-label fw-bold">المؤهلات الدراسية</label>
                            <input type="text" maxlength="20" name="qualifications" value="{{$employee->qualifications}}" id="" class="form-control fw-bold" ></div>
                        
                        <div class="col-md-6">
                            
                            <label for="" class="form-label fw-bold">المنصب</label>
                            <select name="position" id="" class="form-select" required>
                                <option value="مهندس">مهندس</option>
                                <option value="{{$employee->position}}" @selected(true)>{{$employee->position}}</option>
                                <option value="محاسب">محاسب</option>
                                <option value="إداري">إداري</option>
                                <option value="موارد بشرية">موارد بشرية</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        
                        <div class="col-md-6">
                            <label for="" class="fw-bold form-label">الهاتف</label>
                            <input type="text" name="phone" id="" maxlength="12" value="{{$employee->phone}}" class="form-control fw-bold">
                            @error('phone')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="" class="fw-bold form-label">عنوان السكن</label>
                            <input type="text" name="address" id="" maxlength="20" value="{{$employee->address}}" class="form-control fw-bold">
                            @error('address')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                    </div>

            
            <div class="row mb-2">
                <div class="col-md-6">
                    <label for="" class="fw-bold form-label">إسم الفرع</label>
                    <select name="branch" id="" class="form-select">
                    @foreach ($branchs as $item)
                    <option value="{{$item->id}}" @checked(true)>{{$item->name }}</option>
                    @endforeach
                </select>
                @error('branch')
                    <p class="text-danger">{{$message}}</p>
                @enderror
                </div>

                <div class="col-md-6">

                    <label for="" class="fw-bold form-label">القسم</label>
                <select name="department" id="" class="form-select" required>
                    @foreach ($departments as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
                @error('department')
                    <p class="text-danger">{{$message}}</p>
                @enderror

            </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <label for="" class="fw-bold form-label">الصورة الشخصية</label>
                            <input type="file" name="image" id="" class="form-control fw-bold">
                        @error('image')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                        </div>

                        <div class="col-md-6">
                            <img src="/storage/profile/{{$employee->image}}" alt="" class="card-img-top w-50 h-25">
                        </div>
                            
                        <x-confirm-modal />
                        <button type="button" data-bs-toggle="modal" data-bs-target="#confirm" class="btn btn-primary fs-5">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    @endsection