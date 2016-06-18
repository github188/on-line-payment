<?php
    header("Content-type:text/html;charset=utf-8");
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        require_once "../../common/config.php";

        function _post($str)
        {
            $val = !empty($_POST[$str]) ? $_POST[$str] : null;
            return $val;
        }
        $order=_post('order');
        $userid=123456;

        $con = mysqli_connect($DB_HOST.':'.$DB_PORT, $DB_USER, $DB_PASSWORD);
        mysqli_query($con,"SET NAMES utf8");
        if (!$con)
            echo '<table class="table table-hover">
                   <caption style="font-size: 200%">投诉记录</caption>
                   <thead>
                      <tr><th>查询失败：数据库连接失败，请联系网站管理员。
                         </th></tr>
                   </thead></table>';                    
        else {
            mysqli_select_db($con, $DB_SCHEMA);

            $sql="select o_id,s_id,b_id,c_type,c_content from `complaint` natural join `order` where (s_id = '$userid' or b_id = '$userid')";
            if($order!=null){
                $sql=$sql." and o_id = '$order'";
            }
            $result = mysqli_query($con, $sql);
            if (!$result->num_rows) {
                echo '<table class="table table-hover">
                       <caption style="font-size: 200%">投诉记录</caption>
                       <thead>
                          <tr><th>查询失败：没有该订单号。
                             </th></tr>
                       </thead></table>';
            }else{
                echo '<table class="table table-hover">
                       <caption style="font-size: 200%">投诉记录</caption>
                       <thead>
                          <tr>
                             <th>订单号</th>
                             <th>卖家ID</th>
                             <th>买家ID</th>
                             <th>投诉类型</th>
                             <th>投诉原因</th>
                          </tr>
                       </thead>
                       <tbody>';
                mysqli_data_seek($result, 0);
                while ($row=mysqli_fetch_row($result))
                {
                    echo "<tr>";
                    for ($i=0; $i<mysqli_num_fields($result); $i++ )
                    {
                        echo '<th>'.$row[$i].'</th>';
                    }
                    echo "</tr>";
                }
                echo '</tbody></table>';
            }
        }
        mysqli_close($con);
    }
?>