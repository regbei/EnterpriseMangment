
@extends('layouts.app')

@section('content')

<div class="container justify-content-center" dir="rtl">
                @if (session()->has('message'))    
                <div class="alert alert-success active text-end fs-5 d-flex">
                    <p class='fw-bold'>{{session('message')}}</p>
                    <i class="fas fa-file-circle-check me-auto fs-4"></i>
                </div>
                @endif        

        <div class="card shadow">
            <div class="card-header"><h2>تسجيل موظف</h2></div>
            <div class="card-body">
                <form action="/Employee/store" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <label for="" class="fw-bold form-label">رقم التعريف</label>
                            <input type="number" name="id" maxlength="17" id="" value="{{old('id')}}" class="form-control @error('id') is-invalid @enderror">
                            @error('id')
                            <span class="invalid-feedback">
                                <strong class="text-danger">{{$message}}</strong>
                            </span>
                            @enderror
                        </div>

                        
                        
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-3">
                            <label for="" class="fw-bold form-label"> الإسم الأول</label>
                            <input type="text" name="firstName" maxlength="10"  value="{{old('firstName')}}" id="" class="form-control @error('firstName') is-invalid @enderror" required>
                            @error('firstName')
                            <span class="invalid-feedback">
                                <strong class="text-danger">{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                        
                        <div class="col-md-3">
                            <label for="" class="fw-bold form-label"> الإسم الثاني</label>
                            <input type="text" name="sureName" maxlength="10"  value="{{old('sureName')}}" id="" class="form-control @error('sureName') is-invalid @enderror" required>
                            @error('sureName')
                            <span class="invalid-feedback">
                                <strong class="text-danger">{{$message}}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="" class="fw-bold form-label">الإسم الثالث</label>
                            <input type="text" name="thirdName" maxlength="10"  value="{{old('thirdName')}}" id="" class="form-control @error('thirdName') is-invalid @enderror" required>
                            @error('thirdName')
                            <span class="invalid-feedback">
                                <strong class="text-danger">{{$message}}</strong>
                            </span>
                            @enderror
                        </div>


                        
                        <div class="col-md-3">
                            <label for="" class="fw-bold form-label">الإسم الرابع</label>
                            <input type="text" name="lastName" maxlength="10"  value="{{old('lastName')}}" id="" class="form-control @error('lastName') is-invalid @enderror">
                            @error('lastName')
                            <span class="invalid-feedback">
                                <strong class="text-danger">{{$message}}</strong>
                            </span>
                            @enderror
                        </div>


                    </div>

                    <div class="row mb-2">

                        <div class="col-md-6">
                            <label for="" class="fw-bold form-label">تاريخ الميلاد</label>
                            <input type="date" name="birthDate" id=""  value="{{old('birthDate')}}" class="text-center form-control" required>
                            @error('birthDate')
                            <span class="invalid-feedback">
                                <strong class="text-danger">{{$message}}</strong>
                            </span>
                            @enderror
                        </div>


                        
                        <div class="col-md-6">
                            <label for="" class="fw-bold form-label">تاريخ التعيين</label>
                            <input type="date" name="hiredAt" id="" value="{{old('hiredAt')}}" class="text-center form-control @error('religion') is-invalid @enderror" required>
                            @error('hiredAt')
                            <span class="invalid-feedback">
                                <strong class="text-danger">{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                    <div class="row mb-2">
                                
                            <div class="col-md-6">
                                <label for="" class="fw-bold form-label">الديانة</label>
                                <select name="religion"  class="form-select @error('religion') is-invalid @enderror" required>
                                    <option value="مسلم">مسلم</option>
                                    <option value="مسيحي">مسيحي</option>
                                </select>
                                @error('religion')     
                                <span class="invalid-feedback">
                                    <strong class="text-danger">{{$message}}</strong>
                                </span>
                                @enderror
                            </div>

                        
                            <div class="col-md-6">
                                <label for="" class="fw-bold form-label">عنوان البريد</label>
                                <input type="text" name="email" id="" maxlength="30" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror" required>
                                @error('email')
                                <span class="invalid-feedback">
                                    <strong class="text-danger">{{$message}}</strong>
                                </span>
                                @enderror
                            </div>

                    </div>

                    <div class="row mb-2">
                        <div class="col-md-6">
                            <label for="" class="form-label fw-bold">المؤهل الدراسي</label>
                            <input type="text" maxlength="40" name="qualifications" value="{{old('qualifications')}}" id="" class="form-control @error('qualifications') is-invalid @enderror" required>
                            @error('qualifications')
                          
                            <span class="invalid-feedback">
                                <strong class="text-danger">{{$message}}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            
                            <label for="" class="form-label fw-bold">المنصب</label>
                            <select name="position" id="" class="form-select" required>
                                <option value="مهندس">مهندس</option>
                                <option value="محاسب"@selected(true)>محاسب</option>
                                <option value="إداري">مدير</option>
                                <option value="موارد بشرية">موارد بشرية</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-2">
                        
                        <div class="col-md-6">
                            <label for="" class="fw-bold form-label">الهاتف</label>
                            <input type="text" name="phone" id="" maxlength="13" value="{{old('phone')}}" class="form-control @error('address') is-invalid @enderror" required>
                            @error('phone')
                            <span class="invalid-feedback">
                                <strong class="text-danger">{{$message}}</strong>
                            </span>
                            @enderror

                        </div>

                        <div class="col-md-6">
                           
                            <label for="" class="fw-bold form-label">عنوان السكن</label>
                            <input type="text" name="address" id="" maxlength="30" value="{{old('address')}}" class="form-control @error('address') is-invalid @enderror" required>
                            @error('address')
                            <span class="invalid-feedback">
                                <strong class="text-danger">{{$message}}</strong>
                            </span>
                            @enderror
                       
                        </div>

                    </div>

            
            <div class="row mb-2">

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

                            <div class="col-md-6">

                                <label for="" class="fw-bold form-label">الفرع</label>
                                <select name="branch" id="" class="form-select" required>
                                    @foreach ($branches as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                                @error('branch')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror

                            </div>
            </div>
                    <div class="row mb-2">

                        <div class="col-md-6">
                            <label for="" class="fw-bold form-label">الصورة الشخصية</label>
                            <input type="file" name="image" id="" class="form-control" required>
                        @error('image')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="" class="fw-bold form-label">الحالةالإجتماعية</label>
                            <select name="marital_status" id=""  class="form-control fw-bold" required>
                                <option value="متزوج">متزوج</option>
                                <option value="أعزب">أعزب</option>
                                <option value="مطلق">مطلق</option>
                                <option value="أرمل">أرمل</option>
                            </select>
                        @error('marital_status')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                        </div>

                    </div>
                    <div class="row mb-2">
                        <div class="col-md-2">

                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="ذكر" name="gender" id="gender1" @checked(true)>
                                <label class="form-check-label fw-bold" for="gender1">ذكر</label>
                            </div>
                            
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="أنثى" name="gender" id="gender1">
                                <label class="form-check-label fw-bold" for="gender">أنثى</label>
                            </div>
                            
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <button type="button" data-bs-target="#confirm" data-bs-toggle="modal" class="btn btn-primary fs-5">حفظ</button>
                            <x-confirm-modal />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    @endsection