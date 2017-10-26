@extends('report_layouts.expandable_title_fieldblock')
@section('collapse_fields')

    @include('fields.simple_field', [ 'label' => 'תאריך רישום', 'name' => '195_17', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.textarea_field', [ 'label' => 'סטאטוס משכון', 'name' => '196_17', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.textarea_field', [ 'label' => 'נושה ', 'name' => '197_17', 'type' => 'text', 'search' => false, 'doubleCheck'=> TRUE, 'unique' => false, 'value' => '' ])

    @include('fields.textarea_field', [ 'label' => 'חייב/ים', 'name' => '198_17', 'type' => 'text', 'search' => false, 'doubleCheck'=> TRUE, 'unique' => false, 'value' => '' ])

    @include('fields.textarea_field', [ 'label' => 'ערב', 'name' => '199_17', 'type' => 'text', 'search' => false, 'doubleCheck'=> TRUE, 'unique' => false, 'value' => '' ])

    @include('fields.simple_smart_field', [ 'label' => 'הערות', 'name' => '200_17', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])


@overwrite