<?php

include '../bootstrap/init.php';

if (!isAjaxRequest()) {
    diePage("Invalid Request!");
}

$n = $_POST['wn'];
$s = $_POST['ws'];
$e = $_POST['we'];
$w = $_POST['ww'];

$windowLocations = getWindowLocations($n, $s, $e, $w);
// echo gettype($windowLocations);
// header('Content-Type: application/json');
echo json_encode($windowLocations);
