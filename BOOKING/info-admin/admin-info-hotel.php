<?php
    session_start();
    if(!isset($_SESSION['agent']) OR ($_SESSION['agent']!=md5($_SERVER['HTTP_USER_AGENT'])) OR !isset($_SESSION['admin'])){
        header("location: admin-info-login.php");    
    }
    include("../include/head.html");
?>
<style type="text/css">
    price
    {
        font-size: x-large;
        color: green;
    }

    .lowest
    {
        font-size: x-small;
        color: blue;
    }

    .filter-tip
    {
        background-color: rgb(92,184,92);
        color: white;
        height: 30px;
        padding-top: 5px;
        padding-bottom: 5px;
    }
</style>
<link href="//cdn.bootcss.com/raty/2.7.0/jquery.raty.css" rel="stylesheet">
<script src="//cdn.bootcss.com/raty/2.7.0/jquery.raty.js"></script>

<!--站点标题-->
<body class="home-template">
<div class="container">
      <div class="row" id="headline-container">
           <h1 class="col-md-12">
                <span><img src="/img/图标.jpg" width="70" height="70" alt="some_text">&nbsp;&nbsp;</span><em><strong>远途网<span>&nbsp;&nbsp;&nbsp;&nbsp;酒店机票信息管理</span></strong></em>
         </h1>
      </div>
    </div>
 <hr size=1 style="height:3px;background-color: green"><nav  class="navbar navbar-default" style="margin-top: 0px; margin-bottom: 0px; margin: 0px;"> 
<div class="container">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1
    ">
      <ul class="nav navbar-nav">
        <li><a href="admin-info-hotel.php">酒店</a></li>
        <li><a href="admin-info-flight.php">机票</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li><a href="new-hotel.php">添加新酒店</a></li>
        <li><a href="logout.php">退出</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
  </div>
</nav>
<!--查找酒店的框-->
<?php 
    $hotels=array();
    $dbc = @mysqli_connect ('localhost', 'payment', 'payment123', 'payment') OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );
         mysqli_set_charset($dbc, 'utf8');
         $q= "SELECT * FROM hotel"; 
         $r= @mysqli_query($dbc,$q);          
         while($row=mysqli_fetch_assoc($r)){    
                $hotels[]=array("id" => $row['h_id'], "name" => $row['hotel_name'], "picture" => $row['picsmall'], 
                  "province" => $row['add_province'], "city" =>$row['add_city'], "block" => $row['add_block'], 
                  "hot" => $row['reviewer'], "road" => $row['add_street'], 'price' => $row['hotel_price'], 
                  "point" => $row['score'],"rank" => $row['star'],
                  "description" => $row['add_province'] . $row['add_city'] . $row['add_block'] . $row['add_street']);   
                }
    mysqli_free_result($r);    
    mysqli_close($dbc); 
?>


<main class="packages-list-container" id="all-packages">
    <div class="container">
        <div class="row">

            <div class="col-md-3">
                <ul class="list-group">
                <li class="list-group-item filter-tip">酒店名称</li>
                    <li class="list-group-item">
                    <div class="row">
                    <div class="col-md-9">
                        <input type="text" name="city" class="form-control" placeholder="请输入酒店名" id="hotel-name"/>
                        </div>
                        <div><button class="btn btn-warning" id="fliter-hotel">筛选</button></div>    
                    </div>
                    
                    </li>
                     <li class="list-group-item filter-tip">价格</li>
                    <li class="list-group-item">
    <p><input type="checkbox" name="price" value="100" checked="checked" /><span class="label label-warning">100以下  </span></p>
    <p><input type="checkbox" name="price" value="200" checked="checked" /><span class="label label-warning">100-200  </span></p>
    <p><input type="checkbox" name="price" value="300" checked="checked" /><span class="label label-warning">200-300  </span></p>
    <p><input type="checkbox" name="price" value="500" checked="checked" /><span class="label label-warning">300-500  </span></p>
    <p><input type="checkbox" name="price" value="500+" checked="checked" /><span class="label label-warning">500以上  </span> </p>
           <li class="list-group-item filter-tip">星级</li>       
           <li class="list-group-item"> <span id="hotelstars"></span><div id="results"></div></li>  

                      <li class="list-group-item filter-tip">评分</li>       
           <li class="list-group-item"> 
    <p><input type="checkbox" name="stars" value="3" checked="checked" /><span class="label label-warning">4分  还凑合吧 </span></p>
    <p><input type="checkbox" name="stars" value="4" checked="checked" /><span class="label label-warning">4.5分 相当不错 </span></p>
    <p><input type="checkbox" name="stars" value="5" checked="checked" /><span class="label label-warning">5分 完美体验 </span></p>
                  </li>
                </ul>
            </div>
           

               
        <div class="col-md-9" >
        <div class="btn-group btn-group-justified" role="group" aria-label="...">
            <div class="btn-group" role="group">
                <button class="btn btn-info" name="sort" value="price" id="price"> 价格  <img src="/img/up.png"></button>
            </div>
            <div class="btn-group" role="group">
                <button class="btn btn-info " name="sort" value="grade" id="points"> 评分  <img src="/img/down.png"></button>

            </div>
            <div class="btn-group" role="group">
                <button class="btn btn-info " name="sort" value="popularity" id="hot"> 人气  <img src="/img/down.png"></button>
            </div>
            <div class="btn-group" role="group">
                <button class="btn btn-info " name="sort" value="popularity" id="rank"> 星级  <img src="/img/down.png"></button>
            </div>
        </div>
