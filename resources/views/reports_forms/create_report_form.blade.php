<form action="{{ url('report') }}" enctype="multipart/form-data"  method="POST" class="form-horizontal" id="add-form" style="display: none" >
    {{--csrf token--}}
    {!! csrf_field() !!}
 <div class="row">

         <div class="col-xs-4">
    {{--object of the report id--}}
    <div class="form-group">
        <label for="report-object-id" class="col-sm-3 control-label">{{ trans('reports.reportObjectId') }}</label>
        <div class="col-sm-6">
            <input type="text" required  maxlength="10" name="objectId" id="report-object-id"  class="form-control">
        </div>
    </div>
    {{--object of the report first name--}}
    <div class="form-group">
        <label for="report-object-first-name" class="col-sm-3 control-label">{{ trans('reports.reportObjectFirstName') }}</label>
        <div class="col-sm-6">
            <input type="text" required name="objectFirstName" id="report-object-first-name" class="form-control">
        </div>
    </div>
    {{--object of the report last name--}}
    <div class="form-group">
        <label for="report-object-last-name" class="col-sm-3 control-label">{{ trans('reports.reportObjectLastName') }}</label>
        <div class="col-sm-6">
            <input type="text" required name="objectLastName" id="report-object-last-name" class="form-control">
        </div>
    </div>
    {{--object of the report english first name--}}
    <div class="form-group">
        <label for="report-english-first-name" class="col-sm-3 control-label">{{ trans('reports.reportEnglishFirstName') }}</label>
        <div class="col-sm-6">
            <input type="text" required name="englishFirstName" id="report-english-first-name" class="form-control">
        </div>
    </div>
    {{--object of the report english last name--}}
    <div class="form-group">
        <label for="report-object-last-name" class="col-sm-3 control-label">{{ trans('reports.reportEnglishLastName') }}</label>
        <div class="col-sm-6">
            <input type="text" required name="englishLastName" id="report-english-last-name" class="form-control">
        </div>
    </div>
    {{--customer ordered the report--}}
    <div class="form-group">
        <label for="customer" class="col-sm-3 control-label">{{ trans('reports.customer') }}</label>
        <div class="col-sm-6">
            <input type="text" required name="customer" id="customer" class="form-control">
        </div>
    </div>
    {{--phone number--}}
    <div class="form-group">
        <label for="phone" class="col-sm-3 control-label">{{ trans('reports.phone') }}</label>
        <div class="col-sm-6">
            <input type="text"  name="phone" id="report-phone" class="form-control">
        </div>
    </div>
         </div>
         <div class="col-xs-4">
    {{--mobile number--}}
    <div class="form-group">
        <label for="mobile" class="col-sm-3 control-label">{{ trans('reports.mobile') }}</label>
        <div class="col-sm-6">
            <input type="text"  name="mobile" id="report-mobile" class="form-control">
        </div>
    </div>
    {{--fax number--}}
    <div class="form-group">
        <label for="fax" class="col-sm-3 control-label">{{ trans('reports.fax') }}</label>
        <div class="col-sm-6">
            <input type="text"  name="fax" id="report-mobile" class="form-control">
        </div>
    </div>
    {{--email--}}
    <div class="form-group">
        <label for="email" class="col-sm-3 control-label">{{ trans('reports.email') }}</label>
        <div class="col-sm-6">
            <input type="text"  name="email" id="report-email" class="form-control">
        </div>
    </div>
    {{--nickname--}}
    <div class="form-group">
        <label for="email" class="col-sm-3 control-label">{{ trans('reports.nickname') }}</label>
        <div class="col-sm-6">
            <input type="text"  name="nickname" id="report-nickname" class="form-control">
        </div>
    </div>
    {{--secondary name--}}
    <div class="form-group">
        <label for="email" class="col-sm-3 control-label">{{ trans('reports.secondary-name') }}</label>
        <div class="col-sm-6">
            <input type="text"  name="secondary-name" id="report-secondary-name" class="form-control">
        </div>
    </div>
    {{--secondary email--}}
    <div class="form-group">
        <label for="secondary-email" class="col-sm-3 control-label">{{ trans('reports.secondary-email') }}</label>
        <div class="col-sm-6">
            <input type="text"  name="secondary-email" id="report-secondary-email" class="form-control">
        </div>
    </div>
    {{--secondary phone--}}
    <div class="form-group">
        <label for="secondary-phone" class="col-sm-3 control-label">{{ trans('reports.secondary-phone') }}</label>
        <div class="col-sm-6">
            <input type="text"  name="secondary-phone" id="report-secondary-phone" class="form-control">
        </div>
    </div>
         </div>
         <div class="col-xs-4">
    {{--english nickname--}}
    <div class="form-group">
        <label for="english-nickname" class="col-sm-3 control-label">{{ trans('reports.english-nickname') }}</label>
        <div class="col-sm-6">
            <input type="text"  name="english-nickname" id="report-english-nickname" class="form-control">
        </div>
    </div>
    {{--secondary english name--}}
    <div class="form-group">
        <label for="secondary-english-name" class="col-sm-3 control-label">{{ trans('reports.secondary-english-name') }}</label>
        <div class="col-sm-6">
            <input type="text" name="secondary-english-name" id="report-secondary-english-name" class="form-control">
        </div>
    </div>
    {{--user assigned to the report--}}
    <div class="form-group">
        <label for="user" class="col-sm-3 control-label">{{ trans('reports.user') }}</label>
        <div class="col-sm-6">
            <select type="text" required name="user" id="user" class="form-control">
                <option disabled selected value></option>
                @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    {{--report type--}}
    <div class="form-group">
        <label for="type" class="col-sm-3 control-label">{{ trans('reports.type') }}</label>
        <div class="col-sm-6">
            <select type="text" required name="type" id="report-type" class="form-control">
                @foreach($types as $type)
                    <option value="{{$type->getId()}}">{{trans('reports.'.$type->getName())}}</option>
                @endforeach
            </select>
        </div>
    </div>
    {{--report comments--}}
    <div class="form-group">
        <label for="comment" class="col-sm-3 control-label">{{ trans('reports.comment') }}</label>
        <div class="col-sm-6">
                <textarea name="comment" id="report-comment" class="form-control">
                </textarea>
        </div>
    </div>
    {{--attached files comments--}}
    <div class="form-group">
        <label for="file" class="col-sm-3 control-label">{{ trans('reports.file') }}</label>
        <div class="col-sm-6">
            @include('common.file_input')
        </div>
    </div>
         {{--submit button--}}
         <div class="form-group">
             <div class="col-sm-offset-3 col-sm-6">
                 <button type="submit" class="btn btn-default">
                     <i class="fa fa-plus"></i> {{ trans('reports.add') }}
                 </button>
             </div>
         </div>
     </div>
 </div>
</form>