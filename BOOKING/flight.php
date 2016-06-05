<?php
    include("include/head.html");
    include("include/cityquery.html");
    include("include/time-picker.html");
?>

<?php
    include("include/title.html");
    //if(login)
     //include("include/header_login.html");
    //else
        include("include/header_not_login.html");

?>


<div class="container" style="margin-top: 30px">
    <div class="row">
            <div class="col-md-4">
                <ul class="list-group">
                <li class="list-group-item" style="background-color:rgb(92,184,92); color: white;"><h2><span class="glyphicon glyphicon-plane" aria-hidden="true"></span> <i>  远途网机票查询预订</i></h2></li>
                <li class="list-group-item"><h4><span class="label label-default">出发时间</span>  <input type="text"  id="startdate" value="10/24/1984" /></h4></li>
                    <li class="list-group-item"><h4><span class="label label-default">出发地点</span>  <input type="text" id="fromcity" class="from-control city-select" readonly="readonly"></h4></li>
                    <li class="list-group-item"><h4><span class="label label-default">到达地点</span> <input type="text" id="tocity" class="from-control city-select" readonly="readonly"></h4></li>
                    <li class="list-group-item"><button class="btn btn-info" style="margin-left: 42%">查询</button></li>
                    
                </ul>
            </div>
            <div class="col-md-8">            
            <div class="btn-group" role="group">
                <button class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 起飞时间<span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li><a>上午 6:00-12:00</a></li>
                    <li><a>下午12:00-18:00</a></li>
                    <li><a>下午 18:00-24:00</a></li>
             </ul>
            </div>
             <div class="btn-group" role="group">
                <button class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 航空公司<span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li><a>东方航空公司</a></li>
                    <li><a>南方航空公司</a></li>
                    <li><a>西方航空公司</a></li>
                    <li><a>北方航空公司</a></li>
             </ul>
            </div>
            <div class="btn-group" role="group">
                <button class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 舱位<span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li><a>经济舱</a></li>
                    <li><a>头等舱</a></li>
                    <li><a>总统舱</a></li>
             </ul>
            </div>
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <div class="btn-group" role="group">
                <button class="btn btn-info" > 价格&nbsp;&nbsp;&nbsp;  <img src="img/down.png"></button>
            </div>
            <div class="btn-group" role="group">
                <button class="btn btn-info" > 准点率&nbsp;&nbsp;&nbsp;  <img src="img/down.png"></button>
            </div>

            <h3>特价机票</h3>(如果get参数为空特价机票)
            <hr>
            <div class="list-group packages" id="flights">
                 <div class="package list-group-item" data-library-name="bootstrap">
                  <div class="row">
                  <div class="col-md-3 flight-company">
                    东方航空公司
                  </div>
                  <div class="col-md-5">
                          <div class="row">
                            <div class="col-md-5">
                            <times>8:00</times><br>
                            杭州萧山机场
                            </div>
                            <div class="col-md-2 arrow">=></div>
                            <div class="col-md-5">
                            <times>16:45</times><br>
                            成都双流机场
                            </div>
                          </div>         
                  </div>
                  <div class="col-md-2">
                    准点率<br>
                    <price>98%</price>
                  </div>
                  <div class="col-md-2">
                    <price>￥498</price>起<br>
                    <a href="order-flight.php?id=what"><button class="btn btn-warning">预订</button></a>
                  </div>                   
                  </div>
                </div>
 
            </div>
            <br>
            <h3>热门路线</h3>
            <hr>
            <div class="row">
              <div class="col-md-4">
              <a href="flight.php?from=海口&to=哈尔滨">
                  <img src="img/haerbing.jpg" width="200" height="121">
                  <br>海口=>哈尔滨<br>
              </a>
              </div>
               <div class="col-md-4">
              <a href="flight.php?from=哈尔滨&to=海口">
                  <img src="img/haikou.jpg" width="200" height="121">
                  <br>哈尔滨=>海口<br><br>
              </a>
              </div>
               <div class="col-md-4">
              <a href="flight.php?from=成都&to=杭州">
                  <img src="img/hangzhou.jpg" width="200" height="121">
                  <br>成都=>杭州<br><br>
              </a>
              </div>
               <div class="col-md-4">
              <a href="flight.php?from=上海&to=北京">
                  <img src="img/beijing.jpg" width="200" height="121">
                  <br>上海=>北京 <br><br>
              </a>
              </div>
               <div class="col-md-4">
              <a href="flight.php?from=杭州&to=成都">
                  <img src="img/chengdu.jpg" width="200" height="121">
                  <br>杭州=>成都<br><br>
              </a>
              </div>
               <div class="col-md-4">
              <a href="flight.php?from=北京&to=上海">
                  <img src="img/shanghai.jpg" width="200" height="121">
                  <br>北京=>上海<br><br>
              </a>
              </div>

              
            </div>

        </div>
</div>
</div>

<?php
  include("include/footer.html")
?>
<style type="text/css">
    .select-item
    {
        background-color: rgb(92,184,92);
        color: white;
        height: 30px;
        padding-top: 5px;
        padding-bottom: 5px;
    }
    times
    {
      padding-left: 20%;
      font-size: larger;
      font-weight: bold;
    }
    .arrow
    {
      font-size: xx-large;
      color: green;
      font-weight: bold;
    }
    .flight-company
    {
      font-size: x-large;
      font-weight: bold;
    }
    price
   {
      font-size: large;
      color: green;
    }
    </style>

<script type="text/javascript">
$(function() {
    $('#startdate').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        startDate: moment(),
    });
    $('.city-select').citySelect();
});
</script>