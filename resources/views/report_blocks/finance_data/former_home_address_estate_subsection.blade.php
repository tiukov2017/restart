@extends('report_layouts.subsection')
@section("subsection_fields")

    @include('report_blocks.finance_data.former_home_address_block',['id'=>'former_home_address_block','attributes'=>'data-anchor=former_home_address','containerClasses'=>'no-border-collapse-fields no-padding'])

@overwrite