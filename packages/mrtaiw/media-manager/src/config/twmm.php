<?php
return [
    'middlewares' => ['web', 'auth'],
    'sizes'       => [
        'small'  => [
            'width'  => 150,
            'height' => 150,
        ],
        'medium' => [
            'width'  => 300,
            'height' => 300,
        ],
        'poster' => [
            'width'  => 300,
            'height' => 450,
        ],
        'large'  => [
            'width'  => 700,
            'height' => 700,
        ],
    ],
    'mimetypes'   => [
        'jpeg',
        'jpg',
        'png',
        'gif',
    ],
    'maxfilesize' => '10000',
];
