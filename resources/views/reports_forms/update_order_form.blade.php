<div id="update-order-area" {{!(isset($dropdown)) ? 'style="display: none"' : ''}}>
    <div class="panel panel-default">
        <div class="panel-heading">
            @if(!(isset($dropdown)))
            <span class="glyphicon glyphicon-plus-sign"  data-form="#update-order" ></span>
            @endif
            <span>{{trans('reports.edit-order')}}</span>
        </div>
    </div>
    <div class="panel panel-default" id="update-order" {{!(isset($dropdown)) ? 'style=display:none' : ''}}>
        <div class="panel panel-default">
        </div>
    <div class="panel-body">
    <form method="post" class="form-horizontal" action="{{route('updateReport')}}">
       {{--csrf token--}}
        {!! csrf_field() !!}
        <div class="row">
       {{--report id--}}
        <input type="hidden" name="reportId" value="{{isset($report)? $report->getId():''}}">
            <div class="col-xs-3">
        {{--object of the report id--}}
        <div class="form-group">
            <label for="objectId" class="col-sm-3 control-label">{{ trans('reports.reportObjectId') }}</label>
            <div class="col-sm-6">
                <input type="text" required  maxlength="10" name="objectId" id="objectId"  class="form-control" value="{{isset($report)? $report->getObjectId():''}}">
            </div>
        </div>
        {{--object of report the first name--}}
        <div class="form-group">
            <label for="report-object-first-name" class="col-sm-3 control-label">{{ trans('reports.reportObjectFirstName') }}</label>
            <div class="col-sm-6">
                <input type="text" required name="objectFirstName" id="objectFirstName" class="form-control" value="{{isset($report)? $report->getObjectFirstName():''}}">
            </div>
        </div>
        {{--object of report the last name--}}
        <div class="form-group">
            <label for="report-object-last-name" class="col-sm-3 control-label">{{ trans('reports.reportObjectLastName') }}</label>
            <div class="col-sm-6">
                <input type="text" required name="objectLastName" id="objectLastName" class="form-control" value="{{isset($report)? $report->getObjectLastName():''}}">
            </div>
        </div>
        {{--object of report the english first name--}}
        <div class="form-group">
            <label for="report-english-first-name" class="col-sm-3 control-label">{{ trans('reports.reportEnglishFirstName') }}</label>
            <div class="col-sm-6">
                <input type="text"  name="englishFirstName" id="englishFirstName" class="form-control" value="{{isset($report)? $report->getEnglishFirstName():''}}">
            </div>
        </div>
            </div>
            <div class="col-xs-3">
        {{--object of report the english last name--}}
        <div class="form-group">
            <label for="report-object-english-last-name" class="col-sm-3 control-label">{{ trans('reports.reportEnglishLastName') }}</label>
            <div class="col-sm-6">
                <input type="text" name="englishLastName" id="englishLastName" class="form-control" value="{{isset($report)? $report->getEnglishLastName():''}}">
            </div>
        </div>
        {{--customer ordered the report--}}
        <div class="form-group">
            <label for="customer" class="col-sm-3 control-label">{{ trans('reports.customer') }}</label>
            <div class="col-sm-6">
                <input type="text" required name="customer" id="customer" class="form-control" value="{{isset($report)? $report->getCustomer():''}}">
            </div>
        </div>
        {{--phone number--}}
        <div class="form-group">
            <label for="phone" class="col-sm-3 control-label">{{ trans('reports.phone') }}</label>
            <div class="col-sm-6">
                <input type="text" name="phone" id="phone" class="form-control" value="{{isset($report)? $report->getPhoneNumber():''}}">
            </div>
        </div>
        {{--mobile number--}}
        <div class="form-group">
            <label for="mobile" class="col-sm-3 control-label">{{ trans('reports.mobile') }}</label>
            <div class="col-sm-6">
                <input type="text"  name="mobile" id="mobile" class="form-control" value="{{isset($report)? $report->getMobileNumber():''}}">
            </div>
        </div>
            </div>
            <div class="col-xs-3">
        {{--fax number--}}
        <div class="form-group">
            <label for="fax" class="col-sm-3 control-label">{{ trans('reports.fax') }}</label>
            <div class="col-sm-6">
                <input type="text" name="fax" id="fax" class="form-control" value="{{isset($report)? $report->getFax():''}}">
            </div>
        </div>
        {{--email--}}
        <div class="form-group">
            <label for="email" class="col-sm-3 control-label">{{ trans('reports.email') }}</label>
            <div class="col-sm-6">
                <input type="text" name="email" id="email" class="form-control" value="{{isset($report)? $report->getEmail():''}}">
            </div>
        </div>
        {{--nickname--}}
        <div class="form-group">
            <label for="nickname" class="col-sm-3 control-label">{{ trans('reports.nickname') }}</label>
            <div class="col-sm-6">
                <input type="text" name="nickname" id="nickname" class="form-control" value="{{isset($report)? $report->getNickName():''}}">
            </div>
        </div>
        {{--secondary name--}}
        <div class="form-group">
            <label for="secondary-name" class="col-sm-3 control-label">{{ trans('reports.secondary-name') }}</label>
            <div class="col-sm-6">
                <input type="text" name="secondary-name" id="secondary-name" class="form-control" value="{{isset($report)? $report->getSecondaryName():''}}">
            </div>
        </div>
            </div>
            <div class="col-xs-3">
        {{--secondary email--}}
        <div class="form-group">
            <label for="secondary-email" class="col-sm-3 control-label">{{ trans('reports.secondary-email') }}</label>
            <div class="col-sm-6">
                <input type="text" name="secondary-email" id="secondary-email" class="form-control" value="{{isset($report) ? $report->getSecondaryEmail() : ''}}">
            </div>
        </div>
        {{--secondary phone--}}
        <div class="form-group">
            <label for="secondary-phone" class="col-sm-3 control-label">{{ trans('reports.secondary-phone') }}</label>
            <div class="col-sm-6">
                <input type="text" name="secondary-phone" id="secondary-phone" class="form-control" value="{{isset($report)? $report->getSecondaryPhone():''}}">
            </div>
        </div>
        {{--english nickname--}}
        <div class="form-group">
            <label for="english-nickname" class="col-sm-3 control-label">{{ trans('reports.english-nickname') }}</label>
            <div class="col-sm-6">
                <input type="text" name="english-nickname" id="english-nickname" class="form-control" value="{{isset($report)? $report->getEnglishNickName():''}}">
            </div>
        </div>
        {{--secondary english name--}}
        <div class="form-group">
            <label for="secondary-english-name" class="col-sm-3 control-label">{{ trans('reports.secondary-english-name') }}</label>
            <div class="col-sm-6">
                <input type="text" name="secondary-english-name" id="secondary-english-name" class="form-control" value="{{isset($report)? $report->getSecondaryEnglishName():''}}">
            </div>
        </div>
        {{--submit--}}
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-plus"></i> {{ trans('common.update') }}
                </button>
            </div>
        </div>
        </div>
        </div>
        {{--files table--}}
        <div class="panel panel-default">
            <div class="panel-heading">
                <span class="glyphicon glyphicon-plus-sign"  data-form="#files-table-container" ></span>
                <span>{{trans('files.attached-files')}}</span>
            </div>
            <div id="files-table-container" style="display: none">
                <table id="files-table" class="table table-striped">
                    <thead>
                    <tr>
                        <th>{{trans('files.name')}}</th>
                        <th>{{trans('files.description')}}</th>
                        <th>{{trans('files.type')}}</th>
                        <th>{{trans('common.update')}}</th>
                        <th>{{trans('common.delete')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($report))
                        @foreach($report->getFiles() as $file)
                            <tr>
                                 <td data-value="name"><input type="text" value="{{$file->name}}"></td>
                                 <td data-value="description"><input type="text" value="{{$file->description}}"></td>
                                 <td data-value="url"><a download href="{{$file->url}}">{{substr($file->url,strripos($file->url,'.'))}}</a></td>
                                 <td><i data-id="{{$file->id}}" data-toggle="tooltip" title="שמירה" class="fa fa-save fa-lg edit-row" aria-hidden="true"></i></td>
                                 <td><i data-id="{{$file->id}}" class="fa fa-trash remove-row" aria-hidden="true"></i></td></tr>
                            @endforeach
                    @endif
                    </tbody>
                    <tfoot>
                     <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th style="width:100px">
                            @include('common.file_input',['class'=>'add-files','attributes'=>'multiple data-input=false id=table-upload'])
                            <button class="add-file btn btn-primary" disabled><span class="hidden loader"></span>{{trans('files.add-files')}}</button>
                        </th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        {{--end of files table--}}
       </form>
    </div>
    </div>
</div>