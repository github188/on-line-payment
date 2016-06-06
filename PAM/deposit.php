<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016/6/3
 * Time: 17:17
 */
require_once('common/db.php');
session_start();
$email =$_SESSION['email'];
$userType = $_SESSION['userType'];
$password = $_POST['chongzhipassword'];
$money = $_POST['money'];
$conn = db_connect();
if(!empty($email) && !empty($userType) && !empty($password) && !empty($money))
{
    $userType = mysqli_escape_string($conn,$userType);
    $email = mysqli_escape_string($conn,$email);
    $password = mysqli_escape_string($conn,$password);
    $money = mysqli_escape_string($conn,$money);

    if($userType === 'buyer'){
        $check1 ="select * from `buyer` where `email`= '".$email."'";
        $set1 = mysqli_query($conn,$check1,MYSQLI_STORE_RESULT);
        $result1=mysqli_fetch_array($set1,MYSQLI_ASSOC);
        if($result1 && $result1['password']=== $password)
        {
            $update1 ="update buyer set `balance`=`balance`+ '".$money."'where `email`= '".$email."'";
            $set2=mysqli_query($conn,$update1,MYSQLI_STORE_RESULT);//执行sql语句
            if($set2)
            {
                echo "deposit success";
            }

        }
        else{
            echo "deposit fail";
        }
    }
    else if($userType === 'seller') {
        $check2 ="select * from `seller` where `email`= '".$email."'";
        $set2 = mysqli_query($conn,$check2,MYSQLI_STORE_RESULT);
        $result2=mysqli_fetch_array($set2,MYSQLI_ASSOC);
        if($result2 &&  $result2['password']=== $password)
        {
            $update2 ="update seller set `balance`=`balance`+ '".$money."'where `email`= '".$email."'";
            $set2=mysqli_query($conn,$update2,MYSQLI_STORE_RESULT);//执行sql语句
            if($set2)
            {
                echo "deposit success";
            }

        }
        else{
            echo "deposit fail";
        }
    }

}