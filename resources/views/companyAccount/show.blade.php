@php
    
    // $mix = array_merge([$company->payrollTransactions], [$company->allowanceTransactions], [$company->deductionTransactions]);
@endphp
@extends('layouts.app')
@section('content')
    <div class="container-fluid mt-3" dir="rtl" style="font-size: 19px;">
        
        <div class="row mb-2">
            <div class="col-md-5 col-lg-4 mx-auto">
                <div class="card fw-bold">
                    <div class="card-header d-flex"><h3 class="fw-bold">{{$company->name}}</h3></div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush list-group-action text-dark">
                            <li class="list-group-item">رقم الحساب : {{$company->acc_number}}</li>
                            <li class="list-group-item">مدير الحساب : <a href="/Employee/single/{{$company->employee->id}}" class="text-decoration-none text-dark">{{$company->employee->firstName .' 
                            '.$company->employee->sureName.' '.$company->employee->thirdName.' '.$company->employee->lastName}}</a></li>
                            <li class="list-group-item">الرصيد الحالي : {{number_format($company->balance)}}</li>
                            <li class="list-group-item">أخر معاملة : {{date_format($company->updated_at, 'd-m-Y h:i:s')}}</li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="col-md-6 col-lg-6 mx-auto">
                
            <div class="card shadow-lg">
                <div class="card-header d-flex">
                    <h3 class="fw-bold text-end">سجل المعاملات</h3>
                    {{-- <a href="/Account/create" class="btn btn-primary btn-md me-auto fw-bold ">إضافة</a> --}}
                </div>
                <div class="card-body overflow-auto">
                    <table class="table table-responsive table-bordered account-table fw-bold" style="font-size: 17px;">
                        <thead class="table-dark">
                            <tr>
                                <th>رقم المعاملة</th>
                                <th>المبلغ</th>
                                <th>التاريخ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($filter as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{number_format($item->amount)}}</td>
                                    <td>{{$item->date}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</div>
<script type="text/javascript">
$(document).ready(function(){
    $('.account-table').DataTable();
});
   </script>
@endsection