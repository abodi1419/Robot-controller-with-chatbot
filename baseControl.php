<?php
if(isset($_GET)){
    if(!isset($_GET['name']) || !isset($_GET['value'])){
        die('Missing parameters!');
    }
    include 'database.php';
    $name = mysqli_real_escape_string($mysql,$_GET['name']);
    $value = mysqli_real_escape_string($mysql,$_GET['value']);
    $mysql->query("update `base-movement` set value='$value' where name='$name'");
    if(!$mysql->error){
        echo 'done';
    }else{
        echo $mysql->error;
    }
}