<?php
include 'config/database.php';
if(isset($_GET['id'])){
    $id = mysqli_real_escape_string($mysql,$_GET['id']);
    $mysql->query("delete from motors where id='$id'");
    echo "<script>location.href='showMotors.php'</script>";
}else{
    die("Missing parameter!");
}