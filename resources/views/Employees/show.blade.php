@extends('layouts.app')
@section('content')

<div class="container-fluid" dir="rtl" style="font-size: 18px;">
    <div class="row mb-3">
        <div class="col-md-12 col-sm-12  mb-sm-3 col-lg-4">
            <div class="card w-100">
                <img src="/storage/profile/{{$employees->image}}" alt="" class="card-img-top w-100 h-100">
                <div class="card-body d-print-none">
          
                        <li class="list-group-item text-end fw-bold fs-">الإسم :  {{$employees->firstName .' '.$employees->sureName.' '.$employees->thirdName}}</li>
                        <li class="list-group-item text-end fw-bold fs-"> العمر :  {{$Age . ' عام'}}</li>
                   
                </div>
            </div>
        </div>
        
        <div class="col-md-12 col-sm-12 mb-sm-3 me-auto col-lg-4">
            <ul class="list-group fw-bold">
                <li class="list-group-item list-group-item-action d-flex"> رقم الموظف : {{$employees->id}} <i class="fas fa-id-card me-auto"></i></li> 
                <li class="list-group-item list-group-item-action d-flex"> الإسم كامل : {{$employees->firstName .' '.$employees->sureName .' '.$employees->thirdName .' '.$employees->lastName}} <i class="fas fa-id-badge me-auto"></i></li> 
               <li class="list-group-item list-group-item-action d-flex">  النوع : {{$employees->gender}} <i class="fas fa-person-half-dress me-auto"></i></li> 
               <li class="list-group-item list-group-item-action d-flex">  الديانة : {{$employees->religion}} <i class="fas fa-mosque me-auto"></i></li> 
               <li class="list-group-item list-group-item-action d-flex">  الهاتف : <a href="tel:+{{$employees->phone}}" class="text-dark text-decoration-none">{{$employees->phone}}</a> <i class="fas fa-phone me-auto"></i></li> 
               <li class="list-group-item list-group-item-action d-flex">  البريد : <a href="mailto:{{$employees->email}}" class="text-dark text-decoration-none">{{$employees->email}}</a> <i class="fas text-warning fa-message me-auto"></i></li> 
               <li class="list-group-item list-group-item-action d-flex">  العنوان : {{$employees->address}} <i class="fas fa-map-location text-primary me-auto"></i></li> 
               <li class="list-group-item list-group-item-action d-flex">  الحالة الإجتماعية : {{$employees->marital_status}} <i class="fas fa-person text-primary me-auto"></i></li> 
               <li class="list-group-item list-group-item-action d-flex">  تاريخ الميلاد : {{$employees->birthDate}} <i class="fas fa-cake-candles me-auto" style="color: rgb(255, 164, 179)"></i></li> 
               <li class="list-group-item list-group-item-action d-flex">  تاريخ التعيين : {{$employees->hiredAt}} <i class="fas fa-calendar-check me-auto"></i></li> 
               <li class="list-group-item list-group-item-action d-flex">  العمر : {{$Age . ' عام'}} <i class="fas fa-check me-auto"></i></li> 
            </ul>
        </div>
        
        
    <div class="col-md-12 col-sm-12 mb-sm-3 col-lg-4">
        <ul class="list-group fw-bold">
        <li class="list-group-item list-group-item-action d-flex">  المؤهل الدراسي : {{$employees->qualifications}} <i class="fas me-auto fa-user-graduate"></i></li> 
        <li class="list-group-item list-group-item-action d-flex">  المنصب : {{$employees->position}} <i class="fas me-auto fa-user-tie text-primary"></i></li> 
        <li class="list-group-item list-group-item-action d-flex">  القسم : {{$employees->department->name}} <i class="fas me-auto fa-building-user"></i></li> 
        <li class="list-group-item list-group-item-action d-flex">  الفرع : {{$employees->branch->name}} <i class="fas me-auto fa-building-columns"></i></li> 
        <li class="list-group-item list-group-item-action d-flex">   الراتب الأساسي : {{number_format(optional($employees->payroll)->salary ?? '100'). '$';}} <i class="fas fa-sack-dollar text-success me-auto"></i></li> 
        <li class="list-group-item list-group-item-action d-flex">  تاريخ السريان : {{optional($employees->payroll)->effectiveDate ?? 'غير متاح'}} <i class="fas fa-calendar-check me-auto"></i></li> 
        <li class="list-group-item list-group-item-action d-flex">  تاريخ الإنتهاء : {{optional($employees->payroll)->endDate ?? 'غير متاح'}} <i class="fas fa-calendar-xmark me-auto"></i></li> 
        <li class="list-group-item list-group-item-action d-flex">  الراتب السنوي : {{number_format(optional($employees->payroll)->salary * 12 ) . ' $';}} <i class="fas fa-hand-holding-dollar text-success me-auto"></i></li> 
        <li class="list-group-item list-group-item-action d-flex">  صافي المرتب : {{number_format(optional($employees->payroll)->salary  + optional($employees->allowances)->sum('amount') - 
        optional($employees->deductions)->sum('amount')). ' $';}} <i class="fas fa-comments-dollar text-success me-auto"></i></li> 
        <li class="list-group-item list-group-item-action d-flex">  فترة الخدمة : {{$atService . ' عام'}} <i class="fas fa-timeline me-auto"></i></li> 
        </ul>
    </div>


    </div>
    
    <div class="row d-print-none gap-xx-sm-4 d-lg-flex d-none mt-4">
        <div class="col-md-4 col-sm-3 col-lg-6">
            <h4 class="fw-bold">الإستقطاعات</h4>
            <form action="/Deduction/delete" method="post">
                @csrf
                @method('delete')
                <table class="table table-responsive fw-bold table-bordered table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                        <th>حذف</th>
                        <th>الرقم</th>
                        <th>المبلغ</th>
                        <th>النوع</th>
                        <th>تاريخ السريان</th>
                        <th>تاريخ الإنتهاء</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees->deductions as $item)
                    <tr>
                        <td><input type="checkbox" name="ids[{{$item->id}}]" value="{{$item->id}}" id=""></td>
                        <td>{{$item->id}}</td>
                        <td>{{number_format($item->amount);}}<i class="fas fa-dollar-sign"></i></td>
                        <td>{{$item->deductionTypes[0]->name}}</td>
                        <td>{{$item->effectiveDate}}</td>
                        <td>{{$item->endDate}}</td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
            <button type="submit" class="btn btn-danger btn-sm fw-bold">حذف <i class="fas fa-trash-can"></i></button>
        </form>
        
        </div>


        
        <div class="col-md-4 col-sm-3 col-lg-6">
            <h4 class="fw-bold">الحوافز</h4>
            <form action="/Allowance/delete" method="post">
                @csrf
                @method('delete')
            <table class="table table-responsive fw-bold table-bordered table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>حذف</th>
                        <th>الرقم</th>
                        <th>المبلغ</th>
                        <th>النوع</th>
                        <th>تاريخ السريان</th>
                        <th>تاريخ الإنتهاء</th>
                    </tr>
                </thead>
        
                <tbody>
                    @foreach ($employees->allowances as $item)
                            <tr>
                        <td><input type="checkbox" name="ids[{{$item->id}}]" value="{{$item->id}}" id=""></td>
                                <td>{{$item->id}}</td>
                                <td>{{number_format($item->amount)}} <i class="fas fa-dollar-sign"></i></td>
                                <td>{{$item->allowanceTypes[0]->name}}</td>
                                <td>{{$item->effectiveDate}}</td>
                                <td>{{$item->endDate}}</td>
                            </tr>
                    @endforeach
                    
                </tbody>
        
            </table>
        
            <button type="submit" class="btn btn-danger btn-sm fw-bold">حذف <i class="fas fa-trash-can"></i></button>
            
        </form>
        </div>


    </div>
</div>


{{-- <div class="container bg-primary d-print-none"> --}}
    <div class="row w-50 d-print-none">
        <div class="col-1 m-3">

            <div class="d-inline-flex gap-1">
                <form action="/Employee/{{$employees->id}}/delete" method="post">
                    @csrf
                @method('delete')
                <x-confirm-delete />
            </form>
            <div class="dropup">
                <a class="text-primary" style="font-size: 22px;" title="profile settings" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown">
                    <i class="fas fa-gears"></i>
                  </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item d-flex gap-2 align-items-center" href="/Employee/{{$employees->id}}/edit"><i class="fas fa-pencil"></i>Edit</a></li>
                    <li><a class="dropdown-item d-flex gap-2 align-items-center" data-bs-toggle="modal" href="#confirm"><i class="text-danger fas fa-trash"></i>Delete</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

{{-- </div> --}}
<script>
    $(document).ready(function(){
        $('table').DataTable();
    });
</script>
@endsection