<?php

include '../database.php';
if($mysql->connect_error){
    die("فشل الاتصال. خطأ ".$mysql->connect_error);
}