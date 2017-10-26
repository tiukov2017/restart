@extends('report_layouts.subsection')
@section("subsection_fields")

@include('report_blocks.net_menetions.linkdin_fields',['title' => 'ישראל ישראלי','attributes'=>'data-anchor=linkedin-profile','id'=>"linkden_section",'social_icon' => asset('assets/images/linkedin_icon.png')])


@overwrite