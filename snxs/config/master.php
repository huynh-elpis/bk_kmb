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

$masterCons = [
	'city' => [
		'1' => 'hcm',
		'12' => 'dt',
		'2' => 'vt',
		'21' => 'bt',
		'3' => 'dn',
		'4' => 'tn',
		'5' => 'bd',
		'51' => 'vl',
		'6' => 'la',
		'0' => 'tg',
	]
];
?>