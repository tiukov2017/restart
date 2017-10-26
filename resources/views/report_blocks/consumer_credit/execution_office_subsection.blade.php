@extends('report_layouts.subsection')
@section("subsection_fields")

    @include('report_blocks.consumer_credit.execution_office_procedure_block',['id'=>'execution_office_subsection','attributes'=>'data-anchor=execution-office-data'])

@overwrite