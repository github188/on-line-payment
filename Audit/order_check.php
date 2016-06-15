<?php
	function order_check($con, $o_id, $s_id, $b_id, $state, $type, $g_id, $g_name,
		 					$price, $num, $begtime, $endtime, $isDebug )
	{
        $arr=array();
        if (!$con)
            $arr['con'] = 'Datebase connect error';

        // 判断 $o_id 是否合法
        if (!preg_match("/^\d{1,11}$/", $o_id))
            $arr['o_id'] = "Invaild order ID";

        // 判断 $s_id 是否合法
        if (!preg_match("/^\d{1,11}$/", $s_id))
            $arr['s_id'] = "Invaild seller ID";
        else {
            $result = mysqli_query($con, "select * from `seller` where s_id = $s_id ");
            if (empty(mysqli_fetch_array($result)))
                $arr['s_id'] = "Invaild seller ID";
        }

        // 判断 $b_id 是否合法
        if (!preg_match("/^\d{1,11}$/", $b_id))
            $arr['b_id'] = "Invaild buyer ID";
        else {
            if ($isDebug) echo "select * from `buyer` where b_id = $b_id ";
            $result = mysqli_query($con, "select * from `buyer` where b_id = $b_id ");
            if (empty(mysqli_fetch_array($result)))
                $arr['b_id'] = "Invaild buyer ID";
        }

        // 判断 $state 是否合法
        if (!preg_match("/^\d{1}$/", $state) || $state <= 0 || $state > STATE_MAX)
            $arr['state'] = "Invaild order state";

        // 判断 $type 是否合法
        if (!preg_match("/^\d{1}$/", $type) || $type <= 0 || $type > STATE_MAX)
            $arr['type'] = "Invaild order type";
        else {
            // 判断 $g_id, $g_name 是否合法
            if (!preg_match("/^\d{1,11}$/", $g_id))
                $arr['goods'] = "Invaild hotel/flight id/name";
            else {
                if (!get_magic_quotes_gpc())
                    $g_name = addslashes($g_name);
                if ($type == HOTEL)
                    $sql = "select * from `hotel` where h_id = $g_id and `name` = '$g_name' ";
                elseif ($type == FLIGHT)
                    $sql = "select * from `flight` where f_id = $g_id and `name` = '$g_name' ";
                if ($isDebug) echo $sql;
                $result = mysqli_query($con, $sql);
                if(empty(mysqli_fetch_array($result)))
                    $arr['goods'] = "Invaild hotel/flight id/name";
            }
        }

        // 判断 $price 是否合法
        if ($price <= 0 )
            $arr['price'] = "Invaild price";

        // 判断 $num 是否合法
        if (!preg_match("/^\d{1,11}$/", $num) || $num <= 0 )
            $arr['num'] = "Invaild number";

        // 判断 $begtime, $endtime 是否合法
        if (strtotime($begtime) >= strtotime($endtime) )
            $arr['time'] = "Invaild begintime/endtime";
        if ($isDebug) echo $arr['o_id'];
        return $arr;
	}
	
?>