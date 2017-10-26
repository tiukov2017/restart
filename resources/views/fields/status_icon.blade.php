
<div class="dropdown block-icons">

    <div class="status-box dropdown-toggle view-mode-invisible block-icon-item" id="status-box-{{$id}}" data-toggle="dropdown">
        <img src="{{asset('assets/images/status_icons/no-status.png')}}" class="img-responsive"/>
    </div>
    <div class="remind-field view-mode-invisible block-icon-item" data-remind-field="{{$id}}"><i class="fa fa-clock-o fa-lg" aria-hidden="true"></i></div>
    <ul class="dropdown-menu" data-target="#status-box-{{$id}}">
        <li class="status-change" data-icon="{{asset('assets/images/status_icons/ok-status.png')}}" data-title=""><a href="#">לא אותרה בעיה כלשהי</a></li>
        <li class="status-change" data-icon="{{asset('assets/images/status_icons/search-not-found-status.png')}}"><a href="#">לא נמצאו נתונים קשורים בחיפוש</a></li>
        <li role="separator" class="divider"></li>
        <li class="status-change status-reset" data-icon="{{asset('assets/images/status_icons/no-status.png')}}"><a href="#">ללא סטאטוס</a></li>
    </ul>
</div>