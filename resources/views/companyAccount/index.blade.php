@extends('layouts.app')
@section('content')
    <div class="container-fluid" dir="rtl">
        <div class="col-md-10 col-lg-11 mx-auto">

            <div class="card shadow-lg">
                <div class="card-header d-flex">
                    <h3 class="fw-bold text-end">الحسابات الداخلية</h3>
                    <a href="/Account/create" class="btn btn-primary btn-md me-auto fw-bold ">إضافة</a>
                </div>
                <div class="card-body overflow-auto">
                    <table class="table table-responsive table-bordered account-table fw-bold" style="font-size: 17px;">
                        <thead class="table-dark">
                            <tr>
                                <th>الرقم</th>
                                <th>إسم المدير</th>
                                <th>الحساب</th>
                                <th>الرصيد</th>
                                <th>اخر حوالة</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
     $(function () {
    var table = $('.account-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('Account-info') }}",
        columns: [
            {data: 'acc_number', name: 'acc_number'},
            {data: 'full_name', name: 'full_name'},
            {data: 'name', name: 'name'},
            {data: 'balance', name: 'balance'},
            {data: 'dateTime', name: 'dateTime'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
  });
    </script>
@endsection