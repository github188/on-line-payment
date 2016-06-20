<html>
<head>
   <title>查询</title>
   <link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
   <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
   <script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<?php
    include("../../common/head.html");
    include("../../common/time-picker.html");
    include("../../common/title.html");
    include("../../common/header_login.html");
?>
</body>
</html>

<?php
	header("Content-Type: text/html; charset=utf-8");
	//require_once("config.php");
	//require_once("db.php");
	//session_start();
	//$userType=$_SESSION['userType'];
	//$uid=$_SESSION['uid'];
	$oid=$_POST['order'];
	$pw=$_POST['password'];
	$host="localhost";
	$user="root";
	$pwd="";
	$db_name="payment";
	$conn=mysql_connect($host,$user,$pwd) or dei("连接数据库服务器失败。".mysql_error());
	mysql_select_db($db_name,$conn) or die("链接数据库失败。".mysql_error());
		if(!$conn)
		{
			die('could not connect:'.mysqli_error($conn));
		}
		mysql_query("set character set 'utf8' ");
		mysql_query("set names 'utf8' ");
		//if(isset($_SESSION['login']) && $_SESSION['login'] === true)
		//{
			//$sql="select password from buyer where b_id=$uid and password=$pw";
			//if(!mysql_query($sql))
				//echo "<script> alert(\"密码错误！请重新输入密码！\");window.history.back(-1);</script>";
			
			$sql="select price,seller_id,buyer_id,state from order where o_id=$oid";
			//$sql="select price,seller_id,buyer_id,state from order where o_id=$oid and buyer_id==$uid";
			
			$result=mysql_query($sql);
			$row=mysql_fetch_array($result);
			$price=$row['price'];
			$s_id=$row['seller_id'];
			$b_id=$row['buyer_id'];
			$state=$row['state'];

			if($state=="PAID")
				echo "<script> alert(\"该订单您已付款\");window.history.back(-1);</script>";

			$sql="update order set o_time=now() where o_id=$oid;";
			//$sql="update order set o_time=$date where o_id=$oid and buyer_id==$uid";
			if(!mysql_query($sql))
				echo "<script> alert(\"支付日期更新失败\");window.history.back(-1);</script>";

			$sql2="select balance from buyer where b_id=$uid and balance> $price";
			if(!mysql_query($sql2))
				echo "<script> alert(账户余额不足);window.history.back(-1);</script>";

			$sql1="update order set state=\"PAID\"where o_id=$oid and buyer_id=$b_id";
			if(!mysql_query($sql1))
				echo "<script> alert(\"订单状态修改失败\");window.history.back(-1);</script>";

			$sql3="update buyer set balance=balance-$price where b_id=$b_id";
			if(!mysql_query($sql3))
				echo "<script> alert(\"买家账户扣去金额失败\");window.history.back(-1);</script>";

			$sql4="update seller set balance=balance+$price where s_id=$s_id";
			if(!mysql_query($sql4))
				echo "<script> alert(\"卖家账户增加金额失败\");window.history.back(-1);</script>";
			
			$s_account=$price;
			$b_account=-$price;
			$sql5="insert into transaction1 values(".$oid.",".$s_id.",".$b_id.",".$s_account.",".$b_account.");";
			if(!mysql_query($sql5))
				echo "<script> alert(\"交易流记录失败\");window.history.back(-1);</script>";

			echo "<script> alert(\"在线支付成功\");window.history.back(-1);</script>";
		//}
		//else echo "<script> alert(\"您还没有登陆，请先登录\");window.history.back(-1);</script>";
	?>
