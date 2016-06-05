<?php
        include("include/head.html");
        include("include/time-picker.html");
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

<script type="text/javascript">
    $(function(){
        $('#hotelstars').raty();
    });
</script>

<?php
        include("include/title.html");
        //if (login)
            //include("include/head_login.html");
        //else
        include("include/header_not_login.html");
        include("include/search_hotel.html");
        //对于head部分的包含

        $hotels=array();
?>


<main class="packages-list-container" id="all-packages">
    <div class="container">
        <div class="row">

            <div class="col-md-3">
                <ul class="list-group">
                <li class="list-group-item filter-tip">酒店名称</li>
                    <li class="list-group-item">
                    <input type="text" name="city" class="form-control" placeholder="请输入酒店名" />
                    </li>
                     <li class="list-group-item filter-tip">价格</li>
                    <li class="list-group-item">
    <p><input type="checkbox" name="price" value="100-" /><span class="label label-warning">100以下  </span></p>
    <p><input type="checkbox" name="price" value="200-" /><span class="label label-warning">100-200  </span></p>
    <p><input type="checkbox" name="price" value="200+"/><span class="label label-warning">200-300  </span></p>
    <p><input type="checkbox" name="price" value="200+" /><span class="label label-warning">300-500  </span></p>
    <p><input type="checkbox" name="price" value="200+" /><span class="label label-warning">500以上  </span> </p>
           <li class="list-group-item filter-tip">星级</li>       
           <li class="list-group-item"> <span id="hotelstars"></span></li>  
                      <li class="list-group-item filter-tip">评分</li>       
           <li class="list-group-item"> 
    <p><input type="checkbox" name="price" value="100-" /><span class="label label-warning">3分  还凑合吧 </span></p>
    <p><input type="checkbox" name="price" value="200-" /><span class="label label-warning">4分 相当不错 </span></p>
    <p><input type="checkbox" name="price" value="200+"/><span class="label label-warning">5分 完美体验 </span></p>
                  </li>
                </ul>
            </div>
           

        <?php 
            if(!isset($_Get['search'])||empty($_Get['search'])){

            }//如果没有查询信息应该,应该显示默认的信息
            else{

            }

            $hotels['01']=array("id" => 1, "name" => "紫金港大酒店", "picture" => "hotel/0001.jpg", "province" => "浙江省", "city" =>"杭州市", "block" => "西湖区", "hot" => "45","road" => "申花路798号",'price' => 129, "point" => 3.5,"rank" => 3,"description" => "靠近浙江大学紫金港校区");

        
            //进行数据库的搜索

         ?>
        <div class="list-group packages" id="hotels">
        <div class="col-md-9" >
        <div class="btn-group btn-group-justified" role="group" aria-label="...">
            <div class="btn-group" role="group">
                <button class="btn btn-info" name="sort" value="price" id="price"> 价格  <img src="img/up.png"></button>
            </div>
            <div class="btn-group" role="group">
                <button class="btn btn-info " name="sort" value="grade" id="points"> 评分  <img src="img/down.png"></button>
            </div>
            <div class="btn-group" role="group">
                <button class="btn btn-info " name="sort" value="popularity" id="hot"> 人气  <img src="img/down.png"></button>
            </div>
            <div class="btn-group" role="group">
                <button class="btn btn-info " name="sort" value="popularity" id="rank"> 星级  <img src="img/down.png"></button>
            </div>
        </div>
<br>
        <?php
            foreach ($hotels as $hotel) {
                echo '<a href="/hotel.php?id=' . $hotel['id'] . '" class="package list-group-item" data-library-name="bootstrap">';
                echo '<div class="row"> <div class="col-md-3">';
                echo '<h4 class="package-name">' . $hotel['name'] . '</h4> <br />';
                echo '<img src="' . $hotel['picture'] . '" width="121px" height="121px" /> </div>';
                echo '<div class="col-md-5 hidden-xs><p class="package-description"><pr>' . $hotel['province'] . '</pr> <city>' . $hotel['city'] . '</city> ' .$hotel['block'] . $hotel["road"] . '</p>';
                echo '<p class="package-description">' . $hotel["description"] . '</p>';
                echo '<span>酒店星级：</span>';
                for($i=0;$i<$hotel["rank"];$i++){
                    echo '<img src="img/star.png" />';
                }
                echo '</div><div class="col-md-4">';
                echo '<span> <hot>' . $hotel['hot'] . '</hot>名用户曾经入住</span><br>';
                echo '<span>房价： ￥<price>' . $hotel['price'] . '</price><i class="lowest">起</i></span><br>';
                echo '<span></i> 评分： <strong><rank>' . $hotel['point'] . '/5</rank></strong></span>';
                echo '<br><button type="button" class="btn btn-info navbar-btn">点击以查看更多信息 <img src="img/goto.png"></button></div></div></a>';
            }
        ?>
            </div>
        </div></div></div></main>

<?php
    include("include/footer.html");
    include("include/scripts.html");
?>

<!--<script type="text/javascript" src="js/mysite.js"></script>-->
