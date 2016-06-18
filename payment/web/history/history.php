<?php
    header("Content-type:text/html;charset=utf-8");
	date_default_timezone_set('prc');
	session_start();
	$userType=$_SESSION['userType'];
	$uid=$_SESSION['uid'];
	if ($useType=='Buyer'){
		$sql_user=" and b_id = ".$uid." order by o_time";
	}
	else if($useType=='Seller'){
		$sql_user=" and s_id = ".$uid." order by o_time";
	}
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        require_once "../common/config.php";}
	function _post($str)
        {
            $val = !empty($_POST[$str]) ? $_POST[$str] : null;
            return $val;
        }
	$state=_post('state');
	$type=_post('time');
    $con = mysqli_connect("localhost:3306","root","123456");
	if (!$con) 
           echo '<script type="text/javascript"> alert("投诉失败：数据库连接失败，请联系网站管理员。"); window.history.back(-1)</script>;';
	
    mysqli_select_db($con, "abc");
    $sql = "select o_id,seller_id,buyer_id,state,type,g_id,g_name,price,num,o_time from order1";
	if(($state=='1')&&($type=='1')){
		$result = mysqli_query($con, $sql);
		}
	else if($state==1||$type==1){
		if($state==1){
			
            if($type==2){
				$date=date("Y-m-d");
				$sql=$sql." where o_time = '".$date."'";
				
            }
		
		    else if($type==3){
				$date=date("Y-m-d",mktime(0,0,0,date("m"),date("d")-7,date("Y")));
				$sql=$sql." where o_time >= '".$date."'";
		
		    }
		    else if($type==4){
				$date=date("Y-m-d",mktime(0,0,0,date("m")-1,date("d"),date("Y")));
                $sql=$sql." where o_time >= '".$date."'";
		
		    }
		    else if($type==5){
		        $date=date("Y-m-d",mktime(0,0,0,date("m")-3,date("d"),date("Y")));
                $sql=$sql." where o_time >= '".$date."'";
		    }
		    else if($type==7){
				$date=date("Y-m-d",mktime(0,0,0,date("m"),date("d"),date("Y")-1));
                $sql=$sql." where o_time >= '".$date."'";
		
		    }
			else if($type==6)
			{
				$date=date("Y-m-d",mktime(0,0,0,1,1,date("Y")));
                $sql=$sql." where o_time >= '".$date."'";
		
		    }
			else{
		          echo '<script type="text/javascript"> alert(出现异常错误。"); window.history.back(-1)</script>;';
		    }
			$sql= $sql . 
			 $result = mysqli_query($con, $sql);
		}
		else
		{
		 if($state==2)
             $sql=$sql." where state='PAID'";
		 else if($state==3)
			 $sql=$sql." where state='UNPAID'";
		 else if($state==4)          
			 $sql=$sql." where state='CANCLED'";
		 else{
               echo '<script type="text/javascript"> alert(出现异常错误。"); window.history.back(-1)</script>;';
	     }
		 $result = mysqli_query($con, $sql);
		}
	}
	else{
         if($state==2)
             $sql=$sql." where state='PAID'";
		 else if($state==3)
			 $sql=$sql." where state='UNPAID'";
		 else if($state==4)          
			 $sql=$sql." where state='CANCLED'";
		 if($state>6||$state<1||$type>7||$type<1)
              echo '<script type="text/javascript"> alert(出现异常错误。"); window.history.back(-1)</script>;';
		  if($type==2){
				$date=date("Y-m-d");
				$sql=$sql."and o_time = '".$date."'";
				echo $sql;
				
           }
		
		    else if($type==3){
				$date=date("Y-m-d",mktime(0,0,0,date("m"),date("d")-7,date("Y")));
				$sql=$sql."and o_time >= '".$date."'";
		
		    }
		    else if($type==4){
				$date=date("Y-m-d",mktime(0,0,0,date("m")-1,date("d"),date("Y")));
                $sql=$sql."and o_time >= '".$date."'";
		
		    }
		    else if($type==5){
		        $date=date("Y-m-d",mktime(0,0,0,date("m")-3,date("d"),date("Y")));
                $sql=$sql."and o_time >= '".$date."'";
		    }
		    else if($type==7){
				$date=date("Y-m-d",mktime(0,0,0,date("m"),date("d"),date("Y")-1));
                $sql=$sql."and o_time >= '".$date."'";
		
		    }
			else if($type==6)
			{
				$date=date("Y-m-d",mktime(0,0,0,1,1,date("Y")));
				echo $date;
                $sql=$sql."and o_time >= '".$date."'";
		    }
            $result = mysqli_query($con, $sql);
	}
		 
    echo "<table border='1'>";
		echo "<tr>";
		echo "<th>订单号</th>";
		echo "<th>卖家ID</th>";
		echo "<th>买家ID</th>";
		echo "<th>状态</th>";
		echo "<th>类型</th>";
		echo "<th>商品ID</th>";
		echo "<th>商品名称</th>";
		echo "<th>价格</th>";
		echo "<th>数量</th>";
		echo "<th>生成订单时间</th>";
		echo "<th>操作</th>";
		echo "</tr>";
    while($row=mysqli_fetch_array($result)){
		
	     echo "<tr>";
	     echo "<td>" . $row['o_id'] . "</td>";
 	     echo "<td>" . $row['seller_id'] . "</td>";
	     echo "<td>" . $row['buyer_id'] . "</td>";
	     echo "<td>" . $row['state'] . "</td>";
	     echo "<td>" . $row['type'] . "</td>";
	     echo "<td>" . $row['g_id'] . "</td>";
	     echo "<td>" . $row['g_name'] . "</td>";
		 echo "<td>" . $row['price'] . "</td>";
	     echo "<td>" . $row['num'] . "</td>";
	     echo "<td>" . $row['begintime'] . "</td>";
		 echo "</tr>";
		
	}
?>