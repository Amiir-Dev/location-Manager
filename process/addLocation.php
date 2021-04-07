<?php

include '../bootstrap/init.php';

if(!isAjaxRequest()){
    diePage("Invalid Request1");
}

$name = $_POST['user_name'] ; 
$email = $_POST['user_email'];

if(!isset($email) or empty($email)){
    die("لطفا ایمیل خود را وارد کنید");
}
$userID = checkUserId($name, $email);

// print_r($userID);
if(insertLocation($_POST, $userID)){
    echo "محل موردنظر با موفقیت ثبت شد. منتظر تأئید نهایی باشید!";
}
else{
    echo "مشکلی در ثبت محل موردنظر پیش آمده، مجدداً تلاش کنید!";
}
