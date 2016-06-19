<?php
    require_once 'check_login.php';
    require_once '../common/config.php';
    $begtime = $_GET['begtime'];
    $endtime = $_GET['endtime'];
    $con = mysqli_connect($DB_HOST.':'.$DB_PORT, $DB_USER, $DB_PASSWORD);
    if (!$con)
        echo 'Datebase connect error';
    else {
        mysqli_select_db($con, $DB_SCHEMA);
        $sql = "select * from `error_order` where UNIX_TIMESTAMP(begtime) >= UNIX_TIMESTAMP('$begtime') and UNIX_TIMESTAMP(begtime) <= UNIX_TIMESTAMP('$endtime')";
        $result = mysqli_query($con, $sql);
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
                echo "<tr>
                        <td>$o_id</td>
                        <td>$s_id</td>
                        <td>$b_id</td>
                        <td>$g_id</td>
                        <td>$g_name</td>
                        <td>$state</td>
                        <td>$type</td>
                        <td>$price</td>
                        <td><font color='red'>$num</font></td>
                        <td>$begtime</td>
                        <td>$endtime</td>
                    </tr>";
            }
        }
    }
?>

<!--<td>$o_id</td>-->
<!--<td>$s_id</td>-->
<!--<td>$b_id</td>-->
<!--<td>$g_id</td>-->
<!--<td>$g_name</td>-->
<!--<td>$state</td>-->
<!--<td>$type</td>-->
<!--<td>$price</td>-->
<!--<td>$num</td>-->
<!--<td>$begtime</td>-->
<!--<td>$endtime</td>-->
<!--<td><input style='width:60px' type='text' name='year' value='$o_id'></td>-->
<!--<td><input style='width:60px' type='text' name='year' value='$s_id'></td>-->
<!--<td><input style='width:60px' type='text' name='year' value='$b_id'></td>-->
<!--<td><input style='width:60px' type='text' name='year' value='$g_id'></td>-->
<!--<td><input style='width:60px' type='text' name='year' value='$g_name'></td>-->
<!--<td><input style='width:40px' type='text' name='year' value='$state'></td>-->
<!--<td><input style='width:40px' type='text' name='year' value='$type'></td>-->
<!--<td><input style='width:60px' type='text' name='year' value='$price'></td>-->
<!--<td><input style='width:30px' type='text' name='year' value='$num'></td>-->
<!--<td><input style='width:120px' type='text' name='year' value='$begtime'></td>-->
<!--<td><input style='width:120px' type='text' name='year' value='$endtime'></td>-->