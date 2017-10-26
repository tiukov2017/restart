@extends('report_layouts.subsection')
@section("subsection_fields")

    @include('report_blocks.finance_data.collateral_block',['id'=>'collateral_block','attributes'=>'data-anchor=collateral-data'])

@overwrite