<br>
 <div class="list-group packages" id="hotels">
<?php
 foreach ($hotels as $hotel) {
     echo '<div class="row package list-group-item"><div class="col-md-3"><h4 class="package-name">' . $hotel['name'] .'</h4> <br />';
     echo '<img src="/'. $hotel['picture'] . '" width="121px" height="121px" /> </div><div class="col-md-5 hidden-xs><p class="package-description"><pr>';
     echo $hotel['province'] . '</pr> <city>' . $hotel['city'] . '</city>' . $hotel["block"] . $hotel['road'] . '</p><p class="package-description">' . $hotel['description'] . '</p>';
     echo '<span>酒店星级：</span>';
                for($i=0;$i<$hotel["rank"];$i++){
                    echo '<img src="/img/star.png" />';
                }
     echo '</div><div class="col-md-4">';
     echo '<span> <hot>' . $hotel['hot'] . '</hot>名用户曾经入住</span><br>';
     echo '<span>房价： ￥<price>' . $hotel['price'] . '</price><i class="lowest">起</i></span><br>';
     echo '<span></i> 评分： <strong><points>' . $hotel['point'] . '/5</points></strong></span>';
     echo '<br><button type="button" class="btn btn-info navbar-btn" value="' . $hotel['id'] . '" onclick="deletehotel(this.value)">删除</button>&nbsp;&nbsp;<a href="update-hotel.php?id=' . $hotel['id'] . '"><button type="button" class="btn btn-info navbar-btn">修改</button></a></div></div> ';
 }
?>   
        </div> 
        </div></div></div></main>

<footer id="footer" class="footer hidden-print">
    <div class="container">
        <div class="row">
            <div class="footer-about col-md-6 col-sm-12" id="about">
                <h4>关于 远途网</h4>
                <p>远途网是 浙江大学张引老师软件工程基础课程第二项目组支持并维护的开源项目，致力于为提供稳定、快速便捷的免费酒店机票查询和预订服务。项目主要同步于 <a href="https://github.com/onlinePayment/on-line-payment" target="_blank" onclick="_hmt.push(['_trackEvent', 'footer', 'click', 'footer-github.com'])">on-line-payment</a> 仓库。</p>
                <p>自<time>2016年13月32日</time>上线以来已经为超过十万个用户提供了稳定、可靠、便捷服务。</p>
                <p>反馈或建议请发送邮件至：phpsoup@163.com</p></div>

            <div class="footer-links col-md-3 col-sm-12">
                <h4>友情链接</h4>
                <ul class="list-unstyled">
                    <li><a href="http://www.bootcss.com/" target="_blank" onclick="_hmt.push(['_trackEvent', 'footer', 'click', 'footer-bootcss.com'])">Bootstrap 中文网</a></li>
                    <li><a href="http://www.ghostchina.com/" target="_blank" onclick="_hmt.push(['_trackEvent', 'footer', 'click', 'footer-ghostchina.com'])">Ghost 中国</a></li>
                    <li><a href="http://www.jquery123.com/" target="_blank" onclick="_hmt.push(['_trackEvent', 'footer', 'click', 'footer-jquery123.com'])">jQuery 中文 API</a></li>
                    <li><a href="http://github.com/" target="_blank" onclick="_hmt.push(['_trackEvent', 'footer', 'click', 'footer-github.com'])">Github</a></li></ul></div>

            <div class="footer-techs col-md-3 col-sm-12">
                <h4>我们用到的技术</h4>
                <ul class="list-unstyled">
                    <li><a href="http://www.bootcss.com/" target="_blank" onclick="_hmt.push(['_trackEvent', 'footer', 'click', 'footer-bootcss.com'])">Bootstrap</a></li>
                    <li><a href="http://www.jquery123.com/" target="_blank" onclick="_hmt.push(['_trackEvent', 'footer', 'click', 'footer-jquery123.com'])">jQuery</a></li>
                    <li><a href="http://php.net/" target="_blank" onclick="_hmt.push(['_trackEvent', 'footer', 'click', 'footer-php.cn'])">PHP</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="copy-right"><span>copyright&copy; 2016</span> </div>
</footer>
</body>
<script type="text/javascript">
    function deletehotel (value){
      if(confirm("真的要删除吗？"))
        $.ajax({
          url: "delete-hotel.php",
          type: "post",
          data: {"id":value},
          datatype: "text",
          success: function(data, textStatus, jqXHR){
            if(data==="success"){
              location.reload();//如果删除成功刷新页面
            }
            else{
              alert(data);//如果删除失败报警
            }
          }
        })
      else
        return false;
      }       
</script>

<script type="text/javascript" src="/js/admin-hotel.js"></script>

