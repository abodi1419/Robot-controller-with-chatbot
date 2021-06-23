<?php
include 'config/database.php';
$motors =  $mysql->query('select * from motors;')->fetch_all(MYSQLI_ASSOC);