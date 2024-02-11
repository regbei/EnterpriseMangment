@php
    
    // $mix = array_merge([$company->payrollTransactions], [$company->allowanceTransactions], [$company->deductionTransactions]);
@endphp
@extends('layouts.app')
@section('content')
    <div class="container-fluid mt-3" dir="rtl" style="font-size: 19px;">
        
        <div class="row mb-2">
            <div class="col-md-5 col-lg-4 mx-auto">
                <div class="card fw-bold">
                    <div class="card-header d-flex"><h3 class="fw-bold">{{$DPT->name}}</h3></div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush list-group-action text-dark">
                            <li class="list-group-item">رقم القسم : {{$DPT->id}}</li>
                            <li class="list-group-item">مدير القسم : <a href="/Employee/single/{{$DPT->DepartmentManager->id}}" class="text-decoration-none text-dark">
                            {{$DPT->departmentManager->firstName 
                            .' '.$DPT->departmentManager->sureName
                            .' '.$DPT->departmentManager->thirdName
                            .' '.$DPT->departmentManager->lastName}}</a></li>
                            <li class="list-group-item">تاريخ التأسيس : {{date_format($DPT->created_at, 'd-m-Y')}}</li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="col-md-6 col-lg-6 mx-auto">
                
            <div class="card shadow-lg">
                <div class="card-header d-flex">
                    <h3 class="fw-bold text-end">موظفين القسم</h3>
                </div>
                <div class="card-body overflow-auto">
                    <table class="table table-responsive table-bordered employees-table fw-bold" style="font-size: 17px;">
                        <thead class="table-dark">
                            <tr>
                                <th>رقم الموظف</th>
                                <th>إسم الموظف</th>
                                {{-- <th></th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($DPT->employees as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->firstName.' '.$item->suretName.' '.$item->thirdName.' '.$item->lastName}}</td>
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
    $('.employees-table').DataTable();
});
   </script>
@endsection