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
print_r($windowLocations);

// foreach ($windowLocations as $windowLoc) {
//     echo '<div>' . $windowLoc . '</div>';
// }
