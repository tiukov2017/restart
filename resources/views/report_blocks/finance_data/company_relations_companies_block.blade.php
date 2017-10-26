@extends('report_layouts.expandable_title_fieldblock')
@section('collapse_fields')
    <table class="table companies-table ">
        <thead>
        <tr>
            <th>
                שם החברה
            </th>
            <th>
                מספר ח"פ
            </th>
            <th>
                זיקה
            </th>
            <th>

            </th>
        </tr>
        </thead>
        <tbody class="company-rows">
        <tr>

            @include('fields.table_cell_input_field',['name' => '236_22'.$input_suffix, 'type' => 'text', 'search' => false, 'doubleCheck'=> TRUE, 'unique' => false, 'value' => ''])

            @include('fields.table_cell_input_field',['name' => '237_22'.$input_suffix, 'type' => 'text', 'search' => false, 'doubleCheck'=> TRUE, 'unique' => false, 'value' => ''])

            @include('fields.table_cell_input_field',['name' => '238_22'.$input_suffix, 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => ''])

            <td class="align-center">
                @include('fields.expand_button',['id'=>'related_companies_block'.$input_suffix])
                @include('fields.add_remove_buttons',['target'=>'.company-rows','scroll'=>true])
            </td>
        </tr>



        <tr class=" collapseAbleFieldBlock expandable_title_fieldblock collapse" id="related_companies_block{{$input_suffix}}">


            <td colspan="4">
               <div class="containerField">


                <label class="fieldLabel">בעלי עניין</label>

                @include('report_blocks.tables.stakeholders_table',['input_suffix'=>$input_suffix,'id'=>$id])

               </div>


                @include('fields.simple_smart_field', [ 'label' => 'שם באנגלית', 'name' => '246_24'.$input_suffix, 'type' => 'text', 'search' => false, 'doubleCheck'=> TRUE, 'unique' => false, 'value' => '','attributes'=>'data-anchor=company-data'.$input_suffix ])

                @include('fields.textarea_field', [ 'label' => 'נתונים ברשות המיסים', 'name' => '240_23'.$input_suffix, 'type' => '', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ,'attributes'=>'data-anchor=company-relatives'])

                @include('fields.textarea_field', [ 'label' => 'סוג ענף', 'name' => '242_23'.$input_suffix, 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

                @include('fields.textarea_field', [ 'label' => 'מספר ענף', 'name' => '243_23'.$input_suffix, 'type' => 'number', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

                @include('fields.simple_smart_field', [ 'label' => 'פרטים על חברה קשורה', 'name' => '239'.$input_suffix, 'type' => '', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

                @include('fields.textarea_field', [ 'label' => 'מספר חברה', 'name' => '248_24'.$input_suffix, 'type' => 'number', 'search' => false, 'doubleCheck'=> TRUE, 'unique' => false, 'value' => '' ])

                @include('fields.textarea_field', [ 'label' => 'כתובת', 'name' => '249_24'.$input_suffix, 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

                @include('fields.textarea_field', [ 'label' => 'מטרה', 'name' => '253_24'.$input_suffix, 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

                @include('fields.textarea_field', [ 'label' => 'מספר מועסקים', 'name' => '254_24'.$input_suffix, 'type' => 'number', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

                @include('fields.simple_field', [ 'label' => 'תאריך רישום', 'name' => '250_24'.$input_suffix, 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

                @include('fields.textarea_field', [ 'label' => 'סטאטוס חברה', 'name' => '251_24'.$input_suffix, 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

                @include('fields.textarea_field', [ 'label' => 'סה"כ חובות', 'name' => '252_24'.$input_suffix, 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

                @include('fields.simple_smart_field', [ 'label' => 'קישור לאתר ברשת', 'name' => '257_24'.$input_suffix, 'type' => '', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

                @include('fields.simple_smart_field', [ 'label' => 'שם קודם', 'name' => '274_25'.$input_suffix, 'type' => 'text', 'search' => false, 'doubleCheck'=> TRUE, 'unique' => false, 'value' => '' ])

                @include('fields.simple_smart_field', [ 'label' => 'שינויים בתקנון', 'name' => '275_25'.$input_suffix, 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

                @include('fields.simple_smart_field', [ 'label' => 'חשבונות בנק מוגבלים', 'name' => '276_26'.$input_suffix, 'type' => '', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '','attributes'=>'data-anchor=company-limited_bank_accounts' ])

                @include('fields.simple_smart_field', [ 'label' => 'דוח התרעות', 'name' => '282_27'.$input_suffix, 'type' => '', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '','attributes'=>'data-anchor=allerts-report' ])

                @include('fields.simple_smart_field', [ 'label' => 'דוח הצלבות', 'name' => '28244_27'.$input_suffix, 'type' => '', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '','attributes'=>'data-anchor=cross-report' ])

                @include('report_blocks.tables.collateral_table',['input_suffix'=>$input_suffix])

            </td>
        </tr>

        </tbody>
    </table>
    @include('fields.simple_smart_field', [ 'label' => 'הערות', 'name' => '226111_25'.$input_suffix, 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

@overwrite