<?php
	require_once '../common/config.php';
	require_once '../common/email.class.php';
	require_once 'order_check.php';
	$con = mysqli_connect($DB_HOST.':'.$DB_PORT, $DB_USER, $DB_PASSWORD);
	if(!$con)
	{
		die('Could not connect:'.mysqli_error());
	}
	mysqli_select_db($con, $DB_SCHEMA);
	$result=mysqli_query($con, "select * from `order` where begtime >= CURDATE()-1 and begtime < CURDATE()");

	while($row = mysqli_fetch_array($result))
    {
		$arr = order_check($con, $row['o_id'], $row['s_id'], $row['b_id'],
			$row['state'], $row['type'], $row['g_id'], $row['g_name'], $row['price'],
			$row['num'], $row['begtime'], $row['endtime'], false);
		if (!empty($arr)) {
			$o_id = $row['o_id'];
			$begtime = $row['begtime'];
			mysqli_query($con, "insert into error_order values($o_id, '$begtime')");
		}
    }

	$result=mysqli_query($con, "select * from `error_order` ");
	$mailcontent = '<table border="1">
						<tr>
							<td>o_id</td>
							<td>begtime</td>
						</tr>
					';
	while($row = mysqli_fetch_array($result)) {
		$o_id = $row['o_id'];
		$begtime = $row['begtime'];
		$mailcontent .= "<tr>
							<td>$o_id</td>
							<td>$begtime</td>
						</tr>";
	}
	$mailcontent .= '</table>';
	//******************** 配置信息 ********************************
	$smtpserver = "smtp.163.com";//SMTP服务器
	$smtpserverport =25;//SMTP服务器端口
	$smtpusermail = "qqq1051814353@163.com";//SMTP服务器的用户邮箱
	$smtpemailto = "1051814353@qq.com";//发送给谁
	$fromName = '在线支付系统';
	$smtpuser = "qqq1051814353@163.com";//SMTP服务器的用户帐号
	$smtppass = "qqq1051814353";//SMTP服务器的用户密码，授权码
	$mailtitle = "订单出现异常,请及时处理";//邮件主题
	$mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
	//************************ 配置信息 ****************************
	$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
	$smtp->debug = false;//是否显示发送的调试信息
	$state = $smtp->sendmail($smtpemailto, $smtpusermail, $fromName, $mailtitle, $mailcontent, $mailtype);
	if($state=="")
		echo "邮件发送失败";
	else {
		echo "成功发送邮件";
	}

?>