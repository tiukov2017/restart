
@if(!empty($table_title))
    <h3>{{$table_title}}</h3>
    @endif
<table class="table">
    <thead>
    <tr>
        @foreach ($table_heads as $head)
        <th>{{$head}}</th>
            @endforeach
        <th class="view-mode-invisible">
        </th>
    </tr>
    </thead>
    <tbody>
    <tr class="table-data-row">
    @foreach ($table_fields as $field)
        @if($field['type']!="text")
            <td class="align-center table-cell-input">
                @include('fields.no_label_input', [
                 'name' => $field['name'],
                 'type' => $field['type'],
                 'search' => $field['search'],
                 'doubleCheck'=> $field['doubleCheck'],
                 'unique' => $field['unique'],
                 'value' => '' ])
            </td>
        @else
            <td class="align-center table-cell-input">
                @include('fields.editable_field', [
                 'name' => $field['name'],
                 'type' => $field['type'],
                 'search' => $field['search'],
                 'doubleCheck'=> $field['doubleCheck'],
                 'unique' => $field['unique'],
                 'value' => '' ])
            </td>
        @endif
@endforeach
        @if(isset($expandable) && $expandable)
            <td class="view-mode-invisible">
                @include('fields.expand_button',['id'=> $expandId.$input_suffix])
            </td>
            @endif
        <td class="view-mode-invisible">
            @include('fields.add_remove_buttons',['target'=>'.table-data-row','scroll'=>false])
        </td>
    </tr>

    </tbody>
    </table>

