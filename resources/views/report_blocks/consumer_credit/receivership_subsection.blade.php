@extends('report_layouts.subsection')
@section("subsection_fields")

    @include('report_blocks.consumer_credit.receivership_block',['id'=>'receivership_block','attributes'=>'data-anchor=receivership-data'])

@overwrite