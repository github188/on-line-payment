<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016/5/28
 * Time: 14:23
 */
header("Content-Type: text/plain;charset=utf-8");
require_once('common/db.php');
require_once "../common/email.class.php";
session_start();

$key =rand(10,500);   //秘钥

$realName =$_POST['name'];
$userType = $_POST['userType'];
$email = $_POST['email'];
$ID = $_POST['identity'];
$password = $_POST['password'];
$password2 = $_POST['repassword'];
$ifsuccess=0;
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
            $insert1 ="insert into buyer values(null,'$email','$password',0,NULL ,'$email','$realName','$ID','待认证',null,null,0)";
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
                $ifsuccess=1;
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
            $insert2 ="insert into seller values(null,'$email','$password',0,'$userType',NULL ,null,'$email','$realName','$ID','待认证',null,null,0)";
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
                $ifsuccess=1;
            }
            else{
                echo "fail";
            }
        }
    }
}
if($ifsuccess==1){
    $smtpserver = "smtp.163.com";//SMTP服务器
    $smtpserverport =25;//SMTP服务器端口
    $smtpusermail = "qqq1051814353@163.com";//SMTP服务器的用户邮箱
    $smtpemailto = $email;//发送给谁
    $fromName = 'yuantu';
    $smtpuser = "qqq1051814353@163.com";//SMTP服务器的用户帐号
    $smtppass = "qqq1051814353";//密码，或者授权码
    $mailtitle = "this is test mail";//邮件主题
//    $mailcontent = "hello";//邮件内容
    $token = $uid ^ $key ;
    $key_m = $key ^ 1372;
    $mailcontent = "activate.php?Token=$token&userType=$userType&test=$key_m";//邮件内容
    $mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
    $smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
    $smtp->debug = false;//是否显示发送的调试信息，默认不发送
    $state = $smtp->sendmail($smtpemailto, $smtpusermail, $fromName, $mailtitle, $mailcontent, $mailtype);
    if($state=="")
        $error = "激活邮件发送失败，请确认你的邮箱地址！";
    else
        $error = "成功发送邮件！";
}