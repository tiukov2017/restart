
@extends('layouts.goolge_iframes_layout')

@section('content')

     {{--Google search data--}}
    <form id="google-form" action="{{route('search')}}" method="post">
        <input type="hidden" name="resultCount" id="resultCount" value=""/>
        <input type="hidden" name="srcArr" id="srcArr"  value=""/>
        <input type="hidden" name="reportId" id="reportId" value="{{$reportId}}"/>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
    {{--End of Google data--}}

     {{--Google Search Menu--}}
    <div class="nav-buttons">
        <div>
            <span  id="btn-prev" class="glyphicon glyphicon-chevron-left nav-button float-left"  ></span>
            <span id="btn-next" class="glyphicon glyphicon-chevron-right nav-button float-right" ></span>
            <div id="pages-indicator">
                <span id="current-page-indicator" >1</span>/<span id="total-pages-indicator"></span>
            </div>
            <div class="editor-menu">

                @include('dropdowns.bookmarks_dropdown',['id'=>'readlist','header'=>'סימניות','contentList'=>$bookmarks])

                <button class="btn-info btn middle-button"  id="next-button" data-toggle="tooltip" title="{{$queriesArr[1]}}">תוצאות שאילתא הבאה</button>

                @include('dropdowns.keywords_dropdown',['id'=>'keywords','header'=>'מילות מפתח','contentList'=>$queriesArr])

              <span class="next-query">
                  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom"
                     title="{{'שאילתא נוכחית : '.$currentQuery.' '}}" aria-hidden="true">
                  </i></span>
            </div>
        </div>
    </div>
    {{--End of Google search menu--}}

    <div id="current-url">

    </div>

        <iframe id="google-results-iframe"  name="google-results-iframe" onload="resizeIframe(this, 600)"
                sandbox="allow-scripts allow-forms allow-same-origin allow-popups allow-pointer-lock"
                src="" width="100%" height="600">
        </iframe>
    {{--End of Google Results Iframe--}}
    @include('modal_popup',['id'=>"redirect-popup",'text'=>"שגיאה",
    'contentid' =>'redirect-popup-content',
    'acceptAction'=>'redirect-btn',
    'cancelAction' => 'cancel-redirect-btn'])
@endsection
@section('scripts')
    <script src="{{ asset('js/jquery.mark.min.js') }}"></script>
    <script src="{{asset('js/keywords_search.js')}}"></script>
    <script src="{{asset('js/google_viewer_pagination.js')}}"></script>
    <script src="{{asset('js/bookmarks.js')}}"></script>
@endsection