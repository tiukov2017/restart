<div class="row header">
    <div class="col-xs-4">
        <input id="reportId" type="hidden" value="{{ $reportId }}"/>
        <input class="query-input form-control" data-query-id="{{ $queryId }}" type="text" value="{{ $query }}"/>
    </div>
        <span class="col-xs-1">
            <i id="save-query" data-query="{{$query}}"
               data-query-id="{{ $queryId }}" class="fa fa fa-floppy-o">
            </i>
            </span>
    <div class="col-xs-6">
        @if($isPreview && count($results) != 0)
            <button class="btn btn-primary" id="filtered-results-table">{{trans('google.view_pages')}}</button>
            <button class="btn btn-primary" id="view-results">{{trans('google.view')}}</button>
        @endif
        <button class="btn btn-primary" id="new-search">{{trans('google.new_search')}}</button>
        <button class="btn btn-primary" id="next-query-preview">{{trans('google.next_query')}}</button>
    </div>
</div>