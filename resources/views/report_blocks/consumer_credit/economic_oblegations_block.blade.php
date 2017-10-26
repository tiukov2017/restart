@extends('report_layouts.expandable_title_fieldblock')
@section('collapse_fields')

@include('fields.table_field',
[
'table_heads'  => ['רמת ההלוואה','תאריך מתן ההלוואה','תאריך פרעון ההלוואה','תדירות החזרי ההלוואה','תאריך קבלת הנתון על ההלוואה'],
'table_fields' =>
                 [['name' => '147_13', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => ''],
                  ['name' => '148_13', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ],
                  ['name' => '149_13', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => ''],
                  ['name' => '150_13', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ],
                  ['name' => '151_13', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '']],
 'table_title' => 'נתונים על הלוואוות'
])

@include('fields.table_field',
[
'table_heads'  => ['גובה מסגרת אשראי','תאריך מתן מסגרת אשראי אחרון','תאריך קבלת הנתון על מסגרת אשראי'],
'table_fields' => [['name' => '152_13', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ],
                   ['name' => '154_13', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ],
                   ['name' => '155_13', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ]],
'table_title'  => 'נתונים על מסגרות אשראי'
])
@overwrite