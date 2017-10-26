@extends('report_layouts.expandable_title_fieldblock')
@section('collapse_fields')

    @include('fields.simple_field', [ 'label' => 'שם/ות בעל/י התיק', 'name' => '229_21'.$input_suffix, 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.simple_field', [ 'label' => 'סוג ענף', 'name' => '230_21'.$input_suffix, 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.simple_field', [ 'label' => 'מספר ענף', 'name' => '231_21'.$input_suffix, 'type' => 'number', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.simple_field', [ 'label' => 'אישורי ניכוי מס במקור וניהול ספרים', 'name' => '232_21'.$input_suffix, 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.simple_smart_field', [ 'label' => 'הערות', 'name' => '233_21'.$input_suffix, 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

@overwrite