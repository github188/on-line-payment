<?php
    include("include/head.html");
    include("include/time-picker.html");
    include("include/title.html");
    include("include/header_login.html");
?>

<div class="jumbotron" style="background-image: url(&quot;https://cdn5.agoda.net/images/ABTest/ABTest5692/home-1920x560-beratan-lake-bali-indonesia.jpg&quot;); background-size: cover; width: 1920; height: 1000; ">
<div class="container">
<br><br><br><br><br><br>
  <h1 style="color: white">远途网</h1>
    <p style="color: white;">800000家来自全球的酒店，来自全球361家不同航空公司的航班</p>
    <p style="color: white;">因为专注，我们更专业</p>
    <form method="get" action="search-hotel.php">
    <div class="row" style="background-color: rgba(255,255,255,0.7);">
    <div class="col-lg-3"> 
       <span class="search-info">你想去哪里呢</span>
      <input type="text" class="form-control" name="where" placeholder="城市" id="cityquery" readonly="readonly">
      <br class="search-info">
    </div><!-- /input-group -->
    <div class="col-lg-4">
     <span class="search-info">入住和离开时间</span>
      <input type="text" class="form-control" name="date" id="Date">
      <br class="search-info">
      <span class="add-on"><i class="icon-th"></i></span>
    </div><!-- /input-group -->
    <div class="col-lg-3">
    <span class="search-info" name="hotelInfo">酒店信息</span>
      <input type="text" class="form-control" placeholder="酒店名">
      <br class="search-info">
    </div><!-- /input-group -->
    <div class="col-lg-2">
    <br class="search-info">
      <button class="btn btn-info btn-sm" type="button">搜索</button>
      <br class="search-info">
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
  </form>
</div><!-- /.row -->
  </div>
     <link rel="stylesheet" href="css/ku-city.css">
  <script src="js/city-select.js"></script>

        <script type="text/javascript">
         $('#cityquery').citySelect();

</script>
<div class="container">
    <p style="font-size: x-large">大家都爱去哪里？</p>
    <div class="row">
        <div class="col-lg-3">
            <img src="img/1569.jpg" class="hot-place">
            <a href="search_hotel.php?city=北京"><span>北京</span></a>
            <p>北京市</p>
        </div>
        <div class="col-lg-3">
            <img src="img/1569.jpg" class="hot-place">
            <a href="search_hotel.php?city=北京"><span>北京</span></a>
            <p>北京市</p>     
        </div>
        <div class="col-lg-3">
            <img src="img/1569.jpg" class="hot-place">
            <a href="search_hotel.php?city=北京"><span>北京</span></a>
            <p>北京市</p>
        </div>
        <div class="col-lg-3">
            <img src="img/1569.jpg" class="hot-place">
            <a href="search_hotel.php?city=北京"><span>北京</span></a>
            <p>北京市</p>
        </div>
        </div>

    <div class="row">
        <div class="col-lg-3">
            <img src="img/14690.jpg" class="hot-place">
            <a href="search_hotel.php?city=北京"><span>北京</span></a>
            <p>北京市</p>
        </div>
        <div class="col-lg-3">
            <img src="img/14690.jpg" class="hot-place">
            <a href="search_hotel.php?city=北京"><span>北京</span></a>
            <p>北京市</p>     
        </div>
        <div class="col-lg-3">
            <img src="img/14690.jpg" class="hot-place">
            <a href="search_hotel.php?city=北京"><span>北京</span></a>
            <p>北京市</p>
        </div>
        <div class="col-lg-3">
            <img src="img/14690.jpg" class="hot-place">
            <a href="search_hotel.php?city=北京"><span>北京</span></a>
            <p>北京市</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <img src="img/16056.jpg" class="hot-place">
            <a href="search_hotel.php?city=北京"><span>北京</span></a>
            <p>北京市</p>
        </div>
        <div class="col-lg-3">
            <img src="img/16056.jpg" class="hot-place">
            <a href="search_hotel.php?city=北京"><span>北京</span></a>
            <p>北京市</p>     
        </div>
        <div class="col-lg-3">
            <img src="img/16056.jpg" class="hot-place">
            <a href="search_hotel.php?city=北京"><span>北京</span></a>
            <p>北京市</p>
        </div>
        <div class="col-lg-3">
            <img src="img/16056.jpg" class="hot-place">
            <a href="search_hotel.php?city=北京"><span>北京</span></a>
            <p>北京市</p>
        </div>
    </div>
</div>

<?php
include("include/footer.html");
?>

<script type="text/javascript">
  $(function(){
         $('#Date').daterangepicker({
          startDate: moment(),
          endDate: moment().add(1,"days")
        });
    });
    </script>