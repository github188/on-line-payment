<?php
    include("include/head.html");
    include("include/map.html");
    include("include/pointstars.html");
    include("include/title.html");
    //if(login)
        include("include/header_not_login.html");
    //else 
        //include("include/head_login.html")
    //include("include/DBconnect.php");包含数据库的连接模块
    
    include("include/search_hotel.html");
    if(!isset($_GET['id'])||empty($_GET['id']))
        header("Location: my_hotel.html");//如果没有输入id，进行重定向
    $hotelid=$_GET['id'];//用户请求的id,用于进行数据库的查询
    //以下都是需要用数据库查询得到的信息
    $dbc = @mysqli_connect ('localhost', 'payment', 'payment123', 'payment') OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );
                 mysqli_set_charset($dbc, 'utf8');
                 $qh= "SELECT * FROM hotel WHERE hotel.h_id='$hotelid'"; 
                 $r= @mysqli_query($dbc,$qh);          
                 $row=mysqli_fetch_assoc($r);
                     $hotelid=$row['h_id'];
                     $name = $row['hotel_name'];
                     $pic = $row['picbig'];
                     $province = $row['add_province'];
                     $city = $row['add_city'];
                     $block = $row['add_block'];
                     $road = $row['add_street'];
                     $num_people = $row['reviewer'];
                     $road = $row['add_street'];
                     $price = $row['hotel_price'];
                     $point = $row['score'];
                     $rank = $row['star'];
                     $longitude = $row['logitude'];
                     $latitude = $row['latitude'];
                     $num_point = $row['reviewer'];
    mysqli_free_result($r);

    $rooms=array();
                $qr= "SELECT * FROM room WHERE room.hotel_name ='$name'"; 
                $s= @mysqli_query($dbc,$qr); 
                while($row=mysqli_fetch_assoc($s)){    
                        $rooms[]=array("type" => $row['type'], "price" => $row['room_price']);   
                        }
    mysqli_free_result($s);

    $comments=array();
                $qc= "SELECT * FROM comments WHERE comments.hotel_name ='$name'"; 
                $t= @mysqli_query($dbc,$qc); 
                $num_comments=0;
                while($row=mysqli_fetch_assoc($t)){    
                        $comments[]=array("username" => $row['username'], "comment" => $row['comment']);
                        $num_comments=$num_comments+1;
                        }
    mysqli_free_result($t);

    mysqli_close($dbc); 

?>
<link rel="stylesheet" type="text/css" media="all" href="css/daterangepicker.css" />
<script src="//cdn.bootcss.com/moment.js/2.13.0/moment.js"></script>
<script src="//cdn.bootcss.com/bootstrap-daterangepicker/2.1.21/daterangepicker.js"></script>

<div class="main">
<div>
    
    <br>
    <br>
    <br>


    <div class="container">
        <div class="row">
            <div class="col-md-9">
            <h2 style="text-align: center"><?php echo $name; ?></h2><br>
            <?php
                echo '<img src="' . $pic . '">';
            ?>
                </div>
            <div class="col-md-3">


                <ul class="list-group">
                <li class="list-group-item"><span>酒店星级：</span>
                <?php
                    for ($i=0; $i <$rank ; $i++) { 
                        echo '<img src="img/star.png">';
                    }
                    ?>
                </li>
                <li class="list-group-item">
                <span id="points"></span>
                 <br><strong><?php echo $point; ?>/5分</strong>（<?php echo $num_point; ?>人评价）</li>
                    <li class="list-group-item"><?php echo $province ." " . $city . " " . $block; ?></li>
                    <li class="list-group-item"><?php echo $road ?></li>
                    <li class="list-group-item"><strong><?php echo $num_people; ?></strong>人曾经入住</li>
                    <li class="list-group-item"><strong><?php echo $num_comments; ?></strong>份评论</li>
                </ul>
            </div>
        </div>
    </div>

    <br>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
    <div class="panel panel-default" >
        <!-- Default panel contents -->
        <div class="panel-heading">房型列表</div>
        </div>
    <table name="room-type" class="table">
        <tr>
            <td>房型</td>
            <td>床型</td>
            <td>网络</td>
            <td>价格</td>
            <td>预订</td>
        </tr>
        <?php 
        foreach ($rooms as $room) {
                echo '<tr> <td>'. $room['type'] . '</td><td>大床</td><td>免费无线网络</td><td><strong class="price">' . '￥' . $room['price'] . '</strong></td><td><a href="order-hotel.php?hotelid=' . $hotelid .'&type=' . $room['type'] .'"><button type="button" class="btn btn-info btn-sm">马上预订<img src="img/goto.png"></button></a></td></tr>';
            }
        ?>
    </table>
                </div>
            <div class="col-md-4"><div id="BaiduMap" style="float: right"></div></div>
</div>
        </div>
        </div>

<br><br>

<main id="all-packages">

    <div class="container" id="comments">

        <div class="list-group packages">
            <div class="panel panel-default" >
                <!-- Default panel contents -->
                <div class="panel-heading"><h4>用户评论</h4></div>
            </div>
            <?php
                foreach ($comments as $content) {
                    echo  '<div  class="list-group-item">
                <user>' . $content['username'] . '：</user>' . $content['comment'] . '</div>';
                }
            ?>
        </div>
</main>
</div>

<?php
    require("include/footer.html")
?>


<?php
    include("include/scripts.html")
?>

<script type="text/javascript">
    var map = new BMap.Map("BaiduMap");          // 创建地图实例
    <?php
        echo "var point = new BMap.Point(" . $longitude . "," . $latitude . ');';
    ?>
    var marker = new BMap.Marker(point); // 创建点坐标
    map.addOverlay(marker);//把标注加入到地图当中
    map.addControl(new BMap.NavigationControl());
    map.addControl(new BMap.ScaleControl());
    map.addControl(new BMap.OverviewMapControl());
    map.addControl(new BMap.MapTypeControl());
    map.enableScrollWheelZoom();
    //map.setCurrentCity("杭州"); // 仅当设置城市信息时，MapTypeControl的切换功能才能可用
    map.centerAndZoom(point, 16);                 // 初始化地图，设置中心点坐标和地图级别
    $('#points').raty({ score: <?php echo $point ?>});
</script>

<style type="text/css">
    .price
    {
        font-size: large;
        color: green;
    }
</style>

