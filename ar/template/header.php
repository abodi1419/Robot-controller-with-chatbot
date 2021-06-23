<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
require_once './config/app.php';


?>
<html>
<head>
    <title><?php echo 'لوحة التحكم'.' | '.$title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./template/css/bootstrap.css">
    <link href="./template/css/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <style>
        .custom-card-header {
            height: 400px;
            background-size: cover;
            background-position: center;
            cursor: pointer;
        }.bg-light-blue{
             background-color:  #0D5957;
         }
    </style>
</head>
<body dir="rtl">

<nav class="navbar navbar-expand-lg navbar-light bg-transparent">

    <a class="navbar-brand" href="#">
        <img src="../logo.png" width="150" height="70" class="d-inline-block align-top" alt="">
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">

            <li class="nav-item active">
                <a class="nav-link btn" href="index.php">
                    <span>الرئيسية</span>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link btn" href="showMotors.php">
                    <span>إدارة المحركات</span>
                </a>
            </li>
            <li class="nav-item active">
                <?php if($_SERVER['QUERY_STRING']){
                    $get='?'.$_SERVER['QUERY_STRING'];
                }else{
                    $get='';
                }?>
                <a class="nav-link btn" href="<?php echo $config['appLink'].'/en/'.basename($_SERVER["SCRIPT_FILENAME"]).$get;?>">
                    <span>EN</span>
                </a>
            </li>


        </ul>
    </div>
</nav>
<div class="container pt-3 text-center">
    <?php include 'message.php'?>


