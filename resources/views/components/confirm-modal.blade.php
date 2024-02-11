@props(['id'])
<div class="modal fade active" id="confirm" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title fw-bold" id="exampleModalLabel">رسالة النظام</h4>
          {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
        </div>
        <div class="modal-body">
            هل أنت متأكد من البيانات أعلاها !!
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
          <button type="submit" class="btn btn-primary">الحفظ</button>
        </div>
      </div>
    </div>
  </div>