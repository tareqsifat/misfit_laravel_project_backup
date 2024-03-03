<?php

return [
    'mode'                  => 'utf-8',
    'format'                => 'A4',
    'author'                => '',
    'subject'               => '',
    'keywords'              => '',
    'creator'               => 'AIB',
    'display_mode'          => 'fullpage',
    'tempDir'               => base_path('../temp/'),
    'pdf_a'                 => false,
    'pdf_a_auto'            => false,
    'icc_profile_path'      => '',
    'font_path' => public_path('frontend/assets/fonts'),
    'font_data' => [
        'roboto' => [
            'R'  => 'Roboto-Regular.ttf',    // regular font
            // 'B'  => 'ExampleFont-Bold.ttf',       // optional: bold font
            // 'I'  => 'ExampleFont-Italic.ttf',     // optional: italic font
            // 'BI' => 'ExampleFont-Bold-Italic.ttf' // optional: bold-italic font
            //'useOTL' => 0xFF,    // required for complicated langs like Persian, Arabic and Chinese
            //'useKashida' => 75,  // required for complicated langs like Persian, Arabic and Chinese
        ],
        'tirobangla' => [
            'R'  => 'TiroBangla-Regular.ttf',    // bangla font
        ],
        'solaimanlipi' => [
            'R'  => 'SolaimanLipi.ttf',    // bangla font
            'useOTL' => 0xFF,
            'useKashida' => 75,
        ],
    ]
];
