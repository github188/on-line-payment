<?php
    require_once 'check_login.php';
    require_once '../common/config.php';
    session_start();
//    if( !($_SESSION['uid']=='audit' &&  $_SESSION['password']=='audit') ) {
//        echo("<script>alert('请登录!');
//            location.href='../Admin/index.php'</script>");
//    }

//    if ( isset($_POST["search"]) ) {
//        $year = $_POST["year"]==''?'2016':$_POST["year"];
//        $month = $_POST["month"]==''?'01':$_POST["month"];
//        $date = $_POST["date"]==''?'01':$_POST["date"];
//        $hour = $_POST["hour"]==''?'00':$_POST["hour"];
//        $miniute = $_POST["miniute"]==''?'00':$_POST["miniute"];
//        $second = $_POST["second"]==''?'00':$_POST["second"];
//        $time = $year.'-'.$month.'-'.$date.' '.$hour.':'.$miniute.':'.$second;
//        echo $time.'<br>';
//        echo strtotime($time).'<br>';
//        echo date('Y-m-d H:i:s', strtotime($time)).'<br>';
//    }
    if ( isset($_POST['begtime']) ) {
        if ( $_POST['begtime'] != '' )
            $begtime = $_POST['begtime'];
        if ( $_POST['endtime'] != '' )
            $endtime = $_POST['endtime'];
    }
    $con = mysqli_connect($DB_HOST.':'.$DB_PORT, $DB_USER, $DB_PASSWORD);
    if (!$con)
        echo 'Datebase connect error';
    else {
        mysqli_select_db($con, $DB_SCHEMA);
        $result=mysqli_query($con, "select count(*) from `error_order`");
        $row = mysqli_fetch_array($result);
        $error_num = $row["count(*)"];
        echo "共发现 $error_num 条错误订单";
        echo '<div class="box" style="width:250px; margin:0 auto;">
                <form action="index.php" method="post">
                    开始时间<input type="date" name="begtime" value="2016-01-13"/><br/>
                    结束时间<input type="date" name="endtime" value=""/><br/>
                    <input type="submit" name="search" value="查询"><br>
                </form>
			</div>';
        if (isset($_POST["search"]) ) {
            if ( isset($begtime) && isset($endtime) )
                $sql = "select * from `error_order` where UNIX_TIMESTAMP(begtime) >= UNIX_TIMESTAMP('$begtime') and UNIX_TIMESTAMP(begtime) <= UNIX_TIMESTAMP('$endtime')";
            else if ( isset($begtime) )
                $sql = "select * from `error_order` where UNIX_TIMESTAMP(begtime) >= UNIX_TIMESTAMP('$begtime')";
            else if ( isset($endtime) )
                $sql = "select * from `error_order` where UNIX_TIMESTAMP(begtime) <= UNIX_TIMESTAMP('$endtime')";
            // echo $sql;
            $result = mysqli_query($con, $sql);
            $mailcontent = '<form action="modify_error_order.php" method="post">
                        <table width="95%" cellpadding="2" cellspacing="1" border="1" style="lable-layout:fixed;">
						<tr>
							<td width="50px" nowrap>订单ID</td>
							<td width="50px" nowrap>卖家ID</td>
							<td width="50px" nowrap>买家ID</td>
							<td width="50px" nowrap>订单状态</td>
							<td width="50px" nowrap>订单类型</td>
							<td width="50px" nowrap>商品ID</td>
							<td width="50px" nowrap>单价</td>
							<td width="50px" nowrap>数量</td>
							<td width="100px" nowrap>下订单时间</td>
							<td width="100px" nowrap>确认订单时间</td>
							<td width="100px" nowrap>商品名称</td>
						</tr>
					';
            if (!empty($result)) {
                while($row = mysqli_fetch_array($result)) {
                    $o_id = $row['o_id'];
                    $begtime = $row['begtime'];
                    $res=mysqli_query($con, "select * from `order` where o_id=$o_id");
                    $r = mysqli_fetch_array($res);
                    $s_id = $r['s_id'];
                    $b_id = $r['b_id'];
                    $state = $r['state'];
                    $type = $r['type'];
                    $g_id = $r['g_id'];
                    $price = $r['price'];
                    $num = $r['num'];
                    $endtime = $r['endtime'];
                    $g_name = $r['g_name'];
                    $mailcontent .= "<tr>
							<td><input type='text' name='year' value='$o_id'></td>
							<td><input type='text' name='year' value='$s_id'></td>
							<td><input type='text' name='year' value='$b_id'></td>
							<td><input type='text' name='year' value='$state'></td>
							<td><input type='text' name='year' value='$type'></td>
							<td><input type='text' name='year' value='$g_id'></td>
							<td><input type='text' name='year' value='$price'></td>
							<td><input type='text' name='year' value='$num'></td>
							<td><input type='text' name='year' value='$begtime'></td>
							<td><input type='text' name='year' value='$endtime'></td>
							<td><input type='text' name='year' value='$g_name'></td>
						</tr>";
                }
            }
            $mailcontent .= '</table>
                           </form>';
            echo $mailcontent;
        }

    }
?>
