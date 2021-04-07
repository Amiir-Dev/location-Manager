<?php

include '../bootstrap/init.php';

if(!isAjaxRequest()){
    diePage("Invalid Request1");
}

if(insertLocation($_POST)){
    echo "محل موردنظر با موفقیت ثبت شد. منتظر تأئید نهایی باشید!";
}
else{
    echo "مشکلی در ثبت محل موردنظر پیش آمده، مجدداً تلاش کنید!";
}
