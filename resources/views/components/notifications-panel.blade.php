{{-- @props(['id']) --}}
<div class="modal fade " id="notification-panel" data-bs-backdrop="false" data-bs-focus="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" dir="rtl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title fw-bold text-center" style="width: 100%"> الإشعارات ({{auth()->user()->UnreadNotifications->count()}})</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">


          <div class="list-group list-group-flush">
            @forelse (auth()->user()->UnreadNotifications as $item)
                
            <a href="#" class="list-group-item list-group-item-action d-flex gap-1 py-2" aria-current="true">
              <i width="32" height="32" class="fas fa-bell rounded-circle flex-shrink-0"></i>
              <div class="d-flex gap-2 w-100 justify-content-between">
                <div>
                  <p class="mb-0 fw-bold" style="font-size: 17px">{{$item->data['title']}}</p>
                  <p class="mb-0 opacity-75" style="font-size: 14px">{{$item->data['detail']}} Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa, ut deserunt. Necessitatibus, excepturi adipisci! Voluptate provident veritatis dolorum? Porro, maxime.</p>
                </div>
              </div>
              <small class="opacity-50 text-nowrap" style="font-size: 10px">{{$item->created_at}}</small>
            </a>
            @empty
                
            @endforelse

          </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
        </div>
      </div>
    </div>
  </div>