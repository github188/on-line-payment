<?php 
	header("Content-type:text/html;charset=utf-8");  
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
        require_once "../../common/config.php";

        function _post($str){
            $val = !empty($_POST[$str]) ? $_POST[$str] : null;
            return $val;
        }
		$order_id=_post('order_id');
		$userType="buyer";
		$uid=123456;

        $conn = mysqli_connect($DB_HOST.':'.$DB_PORT, $DB_USER, $DB_PASSWORD);
        mysqli_query($conn,"SET NAMES utf8");
		if(!$conn){
            echo '<table class="table table-hover">
                   <caption style="font-size: 200%">我的订单</caption>
                   <thead>
                      <tr><th>查询失败：数据库连接失败，请联系网站管理员。
                         </th></tr>
                   </thead></table>'; 
		}else{
			mysqli_select_db($conn, $DB_SCHEMA);
			$sql="select o_id,s_id,b_id,state,type,g_id,g_name,price,num,begtime from `order` where state = '1'";
			if ($order_id!=null) {
				$sql=$sql." and o_id = '$order_id'";
			}
			if($userType=="seller"){
				$sql=$sql." and s_id = '$uid'";
			}else if($userType=="buyer"){
			    $sql=$sql." and b_id = '$uid'";
			}

	        $result=mysqli_query($conn, $sql);
	        if (!$result->num_rows) {
                echo '<table class="table table-hover">
                       <caption style="font-size: 200%">我的订单</caption>
                       <thead>
                          <tr><th>查询失败：没有该订单号。
                             </th></tr>
                       </thead></table>';
	        }else{
	            echo '<table class="table table-hover">
	                   <caption style="font-size: 200%">我的订单</caption>
					   <thead>
						  <tr>
							 <th>订单号</th>
							 <th>卖家ID</th>
							 <th>买家ID</th>
							 <th>状态</th>
							 <th>类型</th>
							 <th>商品ID</th>
							 <th>商品名称</th>
							 <th>价格</th>
							 <th>数量</th>
							 <th>订单生成时间</th>
							 <th>操作</th>
						  </tr>
					   </thead>
	                   <tbody>';
				while($row=mysqli_fetch_array($result)){
					echo "<tr>
						<th>".$row['o_id']."</th>
						<th>".$row['s_id']."</th>
						<th>".$row['b_id']."</th>
						<th>未支付</th>
						<th>".$row['type']."</th>
						<th>".$row['g_id']."</th>
						<th>".$row['g_name']."</th>
						<th>".$row['price']."</th>
						<th>".$row['num']."</th>
						<th>".$row['begtime']."</th>
						<th class='operation'>
						<a href='web/myorder/pay.php?oid=".$row['o_id']."'>在线支付</a>
						<a href='web/myorder/cancel.php?oid=".$row['o_id']."'>取消订单</a>
						<a href=\"#\" onclick=\"
							javascript:$('#myTab a[href=#complain]').tab('show');
							document.getElementById('c_order').setAttribute('value',".$row['o_id'].");\">投诉</a>
						</th></tr>";
				}
				echo "</tbody></table>";
			}
		}
		mysqli_close($conn);
	}
?>