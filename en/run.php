<?php
include 'config/database.php';
if($mysql->query('select is_on from settings')->fetch_assoc()['is_on']){
    $mysql->query('update settings set is_on=0');
    die('stopped');
}else{
    $mysql->query('update settings set is_on=1');
    die('done');
}