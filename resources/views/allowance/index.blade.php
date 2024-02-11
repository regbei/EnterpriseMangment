@extends('layouts.app')
@section('content')
    <div class="container-fluid " dir="rtl">
        <div class="col-md-10 col-lg-11 mx-auto">

            <div class="card shadow-lg">
                <div class="card-header d-flex">
                    <h3 class="fw-bold text-end" style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">تقرير البدلات و الحوافز</h3>
                    <a href="/Allowance/create" class="btn btn-primary me-auto fw-bold fs-5">إضافة</a>
                </div>
                <div class="card-body overflow-auto">
                    <table class="table table-responsive table-hover table-bordered table-striped allowance-table fw-bold" style="font-size: 17px;">
                        <thead class="table-dark">
                            <tr>
                                <th>الرقم</th>
                                <th>إسم الموظف</th>
                                <th>المبلغ</th>
                                <th>النوع</th>
                                <th>تاريخ السريان</th>
                                <th>تاريخ الإنتهاء</th>
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
       var table = $('.allowance-table').DataTable({
           processing: true,
           serverSide: true,
           ajax: "{{ route('Allowance-info') }}",
           columns: [
               {data: 'id', name: 'id'},
               {data: 'full_name', name: 'full_name'},
               {data: 'amount', name: 'amount'},
               {data: 'type', name: 'type'},
               {data: 'effectiveDate', name: 'effectiveDate'},
               {data: 'endDate', name: 'endDate'},
               {data: 'action', name: 'action', orderable: false, searchable: false},
           ]
       });
     });
       </script>
@endsection