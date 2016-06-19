<?php
    require_once '../common/config.php';
	$con = mysqli_connect($DB_HOST.':'.$DB_PORT, $DB_USER, $DB_PASSWORD);
	if (!$con)
		echo 'Datebase connect error';
	else {
        $date_off=1;
        mysqli_select_db($con, $DB_SCHEMA);
        set_time_limit(0);
        ini_set('memory_limit', '512M');
        while ($date_off<=365) {
            $time=time ()- ($date_off*24*60*60);
            $result = mysqli_query($con, "select * from `order` where UNIX_TIMESTAMP(begtime) >= $time and UNIX_TIMESTAMP(begtime) < $time + 24  *  60  *  60");
            $orders = array();
            $i = 0;
            while ($row=$result->fetch_assoc()) {
                $orders[$i] = $row;
                $i++;
            }
            if ($i!=0) {
                echo $date_off.":".$i.'<br>';
                echo date("Y-m-d",$time).'<br>';
                echo "select * from `order` where UNIX_TIMESTAMP(begtime) >= $time and UNIX_TIMESTAMP(begtime) < $time + 24  *  60  *  60".'<br>';
                $filename = date("Y-m-d",$time);
                $output = fopen("csv/$filename.csv", 'w+')
                or die("can't open csv/$filename.csv");
                fwrite($output,chr(0xEF).chr(0xBB).chr(0xBF)); // 使用BOM来标记文本文件的编码方式
                $table_head = array('订单ID', '卖家ID', '买家ID', '订单状态', '订单类型', '商品ID', '商品价格', '商品数量', '订单开始日期', '订单结束日期', '商品名称');
                fputcsv($output, $table_head);
                foreach ($orders as $o) {
                    fputcsv($output, array_values($o));
                }
                fclose($output) or die("can't close csv/$filename.csv");
            }
            $date_off++;
        }
	}
?>
