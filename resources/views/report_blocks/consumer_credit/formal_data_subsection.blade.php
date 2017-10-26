@extends('report_layouts.subsection')
@section("subsection_fields")

    @include('report_blocks.consumer_credit.formal_data_block',['id'=>'formal_data_block','attributes'=>'data-anchor=formal-data'])

@overwrite