<?php
return [
    'middlewares' => ['web', 'auth'],
    'sizes'       => [
        'thumbnail'    => [
            'width'  => 330,
            'height' => 330,
        ]
    ],
    'mimetypes'   => [
        'jpeg',
        'jpg',
        'png',
        'gif',
        'mp4',
        'webm',
        'ogv',
    ],
    'maxfilesize' => '1000000',
    'videotypes'   => [
        'mp4',
        'webm',
        'ogv',
    ],
    'maxvideosize' => '100000000',
];
