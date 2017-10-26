<td class="align-center table-cell-input">
    <div class="containerField simpleField">
        @include('fields.editable_field',
         ['name' => $name, 'type' => $type, 'search' =>$search, 'doubleCheck'=> $doubleCheck, 'unique' =>$unique, 'value' => $value,'attributes'=>$attributes ])
    </div>
</td>