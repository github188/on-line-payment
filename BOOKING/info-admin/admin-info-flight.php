<?php
   include_once("check-session.php");
    include("../include/head.html");
?>

<link rel="stylesheet" type="text/css" media="all" href="/css/daterangepicker.css" />
<script src="//cdn.bootcss.com/moment.js/2.13.0/moment.js"></script>
<script src="//cdn.bootcss.com/bootstrap-daterangepicker/2.1.21/daterangepicker.js"></script>
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


<link rel="stylesheet" href="/css/ku-city.css">
<script type="text/javascript" src="/js/city-select.js"></script>

<?php 
$flights=array();
$dbc = @mysqli_connect ('localhost', 'payment', 'payment123', 'payment') OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );
     mysqli_set_charset($dbc, 'utf8');
     $q= "SELECT * FROM flight NATURAL JOIN class"; 
     $r= @mysqli_query($dbc,$q);          
     while($row=mysqli_fetch_assoc($r)){    
            $flights[]=array("flight_number" => $row['flight_number'], "company" => $row['company'], "class_price" => $row['class_price'], 
              "start_time" => $row['start_time'], "arrive_time" =>$row['arrive_time'], "straight" => $row['straight'], "flight_from" => $row['flight_from'], 
              "flight_to" => $row['flight_to'],'classrate' => $row['classrate']);   
            }
mysqli_free_result($r);    
mysqli_close($dbc); 
?>

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
        <li><a href="new-flight.php">添加新机票</a></li>
        <li><a href="logout.php">退出</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
  </div>
</nav>
<!--查找酒店的框-->

