@extends('report_layouts.subsection')
@section('subsection_fields')

    @include('report_blocks.finance_data.company_relations_vat_block',['id'=>'company_relations_vat_block'.$input_suffix,'attributes'=>'data-anchor=company_relations_vat'.$input_suffix])

@overwrite