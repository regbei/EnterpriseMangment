@extends('layouts.app')
@section('content')
    <div class="container-fluid" dir="rtl">
        <div class="col-md-10 col-lg-11 mx-auto">

            <div class="card shadow-lg">
                <div class="card-header d-flex">
                    <h3 class="fw-bold text-end" style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">مستخدمين النظام</h3>
                    <a href="/register" class="btn btn-primary btn-md me-auto fw-bold ">إضافة</a>
                </div>
                <div class="card-body overflow-auto">
                    <table class="table table-responsive table-bordered user-table fw-bold" style="font-size: 17px;">
                        <thead class="table-dark">
                            <tr>
                                <th>رقم التعريف</th>
                                <th>إسم المستخدم</th>
                                <th>عنوان البريد</th>
                                <th>الدور</th>
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
    var table = $('.user-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: "{{ route('User-info') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'role', name: 'role'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
  });
    </script>
@endsection