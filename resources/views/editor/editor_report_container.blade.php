<div id="inputs-container">
    <div class="size-contorls">
        <i class="fa fa-expand expand" aria-hidden="true"></i>
        <i class="fa fa-compress compress"  aria-hidden="true"></i>
    </div>

    <div class="alert alert-info" id="check-guidelines">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <span>{{$checkList[0]->getGuidelines()}}</span>
    </div>
    <h3>{{trans('editor.report_input_fields')}}</h3>
    <h4>{{$checkList[0]->getCheckName()}}</h4>
    <form class="form" id="check-inputs-form">
    </form>
</div>
<div class="resizable-report-container resizable" id="resizable-report-container">
    <iframe id="editor-report-iframe" name="editor-report-iframe" src="{{route('editReport',['id' => $id])}}" width="100%"  onload="resizeIframe(this, 640)" height="640"></iframe>
</div>


￼