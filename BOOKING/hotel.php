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

    //查询得到下列信息

    $hotelid=2;
    $num_point=13;
    $name="杭州紫金港超级大酒店";
    $province="浙江省";
    $city="杭州市";
    $block="西湖区";
    $road="申花路798号";
    $num_people=1024;//曾经入住的人数
    $num_comments=2;//评论的个数
    $rank=3;//酒店星级
    $point=3.6;
    $roomtypes=array(array("单人间",198),array("标准间",215),array("总统套房",361));//房间型号列表
    $comments=array("手机用户1345657235" => "真的很不错啊", "手机用户13456572456" => "拥护习主席，拥护党中央");//评论列表
    $longitude=120.100133;
    $latitude=30.312355;
    $pic="hotel/0002.jpg";//图片的地址
?>

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
        foreach ($roomtypes as $room) {
                echo '<tr> <td>'. $room[0] . '</td><td>大床</td><td>免费无线网络</td><td><strong class="price">' . '￥' . $room[1] . '</strong></td><td><a href="order-hotel.php?hotelid=' . $hotelid .'"><button type="button" class="btn btn-info btn-sm">马上预订<img src="img/goto.png"></button></a></td></tr>';
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
                foreach ($comments as $user => $content) {
                    echo  '<div  class="list-group-item">
                <user>' . $user . '：</user>' . $content . '</div>';
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

