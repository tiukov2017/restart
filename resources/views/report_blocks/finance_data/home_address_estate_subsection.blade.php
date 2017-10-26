@extends('report_layouts.subsection')
@section("subsection_fields")

    @include('report_blocks.finance_data.home_address_estate_block',['id'=>'home_address_estate_block','attributes'=>'data-anchor=address-data'])

@overwrite