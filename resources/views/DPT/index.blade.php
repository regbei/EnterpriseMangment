@extends('layouts.app')
@section('content')
    <div class="container-fluid " dir="rtl">
        <div class="col-md-10 col-lg-11 mx-auto">

            <div class="card shadow-lg">
                <div class="card-header d-flex">
                    <h3 class="fw-bold ms-5" style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">إدارة الأقسام</h3>
                    <a href="/DPT/create" target="" class="btn btn-primary btn-md me-auto fw-bold fs-5 ">إضافة</a>
                </div>
                <div class="card-body overflow-auto">
                    <table class="table table-responsive table-hover table-bordered table-striped DPT-table fw-bold" style="font-size: 17px;">
                        <thead class="table-dark">
                            <tr>
                                <th>الرقم</th>
                                <th>القسم</th>
                                <th>إسم المدير</th>
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
    var table = $('.DPT-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('DPT-info') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'Manager', name: 'Manager'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
  });
    </script>
@endsection