<?php
$csv = array_map('str_getcsv', file(__DIR__.'/fields.csv'));
foreach($csv as $row){

    $name = $row[0];
    $label = $row[1];
    $type =  $row[2];
    $options =  $row[3];
    $search =  $row[4] ? $row[4] : 'false';
    $doubleCheck = $row[5] ? $row[5] : 'false';
    $unique =  $row[6] ? $row[6] : 'false';

    if(!$name){
        continue;
    }

    if($name=='section_start'){

        echo '//<-----section start------>';
        echo '</br>';
        echo '//'. ' '. $label;
        echo '</br>';
        echo '==============================';
        continue;
    }


    if($name=='section_end'){
        echo '//<-----section end------>';
        echo '</br>';
        echo '==============================';
        continue;
    }



    if($name=='container_start'){
        echo '</br>';
        echo '///////////CONTAINER START///////';
        echo '</br>';

        echo '//'. ' '. $label;
        echo '</br>';
        echo '==============================';
        continue;
    }


    if($name=='container_end'){
        echo '</br>';
        echo '///////////CONTAINER END///////';
        echo '</br>';
        echo '==============================';
        echo '</br>';
        continue;
    }

    echo '</br>';


    echo "
            @include('fields.field', [
            'label' => '$label',
            'name' => '$name',
            'type' => '$type',
            'search' => $search,
            'doubleCheck'=> $doubleCheck,
            'unique' => $unique,
            'value'  => ''
            ])

    ";

    echo '</br>';



}