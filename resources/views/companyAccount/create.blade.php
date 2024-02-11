
@extends('layouts.app')
@section('content')

<div class="container justify-content-center">
        @if(session()->has('message'))  
                <div class='alert alert-success text-center fs-5'>
                    <p class='fw-bold'>{{session('message')}}</p>
                </div>
        @endif
        <div class="col-md-6 col-lg-8 mx-auto  fw-bold fs-5 col-sm-12">

            <div class="card" dir="rtl">
                <div class="card-header"><h2>إنشاء حساب داخلي</h2></div>
                <div class="card-body">
                <form action="/Account/store" method="post">
                    @csrf
                    <div class="row mb-2">
                        <div class="col-md-6 mb-4">
                            <label for="" class="fw-bold form-label">المدير المالي</label>
                            <select name="manager_id"  class="form-select" id="" required>
                              @forelse ($employees as $item)
                              <option value="{{$item->id}}">{{$item->firstName ." ".$item->sureName." ".$item->thirdName." ".$item->lastName}}</option>
                                  
                              @empty
                                  <option value="">لايوجد موظفين في الوقت الحالي</option>
                              @endforelse
                            </select>
                            @error('manager_id')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>


                        <div class="col-md-6">
                            <label for="" class="fw-bold form-label">عنوان الحساب</label>
                            <input type="text" name="name" maxlength="30" id="" class="form-control" required>
                            @error('name')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                    </div>

                    <div class="row mb-2">

                        <div class="col-md-6">
                            <label for="" class="fw-bold form-label">رقم الحساب</label>
                            <input type="number" name="acc_number" maxlength="12" id="" class="form-control" required>
                            @error('acc_number')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="" class="fw-bold form-label">الرصيد الحالي</label>
                            <input type="number" name="balance" maxlength="12" id="" class="form-control" required>
                            @error('balance')
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