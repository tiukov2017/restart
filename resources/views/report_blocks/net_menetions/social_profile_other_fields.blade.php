@extends('report_layouts.expandable_social_fieldblock')

@section('collapse_fields')

    <ul class="col-xs-5 social_tabs" role="tablist">
        <li role="presentation"><a href="#title" aria-controls="title" role="tab" data-toggle="tab">כותרת</a></li>

        <li role="presentation"><a href="#summary" aria-controls="summary" role="tab" data-toggle="tab">תקציר</a></li>

        <li role="presentation"><a href="#pics" aria-controls="pics" role="tab" data-toggle="tab">תמונות</a></li>

        <li role="presentation"><a href="#comments" aria-controls="comments" role="tab" data-toggle="tab">הערות</a></li>
    </ul>

    <div class="tab-content social_tabs_content col-xs-7">

        <div role="tabpanel" class="tab-pane" id="title">
            @include('fields.simple_smart_field', [ 'label' => false, 'name' => '63_411', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])
        </div>
        <div role="tabpanel" class="tab-pane" id="summary">
            @include('fields.simple_smart_field', [ 'label' => false, 'name' => '64_411', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])
        </div>
        <div role="tabpanel" class="tab-pane" id="pics">
            @include('fields.simple_smart_field', [ 'label' => false, 'name' => '67_411', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])
        </div>
        <div role="tabpanel" class="tab-pane" id="comments">
            @include('fields.simple_smart_field', [ 'label' => false, 'name' => '68_411', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])
        </div>

    </div>
@overwrite