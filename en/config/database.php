<?php

include '../database.php';

if($mysql->connect_error){
    die("Conecetion failed. Error ".$mysql->connect_error);
}