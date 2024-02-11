@extends('layouts.app')
@section('content')
    <div class="container-fluid" dir="rtl">
        <div class="col-md-10 col-lg-11 mx-auto">

            <div class="card shadow-lg">
                <div class="card-header d-flex">
                    <h3 class="fw-bold text-end" style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">تقرير الرواتب</h3>
                    <a href="/Payroll/create" class="btn btn-primary btn-md me-auto fw-bold ">إضافة</a>
                </div>
                <div class="card-body overflow-auto">
                    <table class="table table-responsive table-bordered payroll-table fw-bold" style="font-size: 17px;">
                        <thead class="table-dark">
                            <tr>
                                <th>الرقم</th>
                                <th>الإسم</th>
                                <th>الراتب</th>
                                <th>تاريخ السريان</th>
                                <th>تاريخ الإنتهاء</th>
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
    var table = $('.payroll-table').DataTable({
        processing: true,
        serverSide: false,
        responsive: true,
        ajax: "{{ route('Payroll-info') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'full_name', name: 'full_name'},
            {data: 'salary', name: 'salary'},
            {data: 'effectiveDate', name: 'effectiveDate'},
            {data: 'endDate', name: 'endDate'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
  });
    </script>
@endsection