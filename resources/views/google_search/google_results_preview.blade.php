@extends('layouts.goolge_iframes_layout')

@section('content')

<div class="container-fluid">
    <div class="row header panel">
        <div class="panel-heading">
        <div class="col-xs-2">
            <input id="reportId" type="hidden" value="{{$reportId}}"/>
            <input class="query-input form-control" data-query-id="{{$queryFk}}" type="text" value="{{$query}}"/>
        </div>

               <span class="save col-xs-1">
                <i id="save-query" data-query="{{$query}}"
                   data-query-id="{{$queryFk}}" class="fa fa fa-floppy-o"></i>
               </span>

        <div class="col-xs-10">
            <button class="btn btn-primary" id="new-search">{{trans('google.new_search')}}</button>
            <button class="btn btn-primary" id="next-query-preview">{{trans('google.next_query')}}</button>
            <button class="btn btn-primary" id="filtered-results-table">{{trans('google.view_pages')}}</button>
            <button class="btn btn-primary" id="view-results">{{trans('google.view')}}</button>
        </div>

        </div>
    </div>
    @if(count($results) == 0 && $resultsCount != 0)
             {{trans('google.no_unchecked_results')}}
            <div>
                <button  class="btn btn-primary" id="next-page">{{trans('google.next_page')}}</button>
            </div>
    @elseif($resultsCount == 0)
            {{trans('google.no_results')}}
    @endif

    @if(count($results) != 0 && $resultsCount!=0 )
            <div class="row" id="switch-all">
                <div class="col-xs-1 col-xs-offset-11">
                    <label>בחר הכל </label>
                    <div class="row">
                        <span class="col-xs-6">
                            <input name="switch-all"  type="radio" data-on="true" />
                     </span>
                        <span class="col-xs-6">
                             <input name="switch-all" type="radio" data-on="false" />
                     </span>
                    </div>
                </div>
            </div>
    @endif
<div class="row">
    <div class="col-xs-1 col-xs-offset-11">

        @if(count($results) != 0 && $resultsCount!=0 )
                <div class="row">
                    <label class="col-xs-6">כן</label>
                    <label class="col-xs-6">לא</label>
                </div>
           @endif

    </div>
</div>
    @foreach($results as $result)
        <div id="{{$result->id}}" class="result row {{$result->is_checked == 1 ? 'checked-result' : ''}}">
            <div class="result-header col-xs-6">
                <h4>
                    <a data-url="{{$result->url}}" href="{{$result->url}}">{{$result->title}}</a>
                </h4>
                <a href="{{$result->url}}">{{$result->url}}</a>
            <div>
            </div>
                <div data-description="{{$result->description}}" class="result-description">
                    {{$result->description}}
                </div>
                </div>
            <div class="summary col-xs-5" data-result-id="{{$result->id}}">
              <textarea placeholder="{{trans('google.edit_user_comments')}}">{{$result->user_comments}}</textarea>
                <i data-result-id="{{$result->id}}"  class="fa fa fa-floppy-o save-summary"></i>
            </div>
            @if($result->is_checked != 1)
            <div class="switch col-xs-1" data-result-id="{{$result->id}}">
                <div class="row">
                     <span class="col-xs-6">
                    <input name="switch-{{$result->id}}"  type="radio" data-on="true" />
                        </span>
                        <span class="col-xs-6">
                     <input name="switch-{{$result->id}}" type="radio" data-on="false" />
                       </span>
                </div>
            </div>
                @endif
        </div>
    @endforeach
  <div class="row">
      {{ $results->links() }}
      @if($results->lastPage() == 1)
      <button  class="btn btn-primary" id="next-page">{{trans('google.next_page')}}</button>
      @endif
  </div>
</div>
@endsection