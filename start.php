<?php
include_once('./index.php');
use Index\Realization;

$urls = 'http://localhost/test2/index.html';
$preg_much_string = '(\<(/?[^>]+)>)';
$obj = new Realization($urls,$preg_much_string);