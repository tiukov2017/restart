
@extends('layouts.table_layout')

@section('table')
    <div class="panel panel-default">
        <div class="panel-heading">
            <input id="reportId" type="hidden" value="{{ $reportId }}"/>
            @if(isset($queryFk) && isset($query))
            <div class="row header">
                    <div class="col-xs-4">
                        <input class="query-input form-control" data-query-id="{{ $queryFk }}" type="text" value="{{ $query }}"/>
                    </div>
                <span class="col-xs-1">
                <i id="save-query" data-query="{{ $query }}"
                   data-query-id="{{ $queryFk }}" class="fa fa fa-floppy-o">
                </i>
               </span>
                    <div class="col-xs-6">
                        <button class="btn btn-primary" id="next-query-preview">{{trans('google.next_query')}}</button>
                    </div>
            </div>
            @endif
        </div>
        <div class="panel-body table-responsive">

            <table class="table table-striped task-table data-table" id="results-table">
                <div class="filter-container">
                    <span class="results-filter btn btn-default active" id="accepted-results">תוצאות שנבחרו</span>
                    <span class="results-filter btn btn-default" id="removed-results">תוצאות שנפסלו</span>
                    <input type="hidden" id="results-filter">
                </div>
                <thead>
                <th>{{ trans('google.query') }}</th>
                <th>{{ trans('google.title') }}</th>
                <th>{{ trans('google.description') }}</th>
                <th>{{ trans('google.user_comments') }}</th>
                <th>{{ trans('google.url') }}</th>
                <th>{{ trans('google.change_selection') }}</th>
                <th>{{ trans('google.edit') }}</th>
                <th class="hidden"></th>
                </thead>
                <tbody>
                @foreach ($results as $result)
                    <tr data-id="{{$result->getId()}}">

                        <td class="table-text">
                            <div  data-query="{{$result->getQuery()}}">{{$result->getQuery()}}</div>
                        </td>
                        <td class="table-text">
                            <textarea  data-title="{{$result->getTitle()}}">{{ $result->getTitle() }}</textarea>
                        </td>
                        <td class="table-text">
                            <textarea  data-description="{{$result->getDescription()}}">{{$result->getDescription()}}</textarea>
                        </td>
                        <td>
                            <textarea data-user-comments="{{$result->getUserComments()}}">{{$result->getUserComments()}}</textarea>
                        </td>
                        <td class="table-text result-url">
                            <div data-url="{{ $result->getUrl() }}">
                                <a href="{{ $result->getUrl() }}"> {{ $result->getShortenedUrl() }}</a>
                            </div>
                        </td>
                        <td class="table-text result-switch"  data-value = {{$result->getDeleted()}}>
                            @if($result->getDeleted()=='0')
                            @include('fields.switch',['id'=>'check-'.$result->getId(),'resultId'=>$result->getId(),'checked'=>'checked'])
                            @else
                                @include('fields.switch',['id'=>'check-'.$result->getId(),'resultId'=>$result->getId()])
                            @endif
                        </td>
                        <td class="table-text edit-cell">
                            <span>
                                <i class="fa fa fa-floppy-o" aria-hidden="true"></i>
                            </span>
                        </td>
                        <td class="hidden">{{$result->getDeleted()}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endsection

@section('table_scripts')
    <script src="{{ asset('js/google_api.js') }}"></script>
    <script src="{{asset('js/init_results_table.js')}}"></script>
    <script src="{{ asset('js/googleClasses.js') }}" class="script"></script>
    <script src="{{ asset('js/googleHelpers.js') }}"></script>
    <script src="{{ asset('js/googleApiService.js') }}"></script>
@endsection

