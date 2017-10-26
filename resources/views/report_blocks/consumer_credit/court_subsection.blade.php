@extends('report_layouts.subsection')
@section("subsection_fields")

    @include('report_blocks.consumer_credit.court_block',['id'=>'court_block','attributes'=>'data-anchor=court-data'])

@overwrite