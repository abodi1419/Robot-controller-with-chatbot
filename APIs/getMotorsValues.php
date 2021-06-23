<?php
include '../en/config/database.php';
$motors =  $mysql->query('select * from motors;')->fetch_all(MYSQLI_ASSOC);
echo json_encode($motors);