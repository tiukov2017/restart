@extends('report_layouts.expandable_social_fieldblock')
@section('collapse_fields')


    <div class="row">


        <ul class="col-xs-5 social_tabs" role="tablist">
            <li role="presentation" class="active"><a href="#linkden_personal_details" aria-controls="linkden_personal_details" role="tab" data-toggle="tab">
פרופיל
                </a>
            </li>
            <li role="presentation">
                <a href="#linkden_brief" aria-controls="#linkden_brief" role="tab" data-toggle="tab">
תקציר הפרופיל
                </a>
            </li>
            <li role="presentation"><a href="#linkden_jobs" aria-controls="linkden_jobs" role="tab" data-toggle="tab">
                    ניסיון תעסוקתי ועבודות
                </a>
            </li>
            <li role="presentation"><a href="#linkden_recommendations" aria-controls="linkden_recommendations" role="tab" data-toggle="tab">
                   מיומנויות
                </a>
            </li>
            <li role="presentation"><a href="#linkden_groups" aria-controls="linkden_groups" role="tab" data-toggle="tab">קבוצות ותחומי עניין</a></li>
            <li role="presentation"><a href="#linkden_volunteering" aria-controls="linkden_volunteering" role="tab" data-toggle="tab">פעילות התנדבותית</a></li>
            <li role="presentation"><a href="#linkden_tracking_subjects" aria-controls="linkden_tracking_subjects" role="tab" data-toggle="tab">גופים/ נושאים למעקב</a></li>
        </ul>


        <div class="tab-content social_tabs_content col-xs-7">
            <div role="tabpanel" class="tab-pane active" id="linkden_personal_details">

                @include('fields.simple_smart_field', [ 'label' => false, 'name' => '90_5_1', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

            </div>
            <div role="tabpanel" class="tab-pane" id="linkden_brief">
                @include('fields.simple_smart_field', [ 'label' => false, 'name' => '85_5', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])
            </div>
            <div role="tabpanel" class="tab-pane" id="linkden_jobs">
                @include('fields.simple_smart_field', [ 'label' => false, 'name' => '81_5', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])
            </div>
            <div role="tabpanel" class="tab-pane" id="linkden_recommendations">
                @include('fields.simple_smart_field', [ 'label' => false, 'name' => '86_5', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])
            </div>
            <div role="tabpanel" class="tab-pane" id="linkden_groups">
                @include('fields.simple_smart_field', [ 'label' => false, 'name' => '87_5', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

            </div>
            <div role="tabpanel" class="tab-pane" id="linkden_volunteering">
                @include('fields.simple_smart_field', [ 'label' => false, 'name' => '88_5', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])
            </div>
            <div role="tabpanel" class="tab-pane" id="linkden_tracking_subjects">
                @include('fields.simple_smart_field', [ 'label' => false, 'name' => '89_5', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])
            </div>

    </div>



    </div>

@overwrite