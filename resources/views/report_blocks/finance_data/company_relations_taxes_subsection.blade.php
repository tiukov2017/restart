@extends('report_layouts.subsection')
@section('subsection_fields')

    @include('report_blocks.finance_data.company_relations_taxes_block',['id'=>'company_relations_taxes_block'.$input_suffix,'attributes'=>'data-anchor=company-relations_taxes'.$input_suffix])


@overwrite