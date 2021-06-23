<?php
include '../en/config/database.php';
$motors =  $mysql->query('update settings set is_on=0;');
echo 'stopped';