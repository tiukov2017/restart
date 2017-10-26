@extends('report_layouts.section')

@section('section_content')

@include('report_blocks.net_menetions.net_subsection',['label'=> 'אזכורים מהרשת'])

@include('report_blocks.net_menetions.facebook_subsection',['label'=> 'פרופיל פייסבוק'])

@include('report_blocks.net_menetions.linkdin_subsection',['label'=> 'פרופיל לינקדאין'])

@include('report_blocks.net_menetions.social_profile_other_subsection',['label'=>'פרופיל נוסף','labeleditable'=>true])


@overwrite