@extends('report_layouts.section')

@section('section_content')

@include('report_blocks.consumer_credit.cheuqes_subsection',['label'=> 'התראות על שיקים חוזרים או הליכים לגביית חוב'])

@include('report_blocks.consumer_credit.limited_bank_accounts_subsection',['label'=> 'חשבונות בנק מוגבלים'])

@include('report_blocks.consumer_credit.execution_office_subsection',['label'=> 'הליכים בהוצאה לפועל'])

@include('report_blocks.consumer_credit.receivership_subsection',['label'=> 'הליכי כינוס נכסים'])

@include('report_blocks.consumer_credit.court_subsection',['label'=> 'הגבלות משפטיות'])

@include('report_blocks.consumer_credit.formal_data_subsection',['label'=> 'נתונים ממקורות רישמיים'])


@include('report_blocks.consumer_credit.economic_oblegations_subsection',['label'=> 'מידע על עמידה בהתחייבות כלכלית'])


@overwrite