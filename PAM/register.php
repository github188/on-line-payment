<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016/5/28
 * Time: 14:23
 */
header("Content-Type: text/plain;charset=utf-8");
require_once('common/db.php');
session_start();

$realName =$_POST['name'];
$userType = $_POST['userType'];
$email = $_POST['email'];
$ID = $_POST['identity'];
$password = $_POST['password'];
$password2 = $_POST['repassword'];

$conn = db_connect();
if(!empty($realName) && !empty($userType) && !empty($email) && !empty($ID) && !empty($password) && !empty($password2))
{
    $realName = mysqli_escape_string($conn,$realName);
    $userType = mysqli_escape_string($conn,$userType);
    $email = mysqli_escape_string($conn,$email);
    $ID = mysqli_escape_string($conn,$ID);
    $password = mysqli_escape_string($conn,$password);
    $password2 = mysqli_escape_string($conn,$password2);

    if($password !== $password2){
        echo "notsame";
    }
    else if($userType === 'buyer'){
        $check1 ="select * from `buyer` where `email`= '".$email."'";
        $set1 = mysqli_query($conn,$check1,MYSQLI_STORE_RESULT);
        $result1=mysqli_fetch_array($set1,MYSQLI_ASSOC);
        if($result1)
        {
            echo "emailexist";
        }
        else
        {
            $insert1 ="insert into buyer values(null,'$email','$password',0,NULL ,'$email','$realName','$ID','待认证',null,null)";
            $set2=mysqli_query($conn,$insert1,MYSQLI_STORE_RESULT);//执行sql语句
            if($set2)
            {
                $getId = "select * from `buyer` where `email`= '".$email."'";
                $result = mysqli_query($conn, $getId);
                $row = mysqli_fetch_array($result);
                if($row){
                    $uid =  $row['b_id'];
                }
                mysqli_query($conn, "insert into IDauthReq values( $uid,'$userType','$realName','$ID',0)");
                echo "success";
            }
            else{
                echo "fail";
            }
        }
    }
    else if($userType === 'sellerHotel' || $userType === 'sellerFlight') {
        $check2 ="select * from `seller` where `email`= '".$email."'";
        $set2 = mysqli_query($conn,$check2,MYSQLI_STORE_RESULT);
        $result2=mysqli_fetch_array($set2,MYSQLI_ASSOC);
        if($result2)
        {
            echo "emailexist";
        }
        else
        {
            $insert2 ="insert into seller values(null,'$email','$password',0,'$userType',NULL ,null,'$email','$realName','$ID','待认证',null,null)";
            $set2=mysqli_query($conn,$insert2,MYSQLI_STORE_RESULT);//执行sql语句
            if($set2)
            {
                $getId = "select * from `seller` where `email`= '".$email."'";
                $result = mysqli_query($conn, $getId);
                $row = mysqli_fetch_array($result);
                if($row){
                    $uid =  $row['s_id'];
                }
                mysqli_query($conn, "insert into IDauthReq values( $uid,'$userType','$realName','$ID',0)");
                echo "success";
            }
            else{
                echo "fail";
            }
        }
    }
}