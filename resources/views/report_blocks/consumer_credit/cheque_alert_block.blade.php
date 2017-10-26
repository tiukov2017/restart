@extends('report_layouts.expandable_title_fieldblock')
@section('collapse_fields')

    @include('fields.textarea_field', [ 'label' => 'סוג ההתראה', 'name' => '104_7', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.textarea_field', [ 'label' => 'רמת החיוב', 'name' => '105_7', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.textarea_field', [ 'label' => 'מקור המידע', 'name' => '106_7', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.simple_field', [ 'label' => 'תאריך משלוח ההתראה', 'name' => '107_7', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.simple_field', [ 'label' => 'תאריך קבלת הנתון', 'name' => '108_7', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])


@overwrite