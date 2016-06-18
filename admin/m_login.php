<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>远途网在线预订系统管理</title>
    <meta name="description" content="远途网提供便捷快速的酒店机票服务">
    <meta name="keywords" content="酒店 机票 后台 管理">
    <meta name="author" content="软件工程基础2.3组">
</head>
</html>
<?php
session_start();
$A_ID=$_POST['username'];          //接收表单提交的用户名
$A_pwd=$_POST['password'];            //接收表单提交的密码



class check{
    var $id;
    var $pwd;

    function check($x,$y){
        $this->id=$x;
        $this->pwd=$y;
    }

    function checkinput(){
    /*改成自己的主机的localhost 数据库账号密码*/
        $mysql_url="127.0.0.1";
        $mysql_usrname="root";
        $mysql_passwd="wangjunhao7146";

        $conn=mysqli_connect($mysql_url,$mysql_usrname,$mysql_passwd,"payment") or die("connect database error".mysqli_error());
        //mysqli_select_db("library",$conn) or die("数据库访问错误".mysqli_error());
        $sql="SELECT * FROM admin WHERE a_id='$this->id'";
        $result=mysqli_query($conn,$sql);
        $rownum=mysqli_num_rows($result);
        $row=mysqli_fetch_assoc($result);


        if($row['password']!=$this->pwd){
            echo "<script language='javascript'>alert('您输入的账户有误，请重新输入！');history.back();</script>";
            exit;
        }
        else
        {
            if($row['type']==1)
            {
                //echo $row['a_id'];
                //echo $row['password'];
                $_SESSION['id'] = $row['a_id'];
                $_SESSION['pwd'] = $row['password'];
                echo "<script>alert('系统管理员登录成功!');window.location='m_maintain.html';</script>";
            }
            else if($row['type']==2)
            {
                $_SESSION['id'] = $row['a_id'];
                $_SESSION['pwd'] = $row['password'];
                echo "<script>alert('用户管理员登录成功!');window.location='u_maintain.html';</script>";
            }
            else if($row['type']==3)
            {
                $_SESSION['id'] = $row['a_id'];
                $_SESSION['pwd'] = $row['password'];
                echo "<script>alert('订单管理员登录成功!');window.location='o_maintain.html';</script>";
            }
        }
    }
}
$result =new check(trim($A_ID),trim($A_pwd));
$result->checkinput();
?>
