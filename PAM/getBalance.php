<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016/6/3
 * Time: 18:33
 */
header("Content-Type: text/plain;charset=utf-8");
require_once('common/db.php');
require_once "../common/email.class.php";
session_start();
$email =$_SESSION['email'];
$userType = $_SESSION['userType'];
$conn = db_connect();
if($userType === 'buyer'){
    $check1 ="select * from `buyer` where `email`= '".$email."'";
    $set1 = mysqli_query($conn,$check1,MYSQLI_STORE_RESULT);
    $result1=mysqli_fetch_array($set1,MYSQLI_ASSOC);
    echo $result1['password'];
}
else if($userType === 'seller') {
    $check2 ="select * from `seller` where `email`= '".$email."'";
    $set2 = mysqli_query($conn,$check2,MYSQLI_STORE_RESULT);
    $result2=mysqli_fetch_array($set2,MYSQLI_ASSOC);
    echo $result2['balance'];
}
