<!DOCTYPE html>
<html>
<head>
   <title>取消订单</title>
   <link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
   <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
   <script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
   <script>
   function show()
   {
	    var s=window.location.search.substring(1);
		s=s.replace('oid=','');
		//alert(s);
		document.getElementById('order_id').setAttribute('value',s);
   }
   </script>
</head>

<body onload=show()>
<?php
    include("../../common/head.html");
    include("../../common/time-picker.html");
    include("../../common/title.html");
    include("../../common/header_login.html");
?>
<h1 align="center"> 取消订单</h1>
<form role="form" method="POST" action="cancelorder.php" >
        <div class="form-group">
            <label for="name">待取消订单号<font color="#F00">*</font></label>
            <input type="text" class="form-control" placeholder="请输入订单号" name="order" id='order_id' value="1234" >

            <label for="name">请输入您的密码<font color="#F00">*</font></label>
            <input type="password" name="password" class="form-control" placeholder="请输入你的支付密码" id='pw' >

            <input type="submit" class="btn-success btn-success-info" value="提交">
        </div>
    </form>

</body>
</html>