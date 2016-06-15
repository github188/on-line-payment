<?php
	require_once '../common/config.php';
	require_once 'order_check.php';
	echo 'test.php<br>';
	$con = mysqli_connect($DB_HOST.':'.$DB_PORT, $DB_USER, $DB_PASSWORD);
	if (!$con) 
		echo 'Datebase connect error';
	else {
		mysqli_select_db($con, $DB_SCHEMA);
		$result = mysqli_query($con, 'select * from `order` ');
		while($row = mysqli_fetch_array($result)) {
			$o_id = $row['o_id'];
			$s_id = $row['s_id'];
			$b_id = $row['b_id'];
			$state = $row['state'];
			$type = $row['type'];
			$g_id = $row['g_id'];
			$price = $row['price'];
			$num = $row['num'];
			$begtime = $row['begtime'];
			$endtime = $row['endtime'];
			$g_name = $row['g_name'];
			echo $o_id.' '.$s_id.' '.$b_id.' '.$state.' '.$type.' '.$g_id.' '.$price.' '.$num.' '.$begtime.' '.$endtime.' '.$g_name.'<br>';
			$arr = order_check($con, $o_id, $s_id, $b_id, $state, $type, $g_id, $g_name, $price, $num, $begtime, $endtime, false);
			if(empty($arr))
				echo 'OK~<br>';
			else {
				if (!empty($arr['con']))
					echo 'con: '.$arr['con'].'<br>';
				if (!empty($arr['o_id']))
					echo 'o_id: '.$arr['o_id'].'<br>';
				if (!empty($arr['s_id']))
					echo 's_id: '.$arr['s_id'].'<br>';
				if (!empty($arr['b_id']))
					echo 'b_id: '.$arr['b_id'].'<br>';
				if (!empty($arr['state']))
					echo 'state: '.$arr['state'].'<br>';
				if (!empty($arr['type']))
					echo 'type: '.$arr['type'].'<br>';
				if (!empty($arr['goods']))
					echo 'goods: '.$arr['goods'].'<br>';
				if (!empty($arr['price']))
					echo 'price: '.$arr['price'].'<br>';
				if (!empty($arr['num']))
					echo 'num: '.$arr['num'].'<br>';
				if (!empty($arr['time']))
					echo 'time: '.$arr['time'].'<br>';
			}
			echo '<br>';
		}
			
	}
?>