<div class="container" style="margin-top: 30px">
    <div class="row">
            <div class="col-md-4">
                <ul class="list-group">
                <li class="list-group-item" style="background-color:rgb(92,184,92); color: white;"><h2><span class="glyphicon glyphicon-plane" aria-hidden="true"></span> <i>  远途网机票管理</i></h2></li>
                    <li class="list-group-item"><h4><span class="label label-default">出发地点</span>  <input type="text" id="fromcity" class="from-control city-select" readonly="readonly"></h4></li>
                    <li class="list-group-item"><h4><span class="label label-default">到达地点</span> <input type="text" id="tocity" class="from-control city-select" readonly="readonly"></h4></li>
                    <li class="list-group-item"><button class="btn btn-info" style="margin-left: 42%" id="submit">查询</button></li>
                    
                </ul>
            </div>
            <div class="col-md-8">            
            <div class="btn-group" role="group">
                <button class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 起飞时间<span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li><button class="btn" value="all" onclick="changeTime(this.value)" style="background-color:white">所有时间</button></li>
                    <li><button class="btn" value="morning" onclick="changeTime(this.value)" style="background-color:white">06:00-12:00</button></li>
                    <li><button class="btn" value="noon" onclick="changeTime(this.value)" style="background-color:white">12:00-18:00</button></li>
                    <li><button class="btn" value="night" onclick="changeTime(this.value)" style="background-color:white">18:00-24:00</button></li>
             </ul>
            </div>
             <div class="btn-group" role="group">
                <button class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 航空公司<span class="caret"></span></button>
                 <ul class="dropdown-menu">
                 <li><button class="btn" value="all" onclick="changeCompany(this.value)" style="background-color:white">所有公司</button></li>
                    <li><button class="btn" value="四川航空" onclick="changeCompany(this.value)" style="background-color:white">四川航空</button></li>
                    <li><button class="btn" value="九元航空" onclick="changeCompany(this.value)" style="background-color:white">九元航空</button></li>
                    <li><button class="btn" value="中国航空" onclick="changeCompany(this.value)" style="background-color:white">中国国航</button></li>
                    <li><button class="btn" value="南方航空" onclick="changeCompany(this.value)" style="background-color:white">南方航空</button></li>
                    <li><button class="btn" value="成都航空" onclick="changeCompany(this.value)" style="background-color:white">成都航空</button></li>
                    <li><button class="btn" value="上海航空" onclick="changeCompany(this.value)" style="background-color:white">上海航空</button></li>
                    <li><button class="btn" value="长龙航空" onclick="changeCompany(this.value)" style="background-color:white">长龙航空</button></li>
                    <li><button class="btn" value="天津航空" onclick="changeCompany(this.value)" style="background-color:white">天津航空</button></li>
                    <li><button class="btn" value="吉祥航空" onclick="changeCompany(this.value)" style="background-color:white">吉祥航空</button></li>
                    <li><button class="btn" value="海南航空" onclick="changeCompany(this.value)" style="background-color:white">海南航空</button></li>
                    <li><button class="btn" value="首都航空" onclick="changeCompany(this.value)" style="background-color:white">首都航空</button></li>
                    <li><button class="btn" value="中国联航" onclick="changeCompany(this.value)" style="background-color:white">中国联航</button></li>
                    <li><button class="btn" value="厦门航空" onclick="changeCompany(this.value)" style="background-color:white">厦门航空</button></li>
                    <li><button class="btn" value="东方航空" onclick="changeCompany(this.value)" style="background-color:white">东方航空</button></li>
                    <li><button class="btn" value="山东航空" onclick="changeCompany(this.value)" style="background-color:white">山东航空</button></li>
                    <li><button class="btn" value="西藏航空" onclick="changeCompany(this.value)" style="background-color:white">西藏航空</button></li>
                    <li><button class="btn" value="深圳航空" onclick="changeCompany(this.value)" style="background-color:white">深圳航空</button></li>
                    <li><button class="btn" value="扬子江航空" onclick="changeCompany(this.value)" style="background-color:white">扬子江航空</button></li>                    
                </ul>
            </div>
            <div class="btn-group" role="group">
                <button class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 舱位<span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li><button class="btn" value="all" onclick="changeCangwei(this.value)" style="background-color:white">所有舱位</button></li>
                    <li><button class="btn" value="经济舱" onclick="changeCangwei(this.value)" style="background-color:white">经济舱</button></li>
                    <li><button class="btn" value="头等舱" onclick="changeCangwei(this.value)" style="background-color:white">头等舱</button></li>
                    <li><button class="btn" value="商务舱" onclick="changeCangwei(this.value)" style="background-color:white">商务舱</button></li>
             </ul>
            </div>
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <div class="btn-group" role="group">
                <button class="btn btn-info" id="price"> 价格&nbsp;&nbsp;&nbsp;  <img src="/img/down.png"></button>
            </div>

            <hr>
            <div class="list-group packages" id="flights">

            <?php
                  foreach ($flights as $flight) {
                    echo '<div class="package list-group-item" data-library-name="bootstrap"><div class="row"><div class="col-md-2 flight-company">' . '<company>';
                    echo  $flight['flight_number'];
                    echo      '<br><com>' . $flight['company'] .'</com></company></div>';
                    echo '<div class="col-md-5">
                          <div class="row">
                            <div class="col-md-5">
                            <times>' . substr($flight['start_time'],10,6) . '</times><br><city style="padding-left: 25%">'
                            . $flight['flight_from'] . '</city></div>
                            <div class="col-md-2 arrow">=></div>
                            <div class="col-md-5">
                            <times>' . substr($flight['arrive_time'],10,6) . '</times><br><city style="padding-left: 25%">'
                            . $flight['flight_to'] . '</city></div></div></div>';
                    echo ' <div class="col-md-2">
                    </price><br><cangwei>' . $flight['classrate'] . '</cangwei>
                  </div><div class="col-md-3"><price style="padding-left: 10%;">￥' . $flight['class_price'] . '</price><br>';
                   echo '<button class="btn btn-warning" value="' .$flight['flight_number'] . '" onclick="deleteflight(this.value)">删除</button>&nbsp;&nbsp;<a href="update-flight.php?id=' . $flight['flight_number'] .'"><button class="btn btn-warning">修改</button></a></div></div></div>';
                  }
              ?>
            </div>

        </div>
</div>
</div>

<?php
include("../include/footer.html");
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
     city,company
    {
        font-size: large;
       padding-left: 5%
    }
    </style>
    <script type="text/javascript">
       $(function(){
        $('.city-select').citySelect();
      });

      function deleteflight (value){
        if(confirm("真的要删除吗")){
             $.ajax({
                url: "delete-flight.php",
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
           }
           else{
            return false;
           }
      }       
    </script>

    <script type="text/javascript" src="/js/admin-flight.js"></script>
