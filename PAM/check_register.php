<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016/5/28
 * Time: 15:35
 */
require_once("common/db.php");
$conn = db_connect();
$email = isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '';
$check1 ="select * from buyer where `email`= '".$email."'";
$set1 = mysqli_query($conn,$check1,MYSQLI_STORE_RESULT);
$result1=mysqli_fetch_array($set1,MYSQLI_ASSOC);
$check2 ="select * from `seller` where `email`= '".$email."'";
$set2 = mysqli_query($conn,$check2,MYSQLI_STORE_RESULT);
$result2=mysqli_fetch_array($set2,MYSQLI_ASSOC);
if($result1 || $result2)
{
    echo 'fail';
}
else{
    echo 'success';
}