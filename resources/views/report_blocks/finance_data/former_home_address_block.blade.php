@extends('report_layouts.expandable_title_fieldblock')
@section('collapse_fields')

    @include('fields.table_field',[
    'table_title' => '',
    'table_heads' => ['תאריך','כתובת','מקור','שותפים בכתובת'],
    'table_fields' =>[
    [ 'label' => 'תאריך', 'name' => '203_18', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ],
    [ 'label' => 'כתובת', 'name' => '204_18', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ],
    [ 'label' => 'מקור', 'name' => '205_18', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ],
    [ 'label' => 'שותפים בכתובת', 'name' => '206_18', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ]
        ]
    ])

    @include('fields.simple_smart_field', [ 'label' => 'הערות', 'name' => '207_18', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])


@overwrite