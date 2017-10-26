<!-- resources/views/tasks.blade.php -->

@extends('layouts.table_layout')

    @section('addHeader')
        @role('admin')
            <span>{{trans('reports.add')}}</span>
        @endrole
    @endsection
    @section('form')
        {{--report id--}}
        <input type="hidden"  id="reportId">

        @role('admin')
        @include('reports_forms.create_report_form',['types'=>$types,'users'=>$users])
        @endrole

        @include('reports_forms.update_report_form',['statuses'=>$statuses,'users'=>$users])
        @include('reports_forms.update_order_form')
    @endsection
    @section('table')
        <div class="panel panel-default">
            <div class="panel-heading">
                {{ trans('reports.reports') }}
            </div>
            <div class="panel-body">

                <table class="table table-striped task-table data-table" id="reports-table">
                    <div class="checkbox-container">
                        <input id="checkbox" type="checkbox"><label>{{trans('reports.filter')}}</label>
                    </div>
                    <thead>
                    <th>{{ trans('reports.status') }}</th>
                    <th>{{ trans('reports.user') }}</th>
                    <th>{{ trans('reports.creationDate') }}</th>
                    <th>{{ trans('reports.type') }}</th>
                    <th>{{ trans('reports.customer') }}</th>
                    <th>{{ trans('reports.reportObjectId') }}</th>
                    <th>{{trans('reports.reportObject')}}</th>
                    <th>{{ trans('reports.reference')}} </th>
                    <th>{{ trans('reports.edit')}}</th>
                    </thead>
                    <tbody>
                    @foreach ($reports as $report)
                        <tr data-toggle="tooltip"  data-html="true"  class="update-row {{ !is_null($report->getLock()) ? 'locked' : ''}}"
                            {{ !is_null($report->getLock()) ? 'data-original-title=מטפל:'.$report->getLockMessage() : ''}}
                            data-report-edit="{{route('editor',['id' => $report->getId()])}}">

                            <td class="table-text">
                                <div data-prop="status" data-status-id="{{$report->getStatus()->id}}">{{trans('statuses.'.$report->getStatus()->name)}}</div>
                            </td>
                            <td class="table-text">
                                <div data-prop="user" data-user-id="{{$report->getUser()->id}}">{{ $report->getUser()->name }}</div>
                            </td>
                            <td class="table-text"  data-prop="date">{{date('d/m/y H:i', strtotime($report->getDate()))}}</td>
                            <td class="table-text">
                                <div  data-prop="type">{{trans('reports.'.$report->getType()->name)}}</div>
                            </td>
                            <td class="table-text">
                                <div  data-prop="customer">{{ $report->getCustomer() }}</div>
                            </td>
                            <td class="table-text">
                                <div data-prop="objectId">{{ $report->getObjectId() }}</div>
                            </td>
                            <td class="table-text">
                                <div data-prop="objectFullName">{{ $report->getObjectFirstName() ." ".  $report->getObjectLastName() }}</div>
                            </td>
                            <td class="table-text references-cell">
                                <a href="{{ route('references',['report_id'=>$report->getId()])}}">
                             @if($report->getReferences()->count()>0)
                                    <div>
                                     <i class="fa fa-camera" aria-hidden="true"></i>
                                    </div>
                                </a>
                              @endif
                            </td>
                            <td class="table-text edit-cell">
                             <div>
                                 {{--report attributes hidden on table--}}
                                 @include('reports_forms.report_hidden_fields',['report'=>$report])
                                <i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i>
                             </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @include('reports.file_properties_popup',['title'=>'פרטי קובץ','id'=>'file-popup','acceptAction'=>'update-file-attributes','cancelAction'=>'cancel-file'])
@endsection
    @section('table_scripts')
        <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
        <script src="//cdn.datatables.net/plug-ins/1.10.12/sorting/datetime-moment.js"></script>
    <script src="{{asset('js/reports_table.js')}}"></script>
    <script src="{{asset('js/bootstrap-filestyle.min.js')}}"></script>
        @endsection