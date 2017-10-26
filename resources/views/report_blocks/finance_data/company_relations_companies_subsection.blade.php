@extends('report_layouts.subsection')
@section('subsection_fields')

    @include('report_blocks.finance_data.company_relations_companies_block',['id'=>'company_relations_companies_block'.$input_suffix,'attributes'=>'data-anchor=company-relations'.$input_suffix])


@overwrite