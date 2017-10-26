@extends('report_layouts.subsection')
@section("subsection_fields")

    @include('report_blocks.net_menetions.social_profile_other_fields',['title' => '','id'=>"other_profile_section",'social_icon' => asset('assets/images/other-profile.png'),'clonable'=>true,'attributes'=>'data-anchor=other-profile'])
@overwrite