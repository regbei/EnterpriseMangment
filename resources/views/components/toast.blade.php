@forelse (auth()->user()->UnreadNotifications as $item)
    
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header d-flex">
        <i class="align-items-center fas fa-bell rounded me-2"></i>
        <strong class="me-auto align-items-center">{{$item->data['title']}}</strong>
        <small>{{$item->created_at}}</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        {{$item->data['detail']}}
        {{$item->data['name'] ?? ' '}}
    </div>
</div>
</div>
@empty
    
@endforelse