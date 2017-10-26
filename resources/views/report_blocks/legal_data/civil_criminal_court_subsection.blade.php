@extends('report_layouts.subsection')
@section("subsection_fields")

    @include('report_blocks.legal_data.civil_criminal_court_block',['id'=>'civil_criminal_court_block','attributes'=>'data-anchor=criminal-data'])

@overwrite