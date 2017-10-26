@extends('report_layouts.expandable_title_fieldblock')
@section('collapse_fields')
 
    @include('fields.textarea_field', [ 'label' => 'מספר גוש, חלקה, תת חלקה', 'name' => '178_16', 'type' => 'number', 'search' => false, 'doubleCheck'=> TRUE, 'unique' => false, 'value' => '' ])

    @include('fields.textarea_field', [ 'label' => 'שנת יצירת שטר התחייבות', 'name' => '179_16', 'type' => 'number', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.textarea_field', [ 'label' => 'שנת רישום זכויות ותחילת החכירה', 'name' => '180_16', 'type' => 'number', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.textarea_field', [ 'label' => 'מצב רישום', 'name' => '181_16', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.textarea_field', [ 'label' => 'שטח', 'name' => '182_16', 'type' => 'number', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.simple_smart_field', [ 'label' => 'בעלויות על הנכס', 'name' => '183_16', 'type' => 'text', 'search' => false, 'doubleCheck'=> TRUE, 'unique' => false, 'value' => '' ])

    @include('fields.simple_smart_field', [ 'label' => 'בעלי זכויות בנכס', 'name' => '184_16', 'type' => 'text', 'search' => false, 'doubleCheck'=> TRUE, 'unique' => false, 'value' => '' ])

    @include('fields.simple_smart_field', [ 'label' => 'מהות הזכויות בנכס', 'name' => '185_16', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.simple_smart_field', [ 'label' => 'חכירות', 'name' => '186_16', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.textarea_field', [ 'label' => 'משכנתאות', 'name' => '187_16', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.simple_smart_field', [ 'label' => 'ערב/ים לעסקה', 'name' => '188_16', 'type' => '', 'search' => false, 'doubleCheck'=> TRUE, 'unique' => false, 'value' => '' ])

    @include('fields.simple_smart_field', [ 'label' => 'שעבודים ועיקולים על הנכס', 'name' => '189_16', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.simple_smart_field', [ 'label' => 'הערות', 'name' => '190_16', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

@overwrite