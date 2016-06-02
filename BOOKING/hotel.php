<?php
    include("beforebody.html");
    //if(login)
        include("head_not_login.html");
    //else 
        //include("head_login.html")
    include("head_hotel.html");
    //include("DBconnect.php");包含数据库的连接模块
    //
    if(isset($_GET['id'])&&empty($_GET['id']))
        header("Location: my_hotel.html");//如果没有输入id，进行重定向
    $hotelid=$_GET['id'];//用户请求的id,用于进行数据库的查询
    //以下都是需要用数据库查询得到的信息
    $name="杭州紫金港超级大酒店";
    $province="浙江省";
    $city="杭州市";
    $block="西湖区";
    $road="申花路798号";
    $num_people=1024;//曾经入住的人数
    $num_comments=2;//评论的个数
    $rank=3.6;//评分
    $roomtypes=array(array("单人间","￥198"),array("标准间","￥215"),array("总统套房","￥361"));//房间型号列表
    $comments=array("手机用户1345657235" => "真的很不错啊", "手机用户13456572456" => "拥护习主席，拥护党中央");//评论列表
    $longitude=120.100133;
    $latitude=30.312355;
?>

<div class="main">
<div>
    <h2 style="text-align: center"><?php echo $name; ?></h2><br>
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
    <form class="navbar-form navbar-left" role="search" style="text-align:center;margin:0 auto;">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="城市">
            <input type="text" class="form-control" placeholder="酒店名 地标">
        </div>
        <button type="submit" class="btn btn-default">查看其它酒店</button>
    </form>
                </div>
            <div class="col-md-3"></div>
            </div>
        </div>
    <br>
    <br>
    <br>


    <div class="container">
        <div class="row">
            <div class="col-md-9">
            <img src="hotel/0002.jpg">
                </div>
            <div class="col-md-3">


                <ul class="list-group">
                <li class="list-group-item">
                <?php
                    for($i=0;$i<$rank-1;$i++)
                        echo '<img src="img/star.png">';
                    if($rank-$i<0.25)
                        echo '<img src="img/emptystar.png">';
                    else if($rank-$i>0.75)
                        echo '<img src="img/star.png">';
                    else
                        echo '<img src="img/halfstar.png">';                                    
                    for($i++;$i<5;$i++)
                        echo '<img src="img/emptystar.png">';
                ?>
                 <strong><?php echo $rank; ?>/5分</strong></li>
                    <li class="list-group-item"><?php echo $province+$city+$block; ?></li>
                    <li class="list-group-item"><?php echo $road ?></li>
                    <li class="list-group-item"><strong><?php echo $num_people; ?></strong>人曾经入住</li>
                    <li class="list-group-item"><strong><?php echo $num_comments; ?></strong>份评价</li>
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
                echo '<tr> <td>'. $room[0] . '</td><td>大床</td><td>免费无线网络</td><td><strong>' . $room[1] . '</strong></td><td><button type="button" class="btn-info">马上预订</button><img src="img/goto.png"></td></tr>';
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
    require("footer.html")
?>

<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js">
</script><script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js">
</script><script src="//cdn.bootcss.com/geopattern/1.2.3/geopattern.min.js"></script>
<script src="//cdn.bootcss.com/zeroclipboard/2.2.0/ZeroClipboard.min.js"></script>
<script src="//cdn.bootcss.com/localforage/1.2.4/localforage.nopromises.min.js"></script>
<!--<script src="js/site.min.js"></script>-->
<script type="text/javascript">var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F24aff315392dc2c9b2805cfa4d8e101a' type='text/javascript'%3E%3C/script%3E"));</script>
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
</script>


