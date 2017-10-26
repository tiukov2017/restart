@extends('report_layouts.expandable_title_fieldblock')
@section('collapse_fields')
    @include('fields.textarea_field', [ 'label' => 'סוג התיק', 'name' => '117_9', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.textarea_field', [ 'label' => "מס' תיק איחוד" , 'name' => '118_9', 'type' => 'number', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.textarea_field', [ 'label' => "מס' תיק/תיקים כלולים" ,'name' => '119_9', 'type' => 'number', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.simple_field', [ 'label' => 'תאריך פתיחת התיק', 'name' => '120_9', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.textarea_field', [ 'label' => 'מוגבל באמצעים', 'name' => '121_9', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.simple_field', [ 'label' => 'תאריך הכרזת הגבלה באמצעים', 'name' => '122_9', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.simple_field', [ 'label' => 'תאריך קבלת הנתון', 'name' => '123_9', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])


@overwrite