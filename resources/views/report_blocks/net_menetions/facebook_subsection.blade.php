@extends('report_layouts.subsection')
@section("subsection_fields")

@include('report_blocks.net_menetions.facebook_fields',['title' => 'ישראל ישראלי','id'=>"fb_section",'social_icon' => asset('assets/images/facebook_icon.png'),'attributes'=>'data-anchor=facebook-profile'])


@overwrite