<?php
session_start();

if(isset($_SESSION['is_logged'])){
    $_SESSION = [];
    $_SESSION['success_message'] = "You are logged out, see you later";
    header("location: ../index.php");
    die();

}