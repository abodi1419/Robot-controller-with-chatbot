<?php
include '../database.php';
if($mysql->query('SELECT * FROM `base-movement` where value=1')->num_rows){
    echo 1;
}else{
    echo 0;
}