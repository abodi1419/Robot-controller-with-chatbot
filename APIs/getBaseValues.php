<?php
include '../database.php';
$base = $mysql->query('SELECT * FROM `base-movement`');
if($base->num_rows){
    $base = $base->fetch_all(MYSQLI_ASSOC);
    echo json_encode($base);
}else{
    echo 0;
}