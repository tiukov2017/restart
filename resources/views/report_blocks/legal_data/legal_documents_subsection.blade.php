@extends('report_layouts.subsection')
@section("subsection_fields")

    @include('report_blocks.legal_data.legal_documents_block',['id'=>'legal_documents_block','attributes'=>'data-anchor=law-documents'])

@overwrite