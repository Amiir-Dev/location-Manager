<?php

include '../bootstrap/init.php';

if(!isAjaxRequest()){
    diePage("Invalid Request1");
}

if(is_null($_POST['loc']) and !is_numeric($_POST['loc'])){
    echo "Invalid Location";
    die();
}

echo toggleStatus($_POST['loc']);