@extends('report_layouts.expandable_title_fieldblock')
@section('collapse_fields')

    @include('fields.textarea_field', [ 'label' => 'הגוף המדווח', 'name' => '141_12', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.simple_field', [ 'label' => 'תאריך הדיווח', 'name' => '142_12', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.textarea_field', [ 'label' => 'גובה החוב', 'name' => '143_12', 'type' => 'number', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

@overwrite