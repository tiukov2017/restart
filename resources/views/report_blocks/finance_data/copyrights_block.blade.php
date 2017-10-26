@extends('report_layouts.expandable_title_fieldblock')
@section('collapse_fields')

    @include('fields.textarea_field', [ 'label' => 'פרטי הנכס', 'name' => '210_19', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.simple_smart_field', [ 'label' => 'בעל הזכויות', 'name' => '211_19', 'type' => 'text', 'search' => false, 'doubleCheck'=> TRUE, 'unique' => false, 'value' => '' ])

    @include('fields.simple_smart_field', [ 'label' => 'פרטי הזכויות', 'name' => '212_19', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.simple_field', [ 'label' => 'תאריך רישום', 'name' => '213_19', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.simple_smart_field', [ 'label' => 'סטאטוס', 'name' => '214_19', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.simple_smart_field', [ 'label' => 'הערות', 'name' => '215_19', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])


@overwrite