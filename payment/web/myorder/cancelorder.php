<html>
<head>
	<title>取消</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
</body>
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

			$sql="select price,seller_id,buyer_id,state,type,g_id,num,begintime from order where o_id=$oid";
			//$sql="select price,seller_id,buyer_id,state,type,g_id,num,begintime from order where o_id=$oid and buyer_id=$uid";
			$result=mysql_query($sql);
			$row=mysql_fetch_array($result);
			$state=$row['state'];
			$price=$row['price'];
			$s_id=$row['seller_id'];
			$b_id=$row['buyer_id'];
			$type=$row['type'];
			$g_id=$row['g_id'];
			$num=$row['num'];
			$begintime=$row['begintime'];
			
			//$date=date('y-m-d',time());
			//if($date

			$sql1="update order set state='CANCLED' where o_id=$oid";
			//$sql1="update order set state='CANCLED' where o_id=$oid and buyer_id=$uid";
			if($state=="UNPAID")
				if(!mysql_query($sql1))
					echo "<script> alert(\"取消订单失败1\");window.history.back(-1);</script>";
				else 
				{
					if($type=="hotel")
						$sql4="update hotel set total=total+$num where h_id=$g_id;";
					else if($type=="flight")
						$sql4="update flight set total=total+$num where h_id=$g_id;";
					if(!mysql_query($sql4))
						echo "<script> alert(\"商品总量恢复失败\");window.history.back(-1);</script>";
					echo "<script> alert(\"取消订单成功1\");window.history.back(-1);</script>";
				}
			if(!mysql_query($sql1))
				echo "<script> alert(\"取消订单失败2\");window.history.back(-1);</script>";

			$sql2="update buyer set balance=balance+$price where b_id=$b_id";
			if(!mysql_query($sql2))
				echo "<script> alert(\"买家账户返还金额失败\");window.history.back(-1);</script>";

			$sql3="update seller set balance=balance-$price where s_id=$s_id";
			if(!mysql_query($sql3))
				echo "<script> alert(\"卖家账户扣除金额失败\");window.history.back(-1);</script>";
			
			if($type=="hotel")
				$sql4="update hotel set total=total+$num where h_id=$g_id;";
			else if($type=="flight")
				$sql4="update flight set total=total+$num where h_id=$g_id;";
			if(!mysql_query($sql4))
				echo "<script> alert(\"商品总量恢复失败\");window.history.back(-1);</script>";

			echo "<script> alert(\"取消订单成功\");window.history.back(-1);</script>";
		//}
		//else echo "<script> alert(\"您还没有登陆，请先登录\");window.history.back(-1);</script>";
		?>
