<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'The :attribute must be accepted.',
    'active_url'           => 'The :attribute is not a valid URL.',
    'after'                => 'The :attribute must be a date after :date.',
    'alpha'                => 'The :attribute may only contain letters.',
    'alpha_dash'           => 'The :attribute may only contain letters, numbers, and dashes.',
    'alpha_num'            => 'The :attribute may only contain letters and numbers.',
    'array'                => 'The :attribute must be an array.',
    'before'               => 'The :attribute must be a date before :date.',
    'between'              => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file'    => 'The :attribute must be between :min and :max kilobytes.',
        'string'  => 'The :attribute must be between :min and :max characters.',
        'array'   => 'The :attribute must have between :min and :max items.',
    ],
    'boolean'              => 'The :attribute field must be true or false.',
    'confirmed'            => 'The :attribute confirmation does not match.',
    'date'                 => 'The :attribute is not a valid date.',
    'date_format'          => 'The :attribute does not match the format :format.',
    'different'            => 'The :attribute and :other must be different.',
    'digits'               => 'The :attribute must be :digits digits.',
    'digits_between'       => 'The :attribute must be between :min and :max digits.',
    'email'                => 'שדה :attribute חייב להיות חוקי',
    'exists'               => 'The selected :attribute is invalid.',
    'filled'               => 'The :attribute field is required.',
    'image'                => 'The :attribute must be an image.',
    'in'                   => 'The selected :attribute is invalid.',
    'integer'              => 'The :attribute must be an integer.',
    'ip'                   => 'שדה :attribute חייב להיות כתובת IP חוקית',
    'json'                 => 'The :attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => 'שדה :attribute חייב להיות באורך מקסימלי של :min תויים',
        'file'    => 'שדה :attribute חייב להכיל יותר מ :max קילובייט.',
        'string'  => 'שדה :attribute חייב להיות באורך מקסימלי של :min תויים',
        'array'   => 'The :attribute may not have more than :max items.',
    ],
    'mimes'                => 'על הקובץ להיות אחד מהפורמטים הבאים: :values.',
    'min'                  => [
        'numeric' => 'שדה :attribute חייב להיות באורך מינימלי של :min תויים',
        'file'    => 'The :attribute must be at least :min kilobytes.',
        'string'  => 'שדה :attribute חייב להיות באורך מינימלי של :min תויים',
        'array'   => 'The :attribute must have at least :min items.',
    ],
    'not_in'               => 'The selected :attribute is invalid.',
    'numeric'              => 'The :attribute must be a number.',
    'present'              => 'The :attribute field must be present.',
    'regex'                => 'פורמט ה:attribute לא נכון',
    'required'             => 'שדה :attribute הוא שדה חובה',
    'required_if'          => 'The :attribute field is required when :other is :value.',
    'required_unless'      => 'The :attribute field is required unless :other is in :values.',
    'required_with'        => 'The :attribute field is required when :values is present.',
    'required_with_all'    => 'The :attribute field is required when :values is present.',
    'required_without'     => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same'                 => 'The :attribute and :other must match.',
    'size'                 => [
        'numeric' => 'שדה :attribute חייב להיות בגודל :size לפחות',
        'file'    => 'The :attribute must be :size kilobytes.',
        'string'  => 'שדה :attribute חייב להיות בגודל :size לפחות',
        'array'   => 'The :attribute must contain :size items.',
    ],
    'string'               => 'שדה :attribute חייב להיות מסוג מחרוזת',
    'timezone'             => 'The :attribute must be a valid zone.',
    'unique'               => 'שדה :attribute כבר קיים',
    'url'                  => 'שדה :attribute לא חוקי',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'password'=>'סיסמא',
         'email'=>'דוא"ל',


    ],

];
