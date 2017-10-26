@extends('report_layouts.section')

@section('section_content')

@include('report_blocks.legal_data.civil_criminal_court_subsection',['label'=> 'הליכים פליליים ואזרחיים'])

@include('report_blocks.legal_data.legal_documents_subsection',['label'=> 'מסמכים משפטיים
ממקורות
וגורמים רשמיים'])


@overwrite