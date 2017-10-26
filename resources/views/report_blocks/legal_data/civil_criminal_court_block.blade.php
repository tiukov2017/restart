@extends('report_layouts.expandable_title_fieldblock')
@section('collapse_fields')

    @include('fields.textarea_field', [ 'label' => 'מקום הדיון', 'name' => '159_14', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.textarea_field', [ 'label' => 'מספר תיק', 'name' => '160_14', 'type' => 'number', 'search' => false, 'doubleCheck'=> TRUE, 'unique' => false, 'value' => '' ])

    @include('fields.textarea_field', [ 'label' => 'סוג הליך', 'name' => '161_14', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.simple_field', [ 'label' => 'תאריך החלטה/פסק הדין', 'name' => '162_14', 'type' => 'date', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.simple_smart_field', [ 'label' => "צד א׳ - תובע/מבקש",'name' => '163_14', 'type' => 'text', 'search' => false, 'doubleCheck'=> TRUE, 'unique' => false, 'value' => '' ])

    @include('fields.simple_smart_field', [ 'label' => "צד ב׳ - נתבע/משיב", 'name' => '164_14', 'type' => 'text', 'search' => false, 'doubleCheck'=> TRUE, 'unique' => false, 'value' => '' ])

    @include('fields.textarea_field', [ 'label' => 'מעמד נשוא הדוח בהליך (אינו תובע/נתבע)', 'name' => '165_14', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.simple_smart_field', [ 'label' => 'נושא הדיון', 'name' => '166_14', 'type' => 'text', 'search' => false, 'doubleCheck'=> TRUE, 'unique' => false, 'value' => '' ])

    @include('fields.simple_smart_field', [ 'label' => 'ציטוט החלטה/פסק הדין', 'name' => '167_14', 'type' => 'text', 'search' => false, 'doubleCheck'=> TRUE, 'unique' => false, 'value' => '' ])

    @include('fields.simple_smart_field', [ 'label' => 'תמצית ההליך והתייחסות ישירה לנשוא הדוח ', 'name' => '168_14', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.simple_smart_field', [ 'label' => 'הערות', 'name' => '169_14', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])


@overwrite