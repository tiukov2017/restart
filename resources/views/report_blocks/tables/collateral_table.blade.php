<div class="collateral containerField">
    <label for="collateral_table_title{{$input_suffix}}" class="fieldLabel">שעבודים ומשכונים</label>
    <div class="row strech">

        <div class="col-xs-9">
            <input type="text" class="stakeholders-table-title user-input" name="collateral_table{{$input_suffix}}" id="collateral_table_title{{$input_suffix}}" double-check="true">
        </div>

        <div class="col-xs-3">
            @include('fields.status_icon',['id'=>'collateral_table'.$input_suffix])
        </div>

    </div>
    @include('fields.table_field',[
    'table_title' => '',
    'table_heads' => ['תאריך רישום','תאריך הסילוק','פרטי הנושה'],
     'table_fields' =>[
    [ 'label' => 'תאריך', 'name' => '269_25', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ],
    [ 'label' => 'כתובת', 'name' => '270_25', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ],
    [ 'label' => 'מקור', 'name' => '271_25', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => TRUE, 'value' => '' ],
    ]
    ])

</div>
