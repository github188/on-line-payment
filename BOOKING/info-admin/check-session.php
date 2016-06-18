<?php
     session_start();
    if(!isset($_SESSION['agent']) OR ($_SESSION['agent']!=md5($_SERVER['HTTP_USER_AGENT'])) OR !isset($_SESSION['admin'])){
        header("location: admin-info-login.php");    
    }
?>