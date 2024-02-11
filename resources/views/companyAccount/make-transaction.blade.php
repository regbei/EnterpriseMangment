
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

        <div class="card shadow" dir="rtl">
            <div class="card-header"><h2>معاملة مالية</h2></div>
            <div class="card-body">
                <form action="/Account/transaction/store" method="post">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="" class="fw-bold form-label fs-5">المرسل</label>
                            <select name="company_account" class="form-select">
                                @forelse (\App\Models\CompanyAccount::get() as $item)
                                <option value="{{$item->acc_number}}">{{$item->name}}</option>
                                
                                @empty
                                    <option value="">لايوجد</option>
                                @endforelse
                                
                            </select>
                            @error('company_account')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        
                        
                        <div class="col-md-6">
                            <label for="" class="fw-bold form-label fs-5">المستلم</label>
                            <select name="bank_account" class="form-select">
                                @forelse (\App\Models\AccountInfo::get() as $item)
                                <option value="{{$item->acc_number}}">{{$item->owner_Name}}</option>
                                
                                @empty
                                    <option value="">لايوجد</option>
                                @endforelse
                                
                            </select>
                            @error('bank_account')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        </div>

                        
                        <div class="row mb-3">

                            <div class="col-md-6">
                                <label for="" class="fw-bold form-label fs-5">البنك</label>
                                <select name="bank" class="form-select">
                                    @forelse (\App\Models\Bank::get() as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @empty
                                        <option value="">لايوجد</option>
                                    @endforelse
                                    </select>
                                    
                                @error('bank')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="" class="fw-bold form-label fs-5">المبلغ</label>
                                <input type="number" name="amount" id="" value="{{old('amount')}}" class="form-control" required>
                                @error('amount')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                            </div>

                        </div>


                    <div class="row mb-3">
                    
                            <div class="col-md-12">
                            <label for="" class="fw-bold form-label fs-5">عنوان الحوالة</label>
                            <input type="text" name="title" maxlength="20" id="" value="{{old('title')}}" class="form-control" required>
                            @error('title')
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

    
    @endsection