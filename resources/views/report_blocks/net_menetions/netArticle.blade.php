@extends('report_layouts.expandable_title_fieldblock')
@section('collapse_fields')

    @include('fields.textarea_field', [ 'label' => 'מקור האזכור', 'name' => '49_3', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.simple_field', [ 'label' => 'תאריך האזכור', 'name' => '50_3', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.textarea_field', [ 'label' => 'כותרת ראשית', 'name' => '51_3', 'type' => 'text', 'search' => false, 'doubleCheck'=> TRUE, 'unique' => false, 'value' => '' ])

    @include('fields.textarea_field', [ 'label' => 'כותרת משנית', 'name' => '52_3', 'type' => 'text', 'search' => false, 'doubleCheck'=> TRUE, 'unique' => false, 'value' => '' ])

    @include('fields.simple_smart_field', [ 'label' => 'תמצית האזכור', 'name' => '53_3', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.image_field', [ 'label' => 'תמונה/ות', 'name' => '54_3', 'type' => '', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => asset('assets/images/no-image.png') ])

    @include('fields.simple_smart_field', [ 'label' => 'הערות', 'name' => '55_3', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])
@overwrite