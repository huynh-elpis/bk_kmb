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
            'code' => 'sgn',
            'rss' => 'tp-hcm-xshcm.rss'
            ],
        '12' => [
            'code' => 'dtp',
            'rss' => 'dong-thap-xsdt.rss'
        ],
        '11' => [
            'code' => 'cmu',
            'rss' => 'ca-mau-xscm.rss'
        ],
        '2' => [
            'code' => 'vtu',
            'rss' => 'vung-tau-xsvt.rss'
        ],
        '21' => [
            'code' => 'bte',
            'rss' => 'ben-tre-xsbt.rss'
        ],
        '22' => [
            'code' => 'blu',
            'rss' => 'bac-lieu-xsbl.rss'
        ],
        '3' => [
            'code' => 'dni',
            'rss' => 'dong-nai-xsdn.rss'
        ],
        '31' => [
            'code' => 'cto',
            'rss' => 'can-tho-xsct.rss'
        ],
        '32' => [
            'code' => 'stg',
            'rss' => 'soc-trang-xsst.rss'
        ],
        '4' => [
            'code' => 'tnh',
            'rss' => 'tay-ninh-xstn.rss'
        ],
        '41' => [
            'code' => 'agg',
            'rss' => 'an-giang-xsag.rss'
        ],
        '42' => [
            'code' => 'btn',
            'rss' => 'binh-thuan-xsbth.rss'
        ],
        '5' => [
            'code' => 'bdg',
            'rss' => 'binh-duong-xsbd.rss'
        ],
        '51' => [
            'code' => 'vlg',
            'rss' => 'vinh-long-xsvl.rss'
        ],
        '52' => [
            'code' => 'tvh',
            'rss' => 'tra-vinh-xstv.rss'
        ],
        '6' => [
            'code' => 'lan',
            'rss' => 'long-an-xsla.rss'
        ],
        '61' => [
            'code' => 'bpc',
            'rss' => 'binh-phuoc-xsbp.rss'
        ],
        '62' => [
            'code' => 'hgg',
            'rss' => 'hau-giang-xshg.rss'
        ],
        '7' => [
            'code' => 'tgg',
            'rss' => 'tien-giang-xstg.rss'
        ],
        '71' => [
            'code' => 'kgg',
            'rss' => 'kien-giang-xskg.rss'
        ],
        '72' => [
            'code' => 'ldg',
            'rss' => 'lam-dong-xsld.rss'
        ],
    ],
    'schedule' => [
        0 => ['7','71','72'],
        1 => ['1','12','11'],
        2 => ['2','21','22'],
        3 => ['3','31','32'],
        4 => ['4','41','42'],
        5 => ['5','51','52'],
        6 => ['1','6','61','62'],
    ],
    'rss_root' => 'http://xskt.com.vn/rss-feed/',
];