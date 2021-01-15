<?php
define ('GALLERY', __DIR__ . '/gallery/');
define ('CACHE', __DIR__ . '/cache/');
$gallery_folder = 'http://' . $_SERVER['HTTP_HOST'] . '/WineStyle/gallery/';
$cache_folder = 'http://' . $_SERVER['HTTP_HOST'] . '/WineStyle/cache/';
$gallery = preg_grep('~\.(jpeg|jpg|png|gif|webp|bmp)$~', scandir(GALLERY));
/*
 * По ТЗ нужно брать значения из БД, но пока оставил просто массив
 * */
$imgSize = [
    'big' => [
        'w' => 800,
        'h' => 600
    ],
    'med' => [
        'w' => 640,
        'h' => 480
    ],
    'min' => [
        'w' => 320,
        'h' => 240
    ],
    'mic' => [
        'w' => 150,
        'h' => 150
    ]
];