<?php
    session_start();
    if(!isset($_SESSION['agent'])){
        header("location: admin-info-login.php");
    }

    else{
        $_SESSION=array();
        session_destroy();
        setcookie("PHPSESSID",'',time()-3600,'/','',0,0);
        header("location: admin-info-login.php");
    }
?>