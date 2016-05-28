<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016/5/28
 * Time: 14:23
 */
$realName = $_POST['name'];
$userType = $_POST['userType'];
$email = $_POST['email'];
$ID = $_POST['identity'];
$password = $_POST['password'];
$password2 = $_POST['repassword'];
$conn = db_connect();
if(!empty($realName) && !empty($userType) && !empty($email) && !empty($ID) && !empty($password) && !empty($password2)){
    $realName = mysqli_escape_string($realName);
    $userType = mysqli_escape_string($userType);
    $email = mysqli_escape_string($email);
    $ID = mysqli_escape_string($ID);
    $password = mysqli_escape_string($password);
    $password2 = mysqli_escape_string($password2);
    if($password !== $password2){
        echo "<script>alert('两次输入密码不相同！！！');location='register.html';</script>";
    }
    else if($userType === 'buyer'){
        $check1 ="select * from `buyer` where `email`= '".$email."'";
        $set1 = mysqli_query($conn,$check1,MYSQLI_STORE_RESULT);
        $result1=mysqli_fetch_array($set1,MYSQLI_ASSOC);
        if($result1)
        {
            echo "<script>alert('电子邮件已存在！！！');location='register.html';</script>";
        }
        else
        {
            $insert1 ="insert into `buyer` values('$email','$password',0,NULL ,'$email','$realName','$ID')";
            $set2=mysqli_query($conn,$insert1,MYSQLI_STORE_RESULT);//执行sql语句
            if($set2)
            {
                echo "<script>alert('增加成功!!!');location='login.html';</script>";
            }
            else{
                echo "<script>alert('增加失败!!!');location='register.html';</script>";
            }
        }
    }
    else if($userType === 'sellerHotel' || $userType === 'sellerFlight') {
        $check2 ="select * from `seller` where `email`= '".$email."'";
        $set2 = mysqli_query($conn,$check2,MYSQLI_STORE_RESULT);
        $result2=mysqli_fetch_array($set2,MYSQLI_ASSOC);
        if($result2)
        {
            echo "<script>alert('电子邮件已存在！！！');location='register.html';</script>";
        }
        else
        {
            $insert2 ="insert into `seller` values('$email','$password',0,'$userType',NULL ,NULL,'$email','$realName','$ID')";
            $set2=mysqli_query($conn,$insert1,MYSQLI_STORE_RESULT);//执行sql语句
            if($set2)
            {
                echo "<script>alert('增加成功!!!');location='login.html';</script>";
            }
            else{
                echo "<script>alert('增加失败!!!');location='register.html';</script>";
            }
        }
    }





}