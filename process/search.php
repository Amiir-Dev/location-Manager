<?php

include '../bootstrap/init.php';

if (!isAjaxRequest()) {
    diePage("Invalid Request!");
}


$keyword = $_POST['keyword'];
if (!isset($keyword) or empty($keyword)) {
    die("نتیجه ای یافت نشد!");
}

$locations = getLocations(['keyword' => $keyword]);

if (!sizeof($locations)) {
    die("نتیجه ای یافت نشد!");
}

foreach ($locations as $loc) {
    echo "<a href='" . BASE_URL . "?loc=$loc->id'><div class='result-item' data-lat='$loc->lat' data-lng='$loc->lng'>
            <span class='loc-type'>" . locationTypes[$loc->type] . "</span>
            <span class='loc-title'>$loc->title</span>
            </div></a>";
}
