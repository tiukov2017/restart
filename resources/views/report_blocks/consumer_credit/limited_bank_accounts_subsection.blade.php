@extends('report_layouts.subsection')
@section("subsection_fields")

    @include('report_blocks.consumer_credit.limited_bank_account_block',['id'=>'limitedBanksSection','attributes'=>'data-anchor=limited-bank-accounts'])

@overwrite