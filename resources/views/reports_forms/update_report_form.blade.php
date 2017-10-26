<div id="update-area"  style="display: none">
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-minus-sign"  data-form="#update-form" ></span>
            <span>{{trans('reports.edit-report-status')}}</span>
        </div>
    </div>
    <form id="update-form" method="post" class="form-horizontal" action="{{route('updateStatus')}}">
        {!! csrf_field() !!}
       {{--report id--}}
        <input type="hidden" name="reportId" />
        <div class="form-group">
            <label for="status" class="col-sm-3 control-label">{{ trans('reports.status') }}</label>
            <div class="col-sm-6">
                <select name="status" required class="form-control">
                    @foreach($statuses as $status)
                        <option value="{{$status->getId()}}">{{trans('statuses.'.$status->getName())}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        {{--user assigned to the report--}}
        <div class="form-group">
            <label for="user" class="col-sm-3 control-label">{{ trans('reports.user') }}</label>
            <div class="col-sm-6">
                <select name="user" required class="form-control">
                    @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        {{--report creation date--}}
        <div class="form-group">
            <label for="date" class="col-sm-3 control-label">{{ trans('reports.creationDate') }}</label>
            <div class="col-sm-6">
                <input name="date" type="text" disabled class="form-control">
            </div>
        </div>
        {{--report type--}}
        <div class="form-group">
            <label for="type" class="col-sm-3 control-label">{{ trans('reports.type') }}</label>
            <div class="col-sm-6">
                <input  name="type" type="text" disabled class="form-control">
            </div>
        </div>
        {{--customer ordered the report--}}
        <div class="form-group">
            <label for="customer" class="col-sm-3 control-label">{{ trans('reports.customer') }}</label>
            <div class="col-sm-6">
                <input  name="customer" type="text" disabled class="form-control">
            </div>
        </div>
        {{--object of the report full name--}}
        <div class="form-group">
            <label for="objectFullName" class="col-sm-3 control-label">{{ trans('reports.reportObject') }}</label>
            <div class="col-sm-6">
                <input type="text" name="objectFullName" disabled class="form-control">
            </div>
        </div>
        {{--object of the report id--}}
        <div class="form-group">
            <label for="objectId" class="col-sm-3 control-label">{{ trans('reports.reportObjectId') }}</label>
            <div class="col-sm-6">
                <input type="text"  name="objectId" disabled class="form-control">
            </div>
        </div>
        {{--object of the report comment--}}
        <div class="form-group">
            <label for="comment" class="col-sm-3 control-label">{{ trans('reports.comment') }}</label>
            <div class="col-sm-6">
                <textarea name="comment"  class="form-control"></textarea>
            </div>
        </div>
        {{--save button--}}
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-5">
                <button id="update-button"  disabled formmethod="post" class="btn btn-default">
                    <i class="fa fa-save"></i> {{ trans('user.confirm_and_save') }}
                </button>
            </div>
            {{--save button--}}
            <div class="col-sm-4">
                <button id="update-and-edit" type="submit" disabled formmethod="post" class="btn btn-default">
                    <i class="fa fa-pencil"></i> {{ trans('user.confirm_and_edit') }}
                </button>
            </div>
        </div>
    </form>
</div>