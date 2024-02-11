@extends('layouts.app')
@section('content')
    <div class="container-fluid ">
        <div class="col-md-10 col-lg-11 mx-auto" dir="rtl">

            <div class="card shadow-lg">
                <div class="card-header d-flex">
                    <h3 class="fw-bold ms-5" style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">تقرير المعاملات البنكية</h3>
                    <a href="/Bank/transaction" class="btn btn-primary btn-md me-auto fw-bold ">إضافة</a>
                </div>
                <div class="card-body overflow-auto">
                    <table class="table table-responsive table-hover table-bordered table-striped fw-bold transactions-table" style="font-size: 17px;">
                        <thead class="table-dark">
                            <tr>    
                                <th>رقم المعاملة</th>
                                <th>رقم الحساب المرسل</th>
                                <th>رقم الحساب المستلم</th>
                                <th>العنوان</th>
                                <th>المبلغ</th>
                                <th>المصرف</th>
                                <th>التاريخ والوقت</th>
                                <th></th>
                        </thead>
                        <tbody class="text-start"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
       var table = $('.transactions-table').DataTable({
           processing: true,
           serverSide: true,
           responsive: true,
           ajax: "{{ route('Account-reports') }}",
           columns: [
               {data: 'id', name: 'id'},
               {data: 'account_info_acc_number', name: 'account_info_acc_number'},
               {data: 'company_account_acc_number', name: 'company_account_acc_number'},
               {data: 'title', name: 'title'},
               {data: 'amount', name: 'amount'},
               {data: 'bank', name: 'bank'},
                {data: 'dateTime', name: 'dateTime'},
               {data: 'action', name: 'action', orderable: false, searchable: false},
           ]
       });
     });
       </script>
@endsection