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

        <?php 
            $flights=array();
            if(!isset($_GET['from'])||empty($_GET['to'])){
            $dbc = @mysqli_connect ('localhost', 'payment', 'payment123', 'payment') OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );
                 mysqli_set_charset($dbc, 'utf8');
                 $q= "SELECT * FROM flight NATURAL JOIN class WHERE class.discount='Y'"; 
                 $r= @mysqli_query($dbc,$q);          
                 while($row=mysqli_fetch_assoc($r)){    
                        $flights[]=array("flight_number" => $row['flight_number'], "company" => $row['company'], "class_price" => $row['class_price'], 
                          "start_time" => $row['start_time'], "arrive_time" =>$row['arrive_time'], "straight" => $row['straight'], "flight_from" => $row['flight_from'], 
                          "flight_to" => $row['flight_to'],'classrate' => $row['classrate']);   
                        }
            mysqli_free_result($r);    
            mysqli_close($dbc); 
            }        //如果没有查询信息，就显示特价机票

           else{
                 $flight_from=$_GET['from'];
                 $flight_to=$_GET['to'];
                 $dbc = @mysqli_connect ('localhost', 'payment', 'payment123', 'payment') OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );
                 mysqli_set_charset($dbc, 'utf8');
                 $q= "SELECT * FROM flight NATURAL JOIN class WHERE flight.flight_from='$flight_from' AND flight.flight_to='$flight_to'"; 
                 $r= @mysqli_query($dbc,$q);     
                 while($row=mysqli_fetch_assoc($r)){    
                        $flights[]=array("flight_number" => $row['flight_number'], "company" => $row['company'], "class_price" => $row['class_price'], 
                          "start_time" => $row['start_time'], "arrive_time" =>$row['arrive_time'], "straight" => $row['straight'], "flight_from" => $row['flight_from'], 
                          "flight_to" => $row['flight_to'], 'classrate' => $row['classrate']);  
                        }
            mysqli_free_result($r);    
            mysqli_close($dbc);
              }      
         ?>


<div class="container" style="margin-top: 30px">
    <div class="row">
            <div class="col-md-4">
                <ul class="list-group">
                <li class="list-group-item" style="background-color:rgb(92,184,92); color: white;"><h2><span class="glyphicon glyphicon-plane" aria-hidden="true"></span> <i>  远途网机票查询预订</i></h2></li>
                <li class="list-group-item"><h4><span class="label label-default">出发时间</span>  <input type="text"  id="startdate" value="10/24/1984" /></h4></li>
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
                <button class="btn btn-info" id="price"> 价格&nbsp;&nbsp;&nbsp;  <img src="img/down.png"></button>
            </div>

        <?php
        if(!isset($_GET['from'])||empty($_GET['to'])){
          echo '<br>';
          echo "<h3>特价机票</h3>";
          echo '</br>';
        }
        ?>

      <hr>


  <div class="list-group packages" id="flights">
        <?php
            foreach ($flights as $flight){
            echo '<div class="package list-group-item" data-library-name="bootstrap">';
            echo      '<div class="row">';
            echo      '<div class="col-md-3 flight-number"><company>';
            echo        $flight['flight_number'];
            echo      '<br><com>' . $flight['company'] .'</com></company></div>';
            echo      '<div class="col-md-5">';
            echo              '<div class="row">';
            echo                '<div class="col-md-5">';
            echo                '<times>'.substr($flight['start_time'],10,6).'</times><br><city>';
            echo                $flight['flight_from'];
            echo                '</city></div>';
            echo                '<div class="col-md-2 arrow">=></div>';
            echo                '<div class="col-md-5">';
            echo                '<times>'. substr($flight['arrive_time'],10,6) .'</times><br><city>';
            echo                $flight['flight_to'];
            echo                '</city></div>';
            echo              '</div>' ; 
            echo      '</div>';
            echo     '<div class="col-md-2"><b style="padding-left: 10%"><cangwei>';
            echo        $flight['classrate'].'</cangwei></b><br>';
            echo        '<price>￥'.$flight['class_price'].'</price>';
            echo      '</div>';
            echo      '<div class="col-md-2">';
            echo        '<a href="order-flight.php?id=' . $flight["flight_number"] . '&cangwei=' . $flight['classrate'] . '"> <button class="btn btn-warning">预订</button></a>';
            echo      '</div>';                   
            echo      '</div>';
            echo    '</div>';
              }
          ?>





 
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
              <a href="flight.php?from=北京&to=海口">
                  <img src="img/haikou.jpg" width="200" height="121">
                  <br>北京=>海口<br><br>
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

<script type="text/javascript" src="/js/flight.js"></script>
