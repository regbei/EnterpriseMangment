@extends('layouts.app')
@section('content')

<div class="container justify-content-center" dir="rtl">
        @if(session()->has('message'))  
                <div class='alert fs-5 text-center alert-success'>
                    <p class='fw-bold'>{{session('message')}}</p>
                </div>
        @endif

        <div class="row mb-2">
            <div class="col-5 mx-auto">


                <div class="card" dir="rtl">
                    <div class="card-header"><h2>إضافة قسم جديد</h2></div>
            <div class="card-body">
                <form action="/DPT/store" method="post">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="" class="fw-bold form-label">تعيين مدير</label>
                            <select name="manager_id" class="form-select">
                                @forelse (\App\Models\Employee::get() as $item)
                                <option value="{{$item->id}}">{{$item->firstName." ".$item->sureName." ".$item->thirdName." ".$item->lastName}}</option>
                                
                                @empty
                                <option value="">لايوجد موظفين في الوقت الحالي</option>
                                @endforelse
                                
                            </select>
                            @error('manager_id')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        
                    </div>
                    
                        <div class="row mb-3">
                            <div class="col-md-12">
                            <label for="" class="fw-bold form-label">إسم القسم</label>
                            <input type="text" name="name" id="" maxlength="20" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror" required>
                            @error('name')
                            <span class="invalid-feedback">
                                {{$message}}
                            </span>
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

</div>


@endsection