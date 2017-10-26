@extends('report_layouts.section')

@section('section_content')

    @include('report_blocks.finance_data.home_address_estate_subsection',['label'=> 'הנכס בכתובת המגורים'])

    @include('report_blocks.finance_data.collateral_subsection',['label'=> 'שעבודים ומשכונים'])

    @include('report_blocks.finance_data.former_home_address_estate_subsection',['label'=> 'כתובות מגורים קודמות'])

    @include('report_blocks.finance_data.copyrights_subsection',['label'=> ' זכויות יוצרים וקניין רוחני'])


    {{--related companies subsections--}}
    @include('report_blocks.finance_data.company_relations_vat_subsection',['label'=> 'פרטי תיק במע"מ','input_suffix'=>null])
    @include('report_blocks.finance_data.company_relations_taxes_subsection',['label'=> 'פרטי תיק במס הכנסה','input_suffix'=>null])
    @include('report_blocks.finance_data.company_relations_companies_subsection',['label'=> 'פרטי חברות קשורות','input_suffix'=>null])

    {{--related companies subsections for partner --}}
    @include('report_blocks.finance_data.company_relations_vat_subsection',['label'=> 'פרטי תיק במע"מ (בן\בת זוג)','input_suffix'=>'_p'])
    @include('report_blocks.finance_data.company_relations_taxes_subsection',['label'=> 'פרטי תיק במס הכנסה (בן/בת הזוג)','input_suffix'=>'_p'])
    @include('report_blocks.finance_data.company_relations_companies_subsection',['label'=> 'פרטי חברות קשורות (בן/בת הזוג)','input_suffix'=>'_p'])




@overwrite