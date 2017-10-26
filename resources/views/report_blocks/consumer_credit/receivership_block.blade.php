@extends('report_layouts.expandable_title_fieldblock')
@section('collapse_fields')

    @include('fields.textarea_field', [ 'label' => 'בית משפט', 'name' => '126_10', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.textarea_field', [ 'label' => 'מספר התיק', 'name' => '127_10', 'type' => 'number', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.simple_field', [ 'label' => 'תאריך הגשת הבקשה', 'name' => '128_10', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.simple_field', [ 'label' => 'תאריך צו כינוס', 'name' => '129_10', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.textarea_field', [ 'label' => 'מגיש הבקשה', 'name' => '130_10', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.textarea_field', [ 'label' => 'סטאטוס', 'name' => '131_10', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.textarea_field', [ 'label' => 'יתרה בתיק', 'name' => '132_10', 'type' => 'number', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])


@overwrite