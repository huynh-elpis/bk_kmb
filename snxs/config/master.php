<?php
/*
https://ketqua.vn/so-ket-qua   
http://ketqua.net/so-ket-qua  <-------

flow:
1. download
2. change OneController.php
$item['city'] = 1;
3. once.blade.php
@extends('import.hcm0525')
4. http://local.snxs/get/once -> "send"
5. http://local.snxs/caculate/1

*/
return [
    'city' => [
        '1' => [
            'code' => 'hcm',
            'rss' => ''
            ],
        '12' => [
            'code' => 'dt',
            'rss' => ''
        ],
        '2' => [
            'code' => 'vt',
            'rss' => ''
        ],
        '21' => [
            'code' => 'bt',
            'rss' => ''
        ],
        '3' => [
            'code' => 'dn',
            'rss' => 'dong-nai-xsdn.rss'
        ],
        '4' => [
            'code' => 'tn',
            'rss' => ''
        ],
        '5' => [
            'code' => 'bd',
            'rss' => ''
        ],
        '51' => [
            'code' => 'vl',
            'rss' => ''
        ],
        '6' => [
            'code' => 'la',
            'rss' => ''
        ],
        '0' => [
            'code' => 'tg',
            'rss' => ''
        ],
    ],
    'schedule' => [
        0 => ['0'],
        1 => ['1','12'],
        2 => ['2','21'],
        3 => ['3'],
        4 => ['4'],
        5 => ['5','51'],
        6 => ['1','6'],
    ],
    'rss_root' => 'http://xskt.com.vn/rss-feed/',
];