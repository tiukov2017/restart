@extends('report_layouts.subsection')
@section("subsection_fields")

    @include('report_blocks.net_menetions.netArticle',['id'=>'netArticles','attributes'=>'data-anchor=net-mentions'])

@overwrite