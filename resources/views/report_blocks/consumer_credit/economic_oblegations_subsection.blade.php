@extends('report_layouts.subsection')
@section("subsection_fields")
    @include('report_blocks.consumer_credit.economic_oblegations_block',['id'=>'economic_oblegations_block','attributes'=>'data-anchor=economic-oblegations-data'])

@overwrite