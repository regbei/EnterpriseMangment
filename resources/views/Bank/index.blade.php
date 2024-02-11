@extends('layouts.app')
@section('content')
    <div class="container-fluid ">
        <div class="col-md-10 col-lg-11 mx-auto" dir="rtl">

            <div class="card shadow-lg">
                <div class="card-header d-flex">
                    <h3 class="fw-bold ms-5" style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">حسابات البنوك</h3>
                    <a href="/Bank/create" class="btn btn-primary btn-md me-auto fw-bold ">إضافة</a>
                </div>
                <div class="card-body overflow-auto">
                    <table class="table table-responsive table-hover table-bordered table-striped fw-bold transactions-table" style="font-size: 17px;">
                        <thead class="table-dark">
                            <tr>    
                                <th>رقم الحساب</th>
                                <th>إسم المالك</th>
                                <th>رقم الهاتف</th>
                                <th>البريد الإلكتروني</th>
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
           ajax: "{{ route('Bank-info') }}",
           columns: [
               {data: 'acc_number', name: 'acc_number'},
               {data: 'owner_Name', name: 'owner_Name'},
               {data: 'phone', name: 'phone'},
               {data: 'email', name: 'email'},
               {data: 'action', name: 'action', orderable: false, searchable: false},
           ]
       });
     });
       </script>
@endsection