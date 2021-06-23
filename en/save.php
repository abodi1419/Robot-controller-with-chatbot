<?php
include 'config/database.php';
$post = file_get_contents('php://input');
$errors =[];
foreach (json_decode($post,true) as $motor){
    $id = mysqli_real_escape_string($mysql,$motor['id']);
    $value = mysqli_real_escape_string($mysql,$motor['value']);
    $degree = $motor['degree'];
    if($degree>=$value){
       $mysql->query("update motors set value='$value' where id='$id'");
       if($mysql->error){
           die($mysql->error);
       }
    }else{
        die('Value must be less than Degree of Rotation');
    }

}
echo 'done';