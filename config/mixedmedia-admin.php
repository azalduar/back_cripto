<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Configuracion para las migraciones de laravel generadas por el admin
    |--------------------------------------------------------------------------
    */

    'migration' => [

        /*
        |--------------------------------------------------------------------------
        | Available Column Types
        |--------------------------------------------------------------------------
        |
        | Se establecen cuales de los tipos de datos establecidos en la 
        | documentacion de laravel se aceptaran.
        |
        */

        'column_types' => [
            [ 'value' => '',                    'text'=> 'Seleccionar uno'],
            [ 'value' => 'integer',             'text'=> 'Integer'],
            [ 'value' => 'bigInteger',          'text'=> 'Big Integer'],
            [ 'value' => 'unsignedInteger',     'text'=> 'Unsigned Integer'],
            [ 'value' => 'unsignedBigInteger',  'text'=> 'Unsigned Big Integer'],
            [ 'value' => 'date',                'text'=> 'Date'],
            [ 'value' => 'dateTime',            'text'=> 'DateTime'],
            [ 'value' => 'time',                'text'=> 'Time'],
            [ 'value' => 'string',              'text'=> 'String'],
            [ 'value' => 'text',                'text'=> 'Text'],
            [ 'value' => 'json',                'text'=> 'Json']
        ],

        /*
        |--------------------------------------------------------------------------
        | Available Column Modifiers
        |--------------------------------------------------------------------------
        |
        | Se establecen cuales de los tipos de datos que se encuentran en la 
        | documentacion de laravel se aceptaran.
        |
        */

        'column_modifiers' => [

            'unique' => 'Unique',
            'nullable' => 'Nullable',           
        ]

    ],

    /*
    |--------------------------------------------------------------------------
    | Configuracion los componentes html usados en las vistas
    |--------------------------------------------------------------------------
    */

    'html_components'=>[
        ['value' => ''                ,   'text'=> 'Seleccionar uno'],
        ['value' => 'date_picker'     ,   'text'=> 'Date Picker'],
        ['value' => 'images_upload'   ,   'text'=> 'Galery'],
        ['value' => 'image_upload'    ,   'text'=> 'Image'],
        ['value' => 'input_email'     ,   'text'=> 'Input Email'],
        ['value' => 'input_file'      ,   'text'=> 'Input File'],
        ['value' => 'input_number'    ,   'text'=> 'Input Number'],
        ['value' => 'input_range'     ,   'text'=> 'Input Range'],
        ['value' => 'input_text'      ,   'text'=> 'Input Text'],
        ['value' => 'select_simple'   ,   'text'=> 'Select Simple'],
        ['value' => 'select_multi' ,   'text'=> 'Select Multiple'],
        ['value' => 'sortable_list'   ,   'text'=> 'Sortable List'],
        ['value' => 'textarea'        ,   'text'=> 'Text Area'],
        ['value' => 'text_editor'     ,   'text'=> 'Text Editor']

    ],

    /*
    |--------------------------------------------------------------------------
    | Configuracion para los modelos eloquent generados por el admin
    |--------------------------------------------------------------------------
    */

    'model'=>[
        'relationships'=>[
            ['value' => ''                ,  'text'=> 'Seleccionar uno'],
            ['value' => 'belongsTo'       ,  'text'=> 'Belongs To'],
            ['value' => 'belongsToMany'   ,  'text'=> 'Belongs To Many'],
            ['value' => 'hasOne'          ,  'text'=> 'Has One'],
            ['value' => 'hasMany'         ,  'text'=> 'Has Many'],
            ['value' => 'hasManyThrough'  ,  'text'=> 'Has Many Through']
        ]
    ],

    'web_components'=>[
        'img-grid-np'=>'Galeria Sin Padding',
        'img-grid-p'=>'Galeria Con Padding',
        'img-full-with'=>'Imagen Full With',
        'slide'=>'Slide',
        'txt-col-2'=>'Texto A Dos Colomnas',
        'video'=>'Video'
    ],

    'sections'=>[
        ['name'=>'About', 'base_url'=>'about'],
        ['name'=>'All Works', 'base_url'=>'all_works'],
        ['name'=>'Staff', 'base_url'=>'empleado'],
        ['name'=>'Proyectos', 'base_url'=>'proyecto']
    ]


    

];