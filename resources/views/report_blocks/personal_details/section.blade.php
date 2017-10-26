@extends('report_layouts.section')

@section('section_content')

<div class="personal-data">

    @include('fields.simple_field', [ 'label' => 'שם פרטי ומשפחה', 'name' => '2_1', 'type' => 'text', 'search' => TRUE, 'doubleCheck'=> false, 'unique' => TRUE, 'value' => $object_fullname,'attributes'=>'keyword data-field=full-name'])

    <input type="hidden" data-field = "objectFirstName" id="first-name" value="{{$object_first_name}}"/>

    <input type="hidden" data-field="objectLastName" id="last-name" value="{{$object_last_name}}"/>

    <input type="hidden" data-field="englishFirstName" id="english_first-name" value="{{$english_first_name}}"/>

    <input type="hidden" data-field="englishLastName" id="english_last-name" value="{{$english_last_name}}"/>

    <input type="hidden" id="user-name" value="">

        @include('fields.simple_field', [ 'label' => 'תעתיקים בעברית', 'name' => '4_1', 'type' => 'hidden', 'search' => TRUE, 'doubleCheck'=> false, 'unique' => false, 'value' => '','attributes'=>'keyword' ])

        @include('fields.simple_field', [ 'label' => 'תעתיקים באנגלית', 'name' => '6_1', 'type' => 'hidden', 'search' => TRUE, 'doubleCheck'=> false, 'unique' => false, 'value' => '','attributes'=>'keyword' ])

        @include('fields.simple_field', [ 'label' => 'תעתיקים בשפה נוספת', 'name' => '8_1', 'type' => 'hidden', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

        @include('fields.simple_field', [ 'label' => 'תאריך/שנת לידה', 'name' => '9_1', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => TRUE, 'value' => '' ,'attributes'=> 'min=1910-01-01 max=2010-01-01'])

        @include('fields.simple_field', [ 'label' => 'גיל', 'name' => '13_1', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

        @include('fields.simple_field', [ 'label' => 'טלפון נייד', 'name' => '15_1', 'type' => 'text', 'search' => TRUE, 'doubleCheck'=> false, 'unique' => false, 'value' => '','attributes'=>'keyword data-field=mobile'])

        @include('fields.simple_field', [ 'label' => 'מספר ת"ז', 'name' => '10_1', 'type' => 'text', 'search' => TRUE, 'doubleCheck'=> false, 'unique' => TRUE, 'value' => $object_id,'attributes'=>'keyword data-field=objectId'])

        @include('fields.simple_field', [ 'label' => 'כתובת דוא"ל', 'name' => '17_1', 'type' => 'text', 'search' => TRUE, 'doubleCheck'=> false, 'unique' => TRUE, 'value' => '','attributes'=>'keyword data-field=email' ])

        @include('fields.simple_field', [ 'label' => 'כתובת דוא"ל נוספת', 'name' => '17_1_1', 'type' => 'text', 'search' => TRUE, 'doubleCheck'=> false, 'unique' => TRUE, 'value' =>'','attributes'=>'keyword data-field=secondary-email' ])

        @include('fields.simple_field', [ 'label' => 'תארים אקדמיים', 'name' => '22_1', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

        @include('fields.simple_field', [ 'label' => 'רישיונות והסמכות מקצועיות', 'name' => '23_1', 'type' => 'text', 'search' => TRUE, 'doubleCheck'=> false, 'unique' => false, 'value' => '','attributes'=>'keyword' ])

        @include('fields.simple_field', [ 'label' => 'מקום עבודה נוכחי', 'name' => '30_1', 'type' => 'text', 'search' => TRUE, 'doubleCheck'=> false, 'unique' => false, 'value' => '','attributes'=>'keyword' ])

        @include('fields.simple_field', [ 'label' => 'מצב משפחתי', 'name' => '24_1', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

        @include('fields.expand_button',['id'=>'personal_extra','classes' => 'no-float'])

        <div id="personal_extra" class="collapse">

        @include('fields.simple_field', [ 'label' => 'מין', 'name' => '12_1', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

        @include('fields.simple_field', [ 'label' => 'כינוי', 'name' => '3_1', 'type' => 'text', 'search' => TRUE, 'doubleCheck'=> false, 'unique' => TRUE, 'value' => '','attributes'=>'keyword data-field=nickname' ])

        @include('fields.simple_field', [ 'label' => 'שם נוסף', 'name' => '3_1_1', 'type' => 'text', 'search' => TRUE, 'doubleCheck'=> false, 'unique' => TRUE, 'value' => '','attributes'=>'keyword data-field=secondary-name' ])

        @include('fields.simple_field', [ 'label' => 'שם משפחה נוסף', 'name' => '3_1_2', 'type' => 'text', 'search' => TRUE, 'doubleCheck'=> false, 'unique' => TRUE, 'value' => '','attributes'=>'keyword' ])

        @include('fields.simple_field', [ 'label' => 'שם באנגלית', 'name' => '5_1', 'type' => 'text', 'search' => TRUE, 'doubleCheck'=> false, 'unique' => TRUE, 'value' => $english_fullname,'attributes'=>'keyword data-field=english-full-name' ])

        @include('fields.simple_field', [ 'label' => 'שם נוסף באנגלית', 'name' => '5_1_1', 'type' => 'text', 'search' => TRUE, 'doubleCheck'=> false, 'unique' => TRUE, 'value' =>'','attributes'=>'keyword data-field=secondary-english-name' ])

        @include('fields.simple_field', [ 'label' => 'שם משפחה נוסף באנגלית', 'name' => '5_1_3', 'type' => 'text', 'search' => TRUE, 'doubleCheck'=> false, 'unique' => TRUE, 'value' => '','attributes'=>'keyword' ])

        @include('fields.simple_field', [ 'label' => 'כינוי באנגלית', 'name' => '5_1_2', 'type' => 'text', 'search' => TRUE, 'doubleCheck'=> false, 'unique' => TRUE, 'value' => '','attributes'=>'keyword data-field=english-nickname' ])

        @include('fields.simple_field', [ 'label' => 'שם בשפה נוספת', 'name' => '7_1', 'type' => 'text', 'search' => TRUE, 'doubleCheck'=> false, 'unique' => false, 'value' => '','attributes'=>'keyword' ])

        @include('fields.simple_field', [ 'label' => 'טלפון קווי', 'name' => '14_1', 'type' => 'text', 'search' => TRUE, 'doubleCheck'=> false, 'unique' => TRUE, 'value' =>'','attributes'=>'keyword data-field=phone' ])

        @include('fields.simple_field', [ 'label' => 'דרכי תקשורת נוספות', 'name' => '16_1', 'classes'=>'simpleField', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => TRUE, 'value' => '','attributes'=>'keyword' ])

        @include('fields.simple_field', [ 'label' => 'מספר פקס', 'name' => '16_1_1', 'classes'=>'simpleField', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => TRUE, 'value' => '','attributes'=>'keyword' ])

        @include('fields.simple_field', [ 'label' => 'בית ספר תיכון', 'name' => '21_1', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

        @include('fields.simple_field', [ 'label' => 'עיר מקור', 'name' => '19_1', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

        @include('fields.simple_field', [ 'label' => 'כתובות קודמות', 'name' => '20_1', 'type' => 'text', 'search' => TRUE, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ,'attributes'=>'keyword'])

        @include('fields.simple_field', [ 'label' => 'מקומות עבודה קודמים', 'name' => '31_1', 'type' => 'text', 'search' => TRUE, 'doubleCheck'=> false, 'unique' => false, 'value' => '','attributes'=>'keyword' ])

        @include('fields.simple_field', [ 'label' => 'תפקידים קודמים', 'name' => '32_1', 'type' => 'text', 'search' => TRUE, 'doubleCheck'=> false, 'unique' => false, 'value' => '','attributes'=>'keyword' ])

        @include('fields.simple_field', [ 'label' => 'תחביבים ותחומי עניין', 'name' => '33_1', 'type' => 'text', 'search' => TRUE, 'doubleCheck'=> false, 'unique' => false, 'value' => '','attributes'=>'keyword' ])

        @include('fields.simple_field', [ 'label' => 'שם בן/בת הזוג', 'name' => '25_1', 'type' => 'text', 'search' => TRUE, 'doubleCheck'=> false, 'unique' => TRUE, 'value' => '','attributes'=>'keyword' ])

        @include('fields.simple_field', [ 'label' => 'מספר ת״ז בן/בת הזוג', 'name' => '26_1', 'type' => 'text', 'search' => TRUE, 'doubleCheck'=> false, 'unique' => TRUE, 'value' => '','attributes'=>'keyword' ])

        @include('fields.simple_field', [ 'label' => 'שמות ילדים', 'name' => '27_1', 'type' => 'text', 'search' => TRUE, 'doubleCheck'=> false, 'unique' => false, 'value' => '','attributes'=>'keyword' ])

        @include('fields.simple_field', [ 'label' => 'שמות הורים', 'name' => '28_1', 'type' => 'text', 'search' => TRUE, 'doubleCheck'=> false, 'unique' => false, 'value' => '','attributes'=>'keyword' ])

        @include('fields.simple_field', [ 'label' => 'שמות אחים', 'name' => '29_1', 'type' => 'text', 'search' => TRUE, 'doubleCheck'=> false, 'unique' => false, 'value' => '','attributes'=>'keyword' ])

        @include('fields.simple_field', [ 'label' => 'חשבון בנק', 'name' => '11_1', 'type' => 'text', 'search' => TRUE, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ,'attributes'=>'keyword'])

        @include('fields.simple_smart_field', [ 'label' => 'הערות', 'name' => '34_1', 'type' => 'text','classes'=>'comments-last-field', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    </div>
  <div class="address-images-container">

    @include('fields.simple_field', [ 'label' => 'כתובת המגורים', 'name' => '36_2', 'type' => 'text','classes'=>'address' ,'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ,'attributes'=>'keyword data-anchor=address-basic-data'])

    <div class="containerField simpleField">
        <div class="col-xs-12 no-padding images">
            <img src="{{asset('assets/images/map.png')}}" class="replaceAbleImage" alt="מפה">
            <img src="{{asset('assets/images/street.png')}}" class="replaceAbleImage" alt="תמונת רחוב">
        </div>
    </div>

  </div>

    @include('fields.expand_button',['id'=>'living_extra','classes' => 'no-float','expanded'=>true])

   <div class="collapse in" id="living_extra">

    @include('fields.simple_field', [ 'label' => 'שכונה', 'name' => '38_2', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => ''])

    @include('fields.simple_field', [ 'label' => 'הערכת שווי כיום', 'name' => '39_2', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.simple_field', [ 'label' => 'הערכת דמי שכירות חודשיים', 'name' => '40_2', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.simple_field', [ 'label' => 'השכלה בסביבת המגורים', 'name' => '41_2', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.simple_field', [ 'label' => 'מוצא בסביבת המגורים', 'name' => '42_2', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.simple_field', [ 'label' => 'הצבעה בבחירות האחרונות', 'name' => '43_2', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.simple_field', [ 'label' => 'עסקה אחרונה בכתובת/בסביבת המגורים', 'name' => '44_2', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])

    @include('fields.simple_smart_field', [ 'label' => 'הערות והשלמות', 'name' => '45_2', 'type' => 'text', 'search' => false, 'doubleCheck'=> false, 'unique' => false, 'value' => '' ])
</div>
    </div>
@overwrite