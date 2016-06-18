<?php
    include_once("check-session.php");

    $id=$_GET['id'];
    $dbc = @mysqli_connect ('localhost', 'payment', 'payment123', 'payment') OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );
         mysqli_set_charset($dbc, 'utf8');
         $q= "SELECT * FROM hotel WHERE hotel.h_id='$id'"; 
         $r= @mysqli_query($dbc,$q);          
         while($row=mysqli_fetch_assoc($r)){    
                    $name = $row['hotel_name'];
                    $province = $row['add_province'];
                    $city = $row['add_city'];
                    $block = $row['add_block']; 
                    $street = $row['add_street'];
                    $low = $row['hotel_price'];
                    $points = $row['score'];
                    $rank = $row['star'];
                    $reviewer = $row['reviewer'];
                    $logitude = $row['logitude'];
                    $latitude = $row['latitude'];
                    $heat = $row['heat'];  
                }
    mysqli_free_result($r);    

    $rooms=array();
                $qr= "SELECT * FROM room WHERE room.hotel_name ='$name'"; 
                $s= @mysqli_query($dbc,$qr); 
                while($row=mysqli_fetch_assoc($s)){    
                        $rooms[]=array("type" => $row['type'], "price" => $row['room_price']);   
                        }
    mysqli_free_result($s);
    $rom = null;
    foreach ($rooms as $room){
       $rom= $rom . $room['type'].'/'.$room['price'].';';
    }




    include("../include/head.html");
?>

<style type="text/css">
    .button {
            display: inline-block;
            border-radius: 4px;
            background-color: limegreen;
            border: none;
            color: #FFF;
            text-align: center;
            font-size: 15px;
            padding: 5px;
            width: 100px;
            transition: all 0.5s;
            cursor: pointer;
            margin: 5px;
        }

        .button span {
            cursor: pointer;
            display: inline-block;
            position: relative;
            transition: 0.5s;
        }

        .button span:after {
            content: '»';
            position: absolute;
            opacity: 0;
            top: 0;
            right: -20px;
            transition: 0.5s;
        }

        .button:hover span {
            padding-right: 25px;
        }

        .button:hover span:after {
            opacity: 1;
            right: 0;
        }

        a:hover, a:active {
            background-color: lime;
        }

        .left {
            position: relative;;
            left: 30%;
        }

        .right {
            position: relative;;
            left: 70%;
        }

        #register {
            display: inline-block;
            border-radius: 4px;
            background-color: limegreen;
            border: none;
            color: #FFF;
            text-align: center;
            font-size: 15px;
            padding: 5px;
            width: 100px;
            transition: all 0.5s;
            cursor: pointer;
            margin: 5px;
        }

        select
        {
            color: black;
        }
        option
        {
            color: black;
        }
</style>
<link href="//cdn.bootcss.com/raty/2.7.0/jquery.raty.css" rel="stylesheet">
<script src="//cdn.bootcss.com/raty/2.7.0/jquery.raty.js"></script>

<script type="text/javascript">
    $(function(){
        $('#hotelstars').raty();
    });
</script>

<!--站点标题-->
<body class="home-template">
<div class="container">
      <div class="row" id="headline-container">
           <h1 class="col-md-12">
                <span><img src="/img/图标.jpg" width="70" height="70" alt="some_text">&nbsp;&nbsp;</span><em><strong>远途网<span>&nbsp;&nbsp;&nbsp;&nbsp;酒店机票信息管理</span></strong></em>
         </h1>
      </div>
    </div>
 <hr size=1 style="height:3px;background-color: green"><br><br>

<div class="container" id="content-container">
    <div class="row" style="padding-top: 15px">
    <form method="post" action="do-updata-hotel.php" id="submit">
    <input type="text" hidden  <?php echo 'value="' . $id .'"' ?>; name="hotel-id">
        <div class="col-md-6">
        <div class="form-horizontal" id="form" style="padding-top: 20px">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputusername">酒店名</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control"  <?php echo 'value="' . $name .'"' ?>; name="name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputpassword">省份</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control"  <?php echo 'value="' . $province .'"' ?> name="province">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputpassword">城市</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control"  <?php echo 'value="' . $city .'"' ?> name="city">
                    </div>

                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputpassword">区</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" <?php echo 'value="' . $block .'"' ?> name="block">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputpassword">街道</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control"  <?php echo 'value="' . $street .'"' ?> name="street">
                    </div>
                </div> 
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputpassword">热度</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" <?php echo 'value="' . $heat .'"' ?> name="heat">
                    </div>
                </div>                
                </div>
            
        </div>
        <div class="col-md-6">
            <div class="form-horizontal" name="form" style="padding-top: 20px">
            <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputpassword">酒店星级</label>
                    <div class="col-sm-1">
                        <select name="rank">
                            <option name="star" <?php if($rank===1) echo 'selected="selected"'?>>1</option>
                            <option name="star" <?php if($rank===2) echo 'selected="selected"'?>>2</option>
                            <option name="star" <?php if($rank===3) echo 'selected="selected"'?>>3</option>
                            <option name="star" <?php if($rank===4) echo 'selected="selected"'?>>4</option>
                            <option name="star" <?php if($rank===5) echo 'selected="selected"'?>>5</option>
                        </select>
                    </div>
                    <label class="col-sm-2 control-label" for="inputpassword">酒店评分</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control"  <?php echo 'value="' . $points .'"' ?> name="points">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputusername">入住人次</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control"  <?php echo 'value="' . $reviewer .'"' ?> name="reviewer">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputusername">最低房价</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control"  <?php echo 'value="' . $low .'"' ?>  name="low-price">
                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputusername">房型列表</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control"  <?php echo 'value="' . $rom .'"' ?> name="rooms">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputusername">经度</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control"  <?php echo 'value="' . $logitude .'"' ?> name="logitude">
                    </div>
                    <label class="col-sm-2 control-label" for="inputusername">纬度</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control"  <?php echo 'value="' . $latitude .'"' ?>  name="latitude">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputusername">缩略图</label>
                    <div class="col-sm-3">
                        <input type="file"   name="small-img">
                    </div>
                    <label class="col-sm-2 control-label" for="inputusername">详图</label>
                    <div class="col-sm-3">
                        <input type="file" name="big-img">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
                    <div class="col-sm-offset-5 col-sm-2">
                        <input class="button" name="search" type="submit" style="vertical-align:middle;width:100%" value="修改酒店">
                    </div>
                </div>
            </form>
        </div></div>
        <?php
            include("../include/footer.html");
        ?>
</body>
</html>

<script type="text/javascript">
    $(function(){
        $('#submit').submit(function(){
            variables={
                '酒店名字': $('[name=name]').val(),
                '纬度': $('[name=latitude]').val(),
                 '经度': $('[name=logitude]').val(),
                 '房间': $('[name=rooms]').val(),
                 '最低价格': $('[name=low-price]').val(),
                 '居住人次': $('[name=reviewer]').val(),
                 '评分': $('[name=points]').val(),
                 '热度': $('[name=heat]').val(),
                 '街道': $('[name=street').val(),
                 '城市': $('[name=city]').val(),
                 '省份': $('[name=province]').val(),
                 '区': $('[name=block]').val()
            };
            for (item in variables){
                if(variables[item]===""){
                    alert(item+"不能为空");
                    return false;
                }
            }
        })
    });
    
</script>