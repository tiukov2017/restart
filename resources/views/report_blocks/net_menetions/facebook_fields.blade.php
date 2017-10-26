@extends('report_layouts.expandable_social_fieldblock')
@section('collapse_fields')


    <div class="row">


        <ul class="col-xs-5 social_tabs" role="tablist">
            <li role="presentation" class="active"><a href="#fb_personal_details" aria-controls="fb_personal_details" role="tab" data-toggle="tab">
                    פרטים אישיים
                </a>
            </li>
            <li role="presentation">
                <a href="#fb_posts" aria-controls="fb_posts" role="tab" data-toggle="tab">
                    פוסטים בולטים שפורסמו
                </a>
            </li>
            <li role="presentation"><a href="#fb_places" aria-controls="fb_places" role="tab" data-toggle="tab">מקומות ואירועים בהם ביקר</a></li>
            <li role="presentation"><a href="#fb_groups" aria-controls="fb_groups" role="tab" data-toggle="tab">קבוצות בולטות</a></li>
            <li role="presentation"><a href="#fb_pics" aria-controls="fb_pics" role="tab" data-toggle="tab">תמונות</a></li>
            <li role="presentation"><a href="#fb_summary" aria-controls="fb_summary" role="tab" data-toggle="tab">סיכום נתוני פרופיל</a></li>
        </ul>


        <div class="tab-content social_tabs_content col-xs-7">
            <div role="tabpanel" class="tab-pane active" id="fb_personal_details">
                @include('fields.simple_smart_field', [ 'label' => false, 'name' => '61_4', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])
            </div>
            <div role="tabpanel" class="tab-pane" id="fb_posts">
                @include('fields.simple_smart_field', [ 'label' => false, 'name' => '63_4', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])
            </div>
            <div role="tabpanel" class="tab-pane" id="fb_places">
                @include('fields.simple_smart_field', [ 'label' => false, 'name' => '64_4', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])
            </div>
            <div role="tabpanel" class="tab-pane" id="fb_groups">
                @include('fields.simple_smart_field', [ 'label' => false, 'name' => '67_4', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])
            </div>
            <div role="tabpanel" class="tab-pane" id="fb_pics">
                @include('fields.simple_smart_field', [ 'label' => false, 'name' => '68_4', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])
            </div>
            <div role="tabpanel" class="tab-pane" id="fb_summary">
                @include('fields.simple_smart_field', [ 'label' => false, 'name' => '90_5_2', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])
            </div>

    </div>



    </div>

@overwrite