<?php

define("SITE_TITLE", "7-Map");
define ("BASE_URL", 'http://'.$_SERVER["SERVER_NAME"] . "/02-Project/7Map/");
define ("BASE_PATH", dirname(__DIR__) . "/");


const locationTypes = [
    0 => "هتل",
    1 => "مکان تاریخی",
    2 => "پارک",
    3 => "پاساژ",
    4 => "رستوران",
    5 => "شرکت",
    6 => "پمپ بنزین",
    7 => "باشگاه ورزشی",
    8 => "مدرسه",
    9 => "دانشگاه",
    10 => "ایستگاه اتوبوس"
];