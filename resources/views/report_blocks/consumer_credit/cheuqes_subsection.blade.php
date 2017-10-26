@extends('report_layouts.subsection')
@section("subsection_fields")

    @include('report_blocks.consumer_credit.cheque_alert_block',['id'=>'chequesSection','attributes'=>'data-anchor=financial-data'])

@overwrite