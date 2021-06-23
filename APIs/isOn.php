<?php
include '../en/config/database.php';
if($mysql->query('select is_on from settings')->fetch_assoc()['is_on']){
    echo 1;
}else{
    echo 0;
}