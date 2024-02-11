@extends('layouts.app')
@section('content')
    <div class="container-fluid " dir="rtl">
        <div class="col-md-12 col-lg-12 mx-auto">

            <div class="card shadow-lg">
                <div class="card-header d-flex">
                    <h3 class="fw-bold ms-5" style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">تقرير الموظفين</h3>
                    <a href="/Employee/create" target="__blank" class="btn btn-primary btn-md me-auto fw-bold fs-5 ">إضافة</a>
                </div>
                <div class="card-body overflow-auto">
                    <table class="table table-responsive table-hover table-bordered table-striped emp-table fw-bold" style="font-size: 15px;">
                        <thead class="table-dark">
                            <tr>
                                <th>الرقم</th>
                                <th>الإسم</th>
                                <th>البريد</th>
                                <th>الهاتف</th>
                                <th>التعيين</th>
                                <th>تاريخ الميلاد</th>
                                <th>الجنس</th>
                                <th>المنصب</th>
                                <th>القسم</th>
                                <th width="10px"></th>
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
    var table = $('.emp-table').DataTable({
        processing: true,
        serverSide: false,
        responsive: true,
        ajax: "{{ route('employee-info') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'full_name', name: 'full_name'},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
            {data: 'hiredAt', name: 'hiredAt'},
            {data: 'birthDate', name: 'birthDate'},
            {data: 'gender', name: 'gender'},
            {data: 'position', name: 'position'},
            {data: 'department', name: 'department'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
  });
    </script>
@endsection