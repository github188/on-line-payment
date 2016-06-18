<!DOCTYPE html>
<html>
<head>
   <title>个人界面</title>
   <link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
   <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
   <script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>

<?php
    include("common/head.html");
  //  include("common/time-picker.html");
    include("common/title.html");
 //   include("common/header_login.html");
?>

<ul id="myTab" class="nav nav-tabs">
   <li class="active">
      <a href="#order" data-toggle="tab">
         我的订单
      </a>
   </li>
   <li><a href="#history" data-toggle="tab">历史记录</a></li>
   <li><a href="../BOOKING/index.php">预定订单</a></li>
<!--   <li><a href="#info" data-toggle="tab">个人信息</a></li> -->

    <!--<li><a href="#complain" data-toggle="tab">投诉订单</a></li>李，添加投诉订单选项卡-->

    <li class="dropdown">
    <a href="#" id="myTabDrop2" class="dropdown-toggle" 
     data-toggle="dropdown">投诉订单 
     <b class="caret"></b>
    </a>
    <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop2">
     <li><a href="#complain" tabindex="-1" data-toggle="tab">投诉订单</a></li>
     <li><a href="#complain_search" tabindex="-1" data-toggle="tab">投诉查询</a></li>
    </ul>

   <li><a href="../PAM/login.html">退出</a></li>
</ul>

<div id="myTabContent" class="tab-content">
   <div class="tab-pane fade in active" id="order">
		<br>
      <form name="myform">
		<div class="form-group">
			<label for="name">请输入完整订单号，如果没有输入则默认查询所有订单</label>
			<input type="text" class="form-control" placeholder="请输入订单号" id="m_search_order">
			<input type="button" class="btn btn-success" value="提交" id="m_search_submit">
		</div>
	    </form>
      <div id="m_search_submit_div"></div>
      <script>
       $(function(){
          $('#m_search_submit').click(function(){
              $('#m_search_submit_div').load("./web/myorder/search.php",{"order_id":document.getElementById('m_search_order').value});
          });
      });
      </script>
	<br><br>

<!-- order(o_id, seller_id, buyer_id, state, type, g_id, price, num) -->	
	<table class="table table-hover">
	   
	</table>
   </div>
   
   <div class="tab-pane fade" id="history">
		<br>
      <form role="form" action="./web/history/history.php" method="post">
		<div class="form-group">
			<label for="name">请选择筛选条件</label>
			<br>
			<b>订单状态：</b><select class="form-control" name="state">
			<option value="1">请选择...</option>
			<option value="2">已付款</option>
			<option value="3">未付款</option>
			<option value="4">已取消</option>
			</select>
			<b>订单时间：</b><select class="form-control" name="time">
			<option value="1">请选择...</option>
			<option value="2">今天</option>
			<option value="3">上周</option>
			<option value="4">上月</option>
			<option value="5">近三个月</option>
			<option value="6">今年</option>
			<option value="7">一年前</option>
			</select>
			<input type="submit" class="btn btn-success" value="提交">
		</div>
    </form>
  	<br><br>
   </div>

<!--
   <div class="tab-pane fade" id="info">
      <p style="position:absolute; margin-left:45%">尚未开发</p>
   </div> -->

   <div class="tab-pane fade" id="complain"><!--李，投诉订单选项卡的内容-->
        <br>
      <form role="form" method="POST" action="./web/complaint/complain.php">
        <div class="form-group">
            <label for="name">投诉订单号<font color="#F00">*</font></label>
            <input type="text" class="form-control" placeholder="请输入订单号" name="order" id="c_order">

            <label for="name">请选择投诉的类型<font color="#F00">*</font></label>
            <select class="form-control" name="type">
            <option value="请选择...">请选择...</option>
            <option value="心情好">心情好</option>
            <option value="心情不好">心情不好</option>
            <option value="你猜">你猜</option>
            <option value="我猜不猜">我猜不猜</option>
            <option value="不猜">不猜</option>
            </select>

            <label for="name">投诉原因<font color="#F00">*</font></label>
            <input type="text" class="form-control" placeholder="请输入投诉的具体原因" name="content">
            <input type="submit" class="btn btn-success" value="提交">
        </div>
    </form>
    </div>

    <div class="tab-pane fade" id="complain_search">
        <br>
      <form role="form">
        <div class="form-group">
            <label for="name">请输入订单号，如果没有输入则默认查询所有订单</label>
            <input type="text" class="form-control" placeholder="请输入订单号" name="order" id="c_search_order">
            <input type="button" class="btn btn-success" value="提交" id="c_search_submit">
        </div>
        </form>
        <br><br>
        <div id="c_search_submit_div"></div>
        <script>
         $(function(){
            $('#c_search_submit').click(function(){
                $('#c_search_submit_div').load("./web/complaint/complain_search.php",{"order":document.getElementById('c_search_order').value});
            });
        });
        </script>
    </div>
</div>
</body>
</html>

