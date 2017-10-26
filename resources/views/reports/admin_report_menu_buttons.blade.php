<div class="floating-menu-items">

    <div class="floating-menu-item view-mode-invisible" id="saveBTN" data-target="{{route('saveReport')}}"><span>שמור</span></div>

    <div  class="view-mode-invisible floating-menu-item" id="publish_popup_btn" data-target="{{route('publishReport')}}"><span>פרסם דו״ח</span></div>

    <div  class="view-mode-invisible floating-menu-item" id="shareBTN" data-share-url="{{$shareUrl}}"><span><p>שתף</p><p>דו״ח</p></span></div>

    <div  class="floating-menu-item view-mode-invisible hidden-if-not-published" id="previewBTN">
        <a href="{{$shareUrl}}" target="_blank"><span>תצוגה מקדימה</span></a>
    </div>

    <div  class="floating-menu-item view-mode-invisible missing-fields-alert">
        <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
    </div>
    <div  class="floating-menu-item view-mode-invisible">
        <i class="fa fa-camera general-screenshot" aria-hidden="true"></i>
    </div>
    <div  class="floating-menu-item view-mode-invisible" id="double-check-button">
        <span>בדוק הצלבות</span>
    </div>
</div>