<?php

$connection = [
    'host' => 'localhost',
    'user' => 'smart-methods',
    'password' => 'QxtfX4Z3gK8HLKb0',
    'database' => 'smart-methods'
];

$mysql = new mysqli($connection['host'],$connection['user'],$connection['password'],$connection['database']);

if($mysql->connect_error){
    die("Conecetion failed. Error ".$mysql->connect_error);
}