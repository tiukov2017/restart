
<div class="container">
    <div class="row">
        <form  class="col-xs-6 col-xs-offset-3 sortable" id="google-form" role="form" method="post"
               data-api-check-action="{{route('results')}}" data-api-clear="{{route('clear')}}" autocomplete="off">
            {{-- Report Queries that can be editable --}}
            @foreach($reportQueries as $reportQuery)
                <div class="form-group">
                    <div class="row">
                        <input type="text" name="{{ $reportQuery->getId() }}" class="form-control query-input"
                               data-query-id="{{ $reportQuery->getId() }}" value="{{ $reportQuery->getName() }}" style="text-align: center;">
                    </div>

                    <span class="glyphicon glyphicon-minus-sign removeButton"></span>
                    <span class="glyphicon glyphicon-trash deleteButton"></span>
                </div>
            @endforeach

            {{-- Report Queries that came from the user profile --}}
            @foreach($paramsArr as $key=>$param)
                  <div class="form-group" data-template="{{$key}}" data-toggle="tooltip" title="{{trim($templates[$key])}}">
                      @include('fields.google_check_field',['id'=>$ids,'params'=>$param,'name'=>$key])
                      <span class="glyphicon glyphicon-minus-sign removeButton"></span>
                      <span class="glyphicon glyphicon-duplicate duplicateButton"></span>
                  </div>
            @endforeach

            <input type="hidden" name="queriesArr" id="queriesArr" value=""/>
            <input type="hidden" name="currentQueryIndex" id="currentQuery" value="0"/>
            <input type="hidden" name="reportId" id="reportId" value=""/>

            @include('fields.add_new_button')
            @include(('fields.google_search_button'))
        </form>
    </div>
    </div>
@include('modal_popup',['id'=>"results-popup",'text'=>"תוצאות",'contentid' =>'results-popup-content','acceptAction'=>'accept-btn','cancelAction' => 'cancel-btn'])
@include('modal_popup',['id'=>"redirect-popup",'text'=>"שגיאה",'contentid' =>'redirect-popup-content','acceptAction'=>'redirect-btn','cancelAction' => 'cancel-redirect-btn'])


