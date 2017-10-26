<table class="table stakeholders-table">
    <thead>
    <tr>
        <th>
            שם מלא
        </th>
        <th>
            כתובת
        </th>
        <th>
            ת"ז
        </th>
        <th>
            זיקה
        </th>
        <th>

        </th>

    </tr>
    </thead>
    <tbody class="clonable-table">
    <tr>

        @include('fields.table_cell_input_field',['name' => '2611_25'.$input_suffix, 'type' => 'text', 'search' => false, 'doubleCheck'=> TRUE, 'unique' => false, 'value' => '','attributes'=>'data-anchor=stackholders'.$input_suffix])

        @include('fields.table_cell_input_field',['name' => '2612_25'.$input_suffix, 'type' => 'text', 'search' => false, 'doubleCheck'=> TRUE, 'unique' => false, 'value' => ''])

        @include('fields.table_cell_input_field',['name' =>  '2613_25'.$input_suffix, 'type' => 'text', 'search' => false, 'doubleCheck'=> TRUE, 'unique' => false, 'value' => ''])

        @include('fields.table_cell_input_field',['name' =>  '262_25'.$input_suffix, 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => ''])


        <td class="align-center">
            @include('fields.expand_button',['id'=>'stakeholders'.$input_suffix])
            @include('fields.add_remove_buttons',['target'=>'.clonable-table','scroll'=>true])
        </td>
    </tr>
    <tr  class="collapseAbleFieldBlock expandable_title_fieldblock collapse" id="stakeholders{{$input_suffix}}">
        <td colspan="5">
            @include('fields.simple_field', [ 'label' => 'אחוז אחזקה', 'name' => '2777_25'.$input_suffix, 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])
            @include('fields.simple_field', [ 'label' => 'תאריך מינוי', 'name' => '263_25'.$input_suffix, 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

          <div class="containerField">
              <label class="fieldLabel">קשר לחברות נוספות</label>

              <div class="">
                  <input  type="text" class="stakeholders-table-title user-input"  name="collateral_table{{$input_suffix}}" id="related_companies{{$input_suffix}}" double-check="true">
              </div>
          </div>

           <div class="containerField">
               @include('fields.table_field',[
                        'table_title' => '',
                        'table_heads' => ['שם החברה','מספר ח"פ','הזיקה'],
                        'table_fields' =>[
                        [ 'label' => 'שם החברה', 'name' => '2655_25', 'type' => 'text', 'search' => false, 'doubleCheck'=> TRUE, 'unique' => false, 'value' => '' ],
                        [ 'label' => 'מספר ח"פ', 'name' => '2656_25', 'type' => 'text', 'search' => false, 'doubleCheck'=> TRUE, 'unique' => false, 'value' => '' ],
                        [ 'label' => 'הזיקה', 'name' => '2657_25', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ],
                        ]])
           </div>

            @include('fields.simple_smart_field', [ 'label' => 'הערות', 'name' => '26571_25'.$input_suffix, 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

        </td>
    </tr>

    </tbody>

</table>