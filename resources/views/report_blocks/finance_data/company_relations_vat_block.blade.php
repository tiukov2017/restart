@extends('report_layouts.expandable_title_fieldblock')
@section('collapse_fields')

    @include('fields.simple_field', [ 'label' => 'שם העוסק', 'name' => '219_20'.$input_suffix, 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.simple_field', [ 'label' => 'כינוי העסק', 'name' => '220_20'.$input_suffix, 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.simple_field', [ 'label' => 'סוג ענף', 'name' => '221_20'.$input_suffix, 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.simple_field', [ 'label' => 'מספר ענף', 'name' => '222_20'.$input_suffix, 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.simple_field', [ 'label' => 'כתובת', 'name' => '223_20'.$input_suffix, 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.simple_field', [ 'label' => 'אזור', 'name' => '224_20'.$input_suffix, 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.simple_field', [ 'label' => 'סוג תיק', 'name' => '225_20'.$input_suffix, 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.simple_smart_field', [ 'label' => 'הערות', 'name' => '226_20'.$input_suffix, 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

@overwrite